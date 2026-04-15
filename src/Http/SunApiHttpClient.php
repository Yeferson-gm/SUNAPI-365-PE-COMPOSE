<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Http;

use SunApi365\Sdk\SunApiSdkError;

final class SunApiHttpClient
{
    public const DEFAULT_BASE_URL = 'https://api.sunapi.site';

    private readonly string $baseUrl;

    private ?string $accessToken;

    /**
     * @param array<int, string> $defaultHeaders
     */
    public function __construct(
        ?string $baseUrl = null,
        ?string $accessToken = null,
        private readonly array $defaultHeaders = [],
        private readonly ?int $timeoutSeconds = null
    ) {
        $this->baseUrl = rtrim(self::normalizeBaseUrl($baseUrl), '/');
        $this->accessToken = self::normalizeToken($accessToken);
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setAccessToken(?string $token): void
    {
        $this->accessToken = self::normalizeToken($token);
    }

    /**
     * @param array{
     *   method?: string,
     *   query?: array<string, scalar|null>,
     *   json?: array<string, mixed>|list<mixed>,
     *   form?: array<string, scalar|null>,
     *   accessToken?: ?string,
     *   retry?: false|array{attempts?: int, statuses?: array<int, int>},
     *   timeoutSeconds?: int
     * } $options
     */
    public function request(string $path, array $options = []): array
    {
        $retry = $this->resolveRetryConfig($options['retry'] ?? false);
        $lastException = null;

        for ($attempt = 1; $attempt <= $retry['attempts']; $attempt++) {
            try {
                return $this->sendRequest($path, $options, $retry, $attempt);
            } catch (SunApiSdkError $exception) {
                $lastException = $exception;
                if (
                    $attempt >= $retry['attempts']
                    || $exception->status === null
                    || !in_array($exception->status, $retry['statuses'], true)
                ) {
                    throw $exception;
                }

                usleep(100_000 * $attempt);
            }
        }

        throw $lastException ?? new SunApiSdkError('Request failed.');
    }

    /**
     * @param array{
     *   method?: string,
     *   query?: array<string, scalar|null>,
     *   json?: array<string, mixed>|list<mixed>,
     *   form?: array<string, scalar|null>,
     *   accessToken?: ?string,
     *   retry?: false|array{attempts?: int, statuses?: array<int, int>},
     *   timeoutSeconds?: int
     * } $options
     * @param array{attempts: int, statuses: array<int, int>} $retry
     */
    private function sendRequest(string $path, array $options, array $retry, int $attempt): array
    {
        $url = $this->buildUrl($path, $options['query'] ?? []);
        $headers = array_merge(['Accept: application/json'], $this->defaultHeaders);

        if (array_key_exists('json', $options)) {
            $headers[] = 'Content-Type: application/json';
        } elseif (array_key_exists('form', $options)) {
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
        }

        $resolvedAccessToken = self::normalizeToken($options['accessToken'] ?? $this->accessToken);
        if ($resolvedAccessToken !== null) {
            $headers[] = 'Authorization: Bearer ' . $resolvedAccessToken;
        }

        $handle = curl_init($url);
        if ($handle === false) {
            throw new SunApiSdkError('Unable to initialize cURL.');
        }

        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($handle, CURLOPT_CUSTOMREQUEST, $options['method'] ?? 'GET');
        curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($handle, CURLOPT_TIMEOUT, $options['timeoutSeconds'] ?? $this->timeoutSeconds ?? 0);

        if (array_key_exists('json', $options)) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($options['json'], JSON_THROW_ON_ERROR));
        } elseif (array_key_exists('form', $options)) {
            curl_setopt($handle, CURLOPT_POSTFIELDS, http_build_query($this->normalizeQuery($options['form'])));
        }

        $body = curl_exec($handle);
        $status = curl_getinfo($handle, CURLINFO_RESPONSE_CODE);
        $error = curl_error($handle);
        curl_close($handle);

        if ($body === false) {
            throw new SunApiSdkError($error !== '' ? $error : 'Request failed.', $status > 0 ? $status : null);
        }

        $decoded = json_decode($body, true);

        if ($status < 200 || $status >= 300) {
            if ($attempt < $retry['attempts'] && in_array($status, $retry['statuses'], true)) {
                throw new SunApiSdkError('Retryable request failed.', $status > 0 ? $status : null, null, $decoded);
            }

            throw new SunApiSdkError(
                is_array($decoded) && isset($decoded['message']) ? (string) $decoded['message'] : 'Request failed.',
                $status > 0 ? $status : null,
                is_array($decoded) && isset($decoded['code']) ? (string) $decoded['code'] : null,
                $decoded
            );
        }

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * @param false|array{attempts?: int, statuses?: array<int, int>} $retry
     * @return array{attempts: int, statuses: array<int, int>}
     */
    private function resolveRetryConfig(false|array $retry): array
    {
        if ($retry === false) {
            return ['attempts' => 1, 'statuses' => []];
        }

        return [
            'attempts' => max(1, (int) ($retry['attempts'] ?? 2)),
            'statuses' => $retry['statuses'] ?? [408, 429, 502, 503, 504],
        ];
    }

    /**
     * @param array<string, scalar|null> $query
     */
    private function buildUrl(string $path, array $query): string
    {
        $url = $this->baseUrl . $path;
        $normalizedQuery = $this->normalizeQuery($query);
        if ($normalizedQuery === []) {
            return $url;
        }

        return $url . '?' . http_build_query($normalizedQuery);
    }

    /**
     * @param array<string, scalar|null> $query
     * @return array<string, scalar>
     */
    private function normalizeQuery(array $query): array
    {
        $normalized = [];

        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_string($value)) {
                $trimmed = trim($value);
                if ($trimmed === '') {
                    continue;
                }

                $normalized[$key] = $trimmed;
                continue;
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }

    private static function normalizeBaseUrl(?string $baseUrl): string
    {
        if (!is_string($baseUrl)) {
            return self::DEFAULT_BASE_URL;
        }

        $trimmed = trim($baseUrl);

        return $trimmed !== '' ? $trimmed : self::DEFAULT_BASE_URL;
    }

    private static function normalizeToken(?string $token): ?string
    {
        if (!is_string($token)) {
            return null;
        }

        $trimmed = trim($token);

        return $trimmed !== '' ? $trimmed : null;
    }
}
