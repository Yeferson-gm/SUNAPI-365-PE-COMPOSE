<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class AuthResource extends AbstractResource
{
    public function oauthToken(array $payload): array
    {
        return $this->request('/oauth/token', [
            'method' => 'POST',
            'form' => $payload,
        ]);
    }

    public function oauthClientCredentials(string $clientId, string $clientSecret): array
    {
        return $this->oauthToken([
            'grantType' => 'clientCredentials',
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]);
    }

    public function oauthPassword(
        string $email,
        string $password,
        ?string $clientId = null,
        ?string $clientSecret = null
    ): array {
        return $this->oauthToken([
            'grantType' => 'password',
            'email' => $email,
            'password' => $password,
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]);
    }

    public function oauthRefreshToken(string $refreshToken): array
    {
        return $this->oauthToken([
            'grantType' => 'refreshToken',
            'refreshToken' => $refreshToken,
        ]);
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

    public function getIntegrationCredentials(): array
    {
        return $this->request('/api/v2/auth/settings/credentials');
    }
}
