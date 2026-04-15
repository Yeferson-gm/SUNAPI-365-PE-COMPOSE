<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Concerns;

trait InteractsWithAuthAndCatalogs
{
    public function getCapabilities(): array
    {
        return $this->catalogs->getCapabilities();
    }

    public function getErrors(): array
    {
        return $this->catalogs->getErrors();
    }

    public function getKnowledgeGuides(): array
    {
        return $this->catalogs->getKnowledgeGuides();
    }

    public function getKnowledgeGuide(string $code): array
    {
        return $this->catalogs->getKnowledgeGuide($code);
    }

    public function getTaxZoneGuides(): array
    {
        return $this->catalogs->getTaxZoneGuides();
    }

    public function searchTaxZoneGuide(string $query): array
    {
        return $this->catalogs->searchTaxZoneGuide($query);
    }

    public function getSystemInfo(string $environment = 'sandbox'): array
    {
        return $this->catalogs->getSystemInfo($environment);
    }

    public function refreshAccessToken(string $refreshToken): array
    {
        return $this->auth->refreshAccessToken($refreshToken);
    }

    public function exchangeSocialSession(): array
    {
        return $this->auth->exchangeSocialSession();
    }

    public function refreshAndSetAccessToken(string $refreshToken): array
    {
        return $this->auth->refreshAndSetAccessToken($refreshToken);
    }

    public function getCurrentUser(): array
    {
        return $this->auth->getCurrentUser();
    }

    public function logout(array $payload): array
    {
        return $this->auth->logout($payload);
    }

    public function getGeoRegions(): array
    {
        return $this->catalogs->getGeoRegions();
    }

    public function getGeoProvinces(?string $regionId = null): array
    {
        return $this->catalogs->getGeoProvinces($regionId);
    }

    public function getGeoDistricts(?string $provinceId = null): array
    {
        return $this->catalogs->getGeoDistricts($provinceId);
    }

    public function searchGeo(string $query): array
    {
        return $this->catalogs->searchGeo($query);
    }

    public function getGeoLocation(string $id): array
    {
        return $this->catalogs->getGeoLocation($id);
    }

    public function getTaxAffectationTypes(): array
    {
        return $this->catalogs->getTaxAffectationTypes();
    }

    public function getTaxProductProfiles(): array
    {
        return $this->catalogs->getTaxProductProfiles();
    }

    public function evaluateTaxUbigeo(string $ubigeo): array
    {
        return $this->catalogs->evaluateTaxUbigeo($ubigeo);
    }

    public function getTaxAppendix(): array
    {
        return $this->catalogs->getTaxAppendix();
    }

    public function getIscRates(): array
    {
        return $this->catalogs->getIscRates();
    }

    public function getUnits(): array
    {
        return $this->catalogs->getUnits();
    }

    public function getPaymentMethods(): array
    {
        return $this->catalogs->getPaymentMethods();
    }

    public function getDetractions(): array
    {
        return $this->catalogs->getDetractions();
    }

    public function getCurrencyRates(): array
    {
        return $this->catalogs->getCurrencyRates();
    }

    public function convertCurrency(float|int $amount, string $from, string $to): array
    {
        return $this->catalogs->convertCurrency($amount, $from, $to);
    }

    public function getDispatchGuideTransferReasons(string $environment): array
    {
        return $this->catalogs->getDispatchGuideTransferReasons($environment);
    }

    public function getDispatchGuideTransportModes(string $environment): array
    {
        return $this->catalogs->getDispatchGuideTransportModes($environment);
    }

    public function getVoidedReasons(string $environment): array
    {
        return $this->catalogs->getVoidedReasons($environment);
    }

    public function listVoidedAvailableDocuments(string $environment, array $query = []): array
    {
        return $this->catalogs->listVoidedAvailableDocuments($environment, $query);
    }
}
