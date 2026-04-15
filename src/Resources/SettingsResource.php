<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class SettingsResource extends AbstractResource
{
    public function getPdfFormats(string $environment): array
    {
        return $this->request('/api/' . $environment . '/v2/pdf/formats');
    }

    public function getCompanyPdfInfo(string $environment, string $companyId): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/pdf-info');
    }

    public function updateCompanyPdfInfo(string $environment, string $companyId, array $payload): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/pdf-info', [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function getCompanyConfig(string $environment, string $companyId): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config');
    }

    public function validateCompanyServices(string $environment, string $companyId): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config/validate/services');
    }

    public function getCompanyConfigSection(string $environment, string $companyId, string $section): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config/' . rawurlencode($section));
    }

    public function updateCompanyConfigSection(
        string $environment,
        string $companyId,
        string $section,
        array $payload
    ): array {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config/' . rawurlencode($section), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function resetCompanyConfig(string $environment, string $companyId, ?string $section = null): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config/reset', [
            'method' => 'POST',
            'json' => $section !== null && trim($section) !== '' ? ['section' => trim($section)] : [],
        ]);
    }

    public function migrateCompanyConfig(string $environment, string $companyId): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config/migrate', [
            'method' => 'POST',
        ]);
    }

    public function clearCompanyConfigCache(string $environment, string $companyId): array
    {
        return $this->request('/api/' . $environment . '/v2/companies/' . rawurlencode($companyId) . '/config/cache', [
            'method' => 'DELETE',
        ]);
    }

    public function getConfigDefaults(string $environment): array
    {
        return $this->request('/api/' . $environment . '/v2/config/defaults');
    }

    public function getConfigSummary(string $environment, array $companyIds = []): array
    {
        $query = [];
        if ($companyIds !== []) {
            $query['companyIds'] = implode(',', $companyIds);
        }

        return $this->request('/api/' . $environment . '/v2/config/summary', ['query' => $query]);
    }
}
