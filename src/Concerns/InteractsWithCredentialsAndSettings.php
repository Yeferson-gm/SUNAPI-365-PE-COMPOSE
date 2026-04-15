<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Concerns;

trait InteractsWithCredentialsAndSettings
{
    public function getSunatCredentials(string $companyId): array
    {
        return $this->credentials->getSunat($companyId);
    }

    public function updateSunatCredentials(string $companyId, array $payload): array
    {
        return $this->credentials->updateSunat($companyId, $payload);
    }

    public function getGreCredentials(string $companyId): array
    {
        return $this->credentials->getGre($companyId);
    }

    public function updateGreCredentials(string $companyId, array $payload): array
    {
        return $this->credentials->updateGre($companyId, $payload);
    }

    public function testGreCredentials(string $companyId, string $environment): array
    {
        return $this->credentials->testGre($companyId, $environment);
    }

    public function clearGreCredentials(string $companyId, string $environment): array
    {
        return $this->credentials->clearGre($companyId, $environment);
    }

    public function copyGreCredentials(
        string $companyId,
        string $fromEnvironment,
        string $toEnvironment
    ): array {
        return $this->credentials->copyGre($companyId, $fromEnvironment, $toEnvironment);
    }

    public function getGreDefaults(string $mode): array
    {
        return $this->credentials->getGreDefaults($mode);
    }

    public function getPdfFormats(string $environment): array
    {
        return $this->settings->getPdfFormats($environment);
    }

    public function getCompanyPdfInfo(string $environment, string $companyId): array
    {
        return $this->settings->getCompanyPdfInfo($environment, $companyId);
    }

    public function updateCompanyPdfInfo(
        string $environment,
        string $companyId,
        array $payload
    ): array {
        return $this->settings->updateCompanyPdfInfo($environment, $companyId, $payload);
    }

    public function getCompanyConfig(string $environment, string $companyId): array
    {
        return $this->settings->getCompanyConfig($environment, $companyId);
    }

    public function validateCompanyServices(string $environment, string $companyId): array
    {
        return $this->settings->validateCompanyServices($environment, $companyId);
    }

    public function getCompanyConfigSection(
        string $environment,
        string $companyId,
        string $section
    ): array {
        return $this->settings->getCompanyConfigSection($environment, $companyId, $section);
    }

    public function updateCompanyConfigSection(
        string $environment,
        string $companyId,
        string $section,
        array $payload
    ): array {
        return $this->settings->updateCompanyConfigSection(
            $environment,
            $companyId,
            $section,
            $payload
        );
    }

    public function resetCompanyConfig(
        string $environment,
        string $companyId,
        ?string $section = null
    ): array {
        return $this->settings->resetCompanyConfig($environment, $companyId, $section);
    }

    public function getConfigDefaults(string $environment): array
    {
        return $this->settings->getConfigDefaults($environment);
    }

    public function getConfigSummary(string $environment, array $companyIds = []): array
    {
        return $this->settings->getConfigSummary($environment, $companyIds);
    }
}
