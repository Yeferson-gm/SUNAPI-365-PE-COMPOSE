<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class CredentialsResource extends AbstractResource
{
    public function getSunat(string $companyId): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'sunat-credentials'));
    }

    public function updateSunat(string $companyId, array $payload): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'sunat-credentials'), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function getGre(string $companyId): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'gre-credentials'));
    }

    public function updateGre(string $companyId, array $payload): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'gre-credentials'), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function testGre(string $companyId, string $environment): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'gre-credentials/test-connection'), [
            'method' => 'POST',
            'json' => ['environment' => $this->assertEnvironment($environment)],
        ]);
    }

    public function clearGre(string $companyId, string $environment): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'gre-credentials/clear'), [
            'method' => 'DELETE',
            'json' => ['environment' => $this->assertEnvironment($environment)],
        ]);
    }

    public function copyGre(string $companyId, string $fromEnvironment, string $toEnvironment): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'gre-credentials/copy'), [
            'method' => 'POST',
            'json' => [
                'fromEnvironment' => $this->assertEnvironment($fromEnvironment),
                'toEnvironment' => $this->assertEnvironment($toEnvironment),
            ],
        ]);
    }

    public function getGreDefaults(string $mode): array
    {
        return $this->request($this->resourcePath('gre-credentials/defaults', $mode));
    }
}
