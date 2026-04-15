<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

use SunApi365\Sdk\Http\SunApiHttpClient;
use SunApi365\Sdk\SunApiSdkError;

abstract class AbstractResource
{
    private const VALID_ENVIRONMENTS = ['sandbox', 'production'];

    private const VALID_DOCUMENT_RESOURCES = [
        'invoices',
        'receipts',
        'credit-notes',
        'debit-notes',
        'daily-summaries',
        'dispatch-guides',
        'voided-documents',
    ];

    private const VALID_DOCUMENT_FILE_TYPES = ['pdf', 'xml', 'cdr'];

    private const VALID_SUNAT_MODES = ['sync', 'async'];

    public function __construct(protected readonly SunApiHttpClient $client)
    {
    }

    /**
     * @param array{
     *   method?: string,
     *   query?: array<string, scalar|null>,
     *   json?: array<string, mixed>|list<mixed>,
     *   form?: array<string, scalar|null>,
     *   accessToken?: ?string
     * } $options
     */
    protected function request(string $path, array $options = []): array
    {
        return $this->client->request($path, $options);
    }

    protected function apiPath(string $suffix): string
    {
        return '/api/v2/' . ltrim($suffix, '/');
    }

    protected function resourcePath(string $resource, ?string $id = null, string $suffix = ''): string
    {
        $path = trim($resource, '/');

        if ($id !== null) {
            $path .= '/' . rawurlencode($id);
        }

        if (trim($suffix) !== '') {
            $path .= '/' . ltrim($suffix, '/');
        }

        return $this->apiPath($path);
    }

    protected function documentBasePath(string $environment, string $resource): string
    {
        return $this->versionedPath($environment, $this->assertDocumentResource($resource));
    }

    protected function versionedPath(string $environment, string $suffix): string
    {
        return '/api/' . $this->assertEnvironment($environment) . '/v2/' . ltrim($suffix, '/');
    }

    protected function versionedResourcePath(string $environment, string $resource, ?string $id = null, string $suffix = ''): string
    {
        $path = trim($resource, '/');

        if ($id !== null) {
            $path .= '/' . rawurlencode($id);
        }

        if (trim($suffix) !== '') {
            $path .= '/' . ltrim($suffix, '/');
        }

        return $this->versionedPath($environment, $path);
    }

    protected function assertEnvironment(string $environment): string
    {
        $normalized = trim($environment);

        if (!in_array($normalized, self::VALID_ENVIRONMENTS, true)) {
            throw new SunApiSdkError(
                'Invalid environment. Expected one of: sandbox, production.',
                null,
                'invalid_environment',
                ['environment' => $environment]
            );
        }

        return $normalized;
    }

    protected function assertSunatMode(string $mode): string
    {
        $normalized = trim($mode);

        if (!in_array($normalized, self::VALID_SUNAT_MODES, true)) {
            throw new SunApiSdkError(
                'Invalid SUNAT mode. Expected one of: sync, async.',
                null,
                'invalid_sunat_mode',
                ['mode' => $mode]
            );
        }

        return $normalized;
    }

    protected function assertDocumentFileType(string $fileType): string
    {
        $normalized = trim($fileType);

        if (!in_array($normalized, self::VALID_DOCUMENT_FILE_TYPES, true)) {
            throw new SunApiSdkError(
                'Invalid document file type. Expected one of: pdf, xml, cdr.',
                null,
                'invalid_document_file_type',
                ['fileType' => $fileType]
            );
        }

        return $normalized;
    }

    protected function readCreatedId(array $response): ?string
    {
        $id = $response['data']['id'] ?? null;

        return is_string($id) && trim($id) !== '' ? $id : null;
    }

    private function assertDocumentResource(string $resource): string
    {
        $normalized = trim($resource);

        if (!in_array($normalized, self::VALID_DOCUMENT_RESOURCES, true)) {
            throw new SunApiSdkError(
                'Invalid document resource.',
                null,
                'invalid_document_resource',
                ['resource' => $resource]
            );
        }

        return $normalized;
    }
}
