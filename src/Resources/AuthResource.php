<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class AuthResource extends AbstractResource
{
    public function refreshAccessToken(string $refreshToken): array
    {
        return $this->request('/oauth/token', [
            'method' => 'POST',
            'json' => [
                'refreshToken' => $refreshToken,
            ],
        ]);
    }

    public function exchangeSocialSession(): array
    {
        return $this->request('/api/v2/auth/social/exchange', [
            'method' => 'POST',
            'json' => [],
        ]);
    }

    public function refreshAndSetAccessToken(string $refreshToken): array
    {
        $response = $this->refreshAccessToken($refreshToken);
        $accessToken = $response['accessToken'] ?? $response['data']['accessToken'] ?? null;

        if (is_string($accessToken) && trim($accessToken) !== '') {
            $this->client->setAccessToken($accessToken);
        }

        return $response;
    }

    public function getCurrentUser(): array
    {
        return $this->request('/api/v2/auth/me');
    }

    public function logout(array $payload): array
    {
        return $this->request('/api/v2/auth/logout', [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }
}
