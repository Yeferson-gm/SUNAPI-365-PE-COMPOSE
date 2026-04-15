<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class CatalogsResource extends AbstractResource
{
    public function getCapabilities(): array
    {
        return $this->request('/api/v2/system/capabilities');
    }

    public function getErrors(): array
    {
        return $this->request('/api/v2/system/errors');
    }

    public function getKnowledgeGuides(): array
    {
        return $this->request('/api/v2/knowledge-guides');
    }

    public function getKnowledgeGuide(string $code): array
    {
        return $this->request('/api/v2/knowledge-guides/' . rawurlencode($code));
    }

    public function getTaxZoneGuides(): array
    {
        return $this->request('/api/v2/tax/zone-guides');
    }

    public function searchTaxZoneGuide(string $query): array
    {
        return $this->request('/api/v2/tax/zone-guides/search', [
            'query' => ['q' => $query],
        ]);
    }

    public function getSystemInfo(string $environment = 'sandbox'): array
    {
        return $this->request('/api/' . $environment . '/v2/system/info');
    }

    public function initializeSystem(array $payload, ?string $setupToken = null): array
    {
        return $this->request('/api/setup/initialize', [
            'method' => 'POST',
            'json' => $payload,
            'setupToken' => $setupToken,
        ]);
    }

    public function getGeoRegions(): array
    {
        return $this->request('/api/v2/geo/regions');
    }

    public function getGeoProvinces(?string $regionId = null): array
    {
        return $this->request('/api/v2/geo/provinces', [
            'query' => ['regionId' => $regionId],
        ]);
    }

    public function getGeoDistricts(?string $provinceId = null): array
    {
        return $this->request('/api/v2/geo/districts', [
            'query' => ['provinceId' => $provinceId],
        ]);
    }

    public function searchGeo(string $query): array
    {
        return $this->request('/api/v2/geo/search', [
            'query' => ['q' => $query],
        ]);
    }

    public function getGeoLocation(string $id): array
    {
        return $this->request('/api/v2/geo/' . rawurlencode($id));
    }

    public function getTaxAffectationTypes(): array
    {
        return $this->request('/api/v2/tax/affectation-types');
    }

    public function getTaxProductProfiles(): array
    {
        return $this->request('/api/v2/tax/product-profiles');
    }

    public function evaluateTaxUbigeo(string $ubigeo): array
    {
        return $this->request('/api/v2/tax/evaluate-ubigeo', [
            'query' => ['ubigeo' => $ubigeo],
        ]);
    }

    public function getTaxAppendix(): array
    {
        return $this->request('/api/v2/tax/appendix');
    }

    public function getIscRates(): array
    {
        return $this->request('/api/v2/tax/isc-rates');
    }

    public function getUnits(): array
    {
        return $this->request('/api/v2/tax/units');
    }

    public function getPaymentMethods(): array
    {
        return $this->request('/api/v2/tax/payment-methods');
    }

    public function getDetractions(): array
    {
        return $this->request('/api/v2/tax/detractions');
    }

    public function getCurrencyRates(): array
    {
        return $this->request('/api/v2/currency/rates');
    }

    public function convertCurrency(float|int $amount, string $from, string $to): array
    {
        return $this->request('/api/v2/currency/convert', [
            'method' => 'POST',
            'json' => ['amount' => $amount, 'from' => $from, 'to' => $to],
        ]);
    }

    public function getPdfFormats(string $environment): array
    {
        return $this->request('/api/' . $environment . '/v2/pdf/formats');
    }

    public function getDispatchGuideTransferReasons(string $environment): array
    {
        return $this->request('/api/' . $environment . '/v2/dispatch-guides/catalogs/transfer-reasons');
    }

    public function getDispatchGuideTransportModes(string $environment): array
    {
        return $this->request('/api/' . $environment . '/v2/dispatch-guides/catalogs/transport-modes');
    }

    public function getVoidedReasons(string $environment): array
    {
        return $this->request('/api/' . $environment . '/v2/voided-documents/reasons');
    }

    public function listVoidedAvailableDocuments(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/voided-documents/available-documents', [
            'query' => $query,
        ]);
    }
}
