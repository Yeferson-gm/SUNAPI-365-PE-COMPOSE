<?php

declare(strict_types=1);

namespace SunApi365\Sdk;

use SunApi365\Sdk\Http\SunApiHttpClient;
use SunApi365\Sdk\Resources\AuthResource;
use SunApi365\Sdk\Resources\BranchesResource;
use SunApi365\Sdk\Resources\CatalogsResource;
use SunApi365\Sdk\Resources\CompaniesResource;
use SunApi365\Sdk\Resources\CredentialsResource;
use SunApi365\Sdk\Resources\CustomersResource;
use SunApi365\Sdk\Resources\DocumentsResource;
use SunApi365\Sdk\Resources\ProductsResource;
use SunApi365\Sdk\Resources\SettingsResource;
use SunApi365\Sdk\Resources\WebhooksResource;

final class SunApiSdk
{
    private readonly SunApiHttpClient $client;

    private readonly AuthResource $auth;

    private readonly CatalogsResource $catalogs;

    private readonly CompaniesResource $companies;

    private readonly BranchesResource $branches;

    private readonly CustomersResource $customers;

    private readonly ProductsResource $products;

    private readonly CredentialsResource $credentials;

    private readonly SettingsResource $settings;

    private readonly WebhooksResource $webhooks;

    private readonly DocumentsResource $documents;

    /**
     * @param array<int, string> $defaultHeaders
     */
    public function __construct(
        ?string $baseUrl = null,
        ?string $setupToken = null,
        ?string $accessToken = null,
        array $defaultHeaders = []
    ) {
        $this->client = new SunApiHttpClient($baseUrl, $setupToken, $accessToken, $defaultHeaders);
        $this->auth = new AuthResource($this->client);
        $this->catalogs = new CatalogsResource($this->client);
        $this->companies = new CompaniesResource($this->client);
        $this->branches = new BranchesResource($this->client);
        $this->customers = new CustomersResource($this->client);
        $this->products = new ProductsResource($this->client);
        $this->credentials = new CredentialsResource($this->client);
        $this->settings = new SettingsResource($this->client);
        $this->webhooks = new WebhooksResource($this->client);
        $this->documents = new DocumentsResource($this->client);
    }

    public function auth(): AuthResource
    {
        return $this->auth;
    }

    public function catalogs(): CatalogsResource
    {
        return $this->catalogs;
    }

    public function companies(): CompaniesResource
    {
        return $this->companies;
    }

    public function branches(): BranchesResource
    {
        return $this->branches;
    }

    public function customers(): CustomersResource
    {
        return $this->customers;
    }

    public function products(): ProductsResource
    {
        return $this->products;
    }

    public function credentials(): CredentialsResource
    {
        return $this->credentials;
    }

    public function settings(): SettingsResource
    {
        return $this->settings;
    }

    public function webhooks(): WebhooksResource
    {
        return $this->webhooks;
    }

    public function documents(): DocumentsResource
    {
        return $this->documents;
    }

    public function setAccessToken(?string $token): self
    {
        $this->client->setAccessToken($token);

        return $this;
    }

    public function setSetupToken(?string $token): self
    {
        $this->client->setSetupToken($token);

        return $this;
    }

    public function getCapabilities(): array { return $this->catalogs->getCapabilities(); }
    public function getErrors(): array { return $this->catalogs->getErrors(); }
    public function getKnowledgeGuides(): array { return $this->catalogs->getKnowledgeGuides(); }
    public function getKnowledgeGuide(string $code): array { return $this->catalogs->getKnowledgeGuide($code); }
    public function getTaxZoneGuides(): array { return $this->catalogs->getTaxZoneGuides(); }
    public function searchTaxZoneGuide(string $query): array { return $this->catalogs->searchTaxZoneGuide($query); }
    public function getSystemInfo(string $environment = 'sandbox'): array { return $this->catalogs->getSystemInfo($environment); }
    public function initializeSystem(array $payload, ?string $setupToken = null): array { return $this->catalogs->initializeSystem($payload, $setupToken); }
    public function oauthToken(array $payload): array { return $this->auth->oauthToken($payload); }
    public function oauthClientCredentials(string $clientId, string $clientSecret): array { return $this->auth->oauthClientCredentials($clientId, $clientSecret); }
    public function oauthPassword(string $email, string $password, ?string $clientId = null, ?string $clientSecret = null): array { return $this->auth->oauthPassword($email, $password, $clientId, $clientSecret); }
    public function oauthRefreshToken(string $refreshToken): array { return $this->auth->oauthRefreshToken($refreshToken); }
    public function getCurrentUser(): array { return $this->auth->getCurrentUser(); }
    public function logout(array $payload): array { return $this->auth->logout($payload); }
    public function getIntegrationCredentials(): array { return $this->auth->getIntegrationCredentials(); }
    public function getGeoRegions(): array { return $this->catalogs->getGeoRegions(); }
    public function getGeoProvinces(?string $regionId = null): array { return $this->catalogs->getGeoProvinces($regionId); }
    public function getGeoDistricts(?string $provinceId = null): array { return $this->catalogs->getGeoDistricts($provinceId); }
    public function searchGeo(string $query): array { return $this->catalogs->searchGeo($query); }
    public function getGeoLocation(string $id): array { return $this->catalogs->getGeoLocation($id); }
    public function getTaxAffectationTypes(): array { return $this->catalogs->getTaxAffectationTypes(); }
    public function getTaxProductProfiles(): array { return $this->catalogs->getTaxProductProfiles(); }
    public function evaluateTaxUbigeo(string $ubigeo): array { return $this->catalogs->evaluateTaxUbigeo($ubigeo); }
    public function getTaxAppendix(): array { return $this->catalogs->getTaxAppendix(); }
    public function getIscRates(): array { return $this->catalogs->getIscRates(); }
    public function getUnits(): array { return $this->catalogs->getUnits(); }
    public function getPaymentMethods(): array { return $this->catalogs->getPaymentMethods(); }
    public function getDetractions(): array { return $this->catalogs->getDetractions(); }
    public function listCompanies(array $query = []): array { return $this->companies->list($query); }
    public function createCompany(array $payload): array { return $this->companies->create($payload); }
    public function getCompany(string $id): array { return $this->companies->get($id); }
    public function updateCompany(string $id, array $payload): array { return $this->companies->update($id, $payload); }
    public function listBranches(array $query = []): array { return $this->branches->list($query); }
    public function createBranch(array $payload): array { return $this->branches->create($payload); }
    public function getBranch(string $id): array { return $this->branches->get($id); }
    public function updateBranch(string $id, array $payload): array { return $this->branches->update($id, $payload); }
    public function listCustomers(array $query = []): array { return $this->customers->list($query); }
    public function createCustomer(array $payload): array { return $this->customers->create($payload); }
    public function getCustomer(string $id): array { return $this->customers->get($id); }
    public function updateCustomer(string $id, array $payload): array { return $this->customers->update($id, $payload); }
    public function searchCustomerByDocument(array $payload): array { return $this->customers->searchByDocument($payload); }
    public function listProducts(array $query = []): array { return $this->products->list($query); }
    public function createProduct(array $payload): array { return $this->products->create($payload); }
    public function getProduct(string $id): array { return $this->products->get($id); }
    public function updateProduct(string $id, array $payload): array { return $this->products->update($id, $payload); }
    public function deleteProduct(string $id): array { return $this->products->delete($id); }
    public function listCorrelatives(array $query = []): array { return $this->branches->listCorrelatives($query); }
    public function getCorrelativeDocumentTypes(): array { return $this->branches->getCorrelativeDocumentTypes(); }
    public function getSunatCredentials(string $companyId): array { return $this->credentials->getSunat($companyId); }
    public function updateSunatCredentials(string $companyId, array $payload): array { return $this->credentials->updateSunat($companyId, $payload); }
    public function getGreCredentials(string $companyId): array { return $this->credentials->getGre($companyId); }
    public function updateGreCredentials(string $companyId, array $payload): array { return $this->credentials->updateGre($companyId, $payload); }
    public function testGreCredentials(string $companyId, string $environment): array { return $this->credentials->testGre($companyId, $environment); }
    public function clearGreCredentials(string $companyId, string $environment): array { return $this->credentials->clearGre($companyId, $environment); }
    public function copyGreCredentials(string $companyId, string $fromEnvironment, string $toEnvironment): array { return $this->credentials->copyGre($companyId, $fromEnvironment, $toEnvironment); }
    public function getGreDefaults(string $mode): array { return $this->credentials->getGreDefaults($mode); }
    public function getCurrencyRates(): array { return $this->catalogs->getCurrencyRates(); }
    public function convertCurrency(float|int $amount, string $from, string $to): array { return $this->catalogs->convertCurrency($amount, $from, $to); }
    public function getPdfFormats(string $environment): array { return $this->settings->getPdfFormats($environment); }
    public function getCompanyPdfInfo(string $environment, string $companyId): array { return $this->settings->getCompanyPdfInfo($environment, $companyId); }
    public function updateCompanyPdfInfo(string $environment, string $companyId, array $payload): array { return $this->settings->updateCompanyPdfInfo($environment, $companyId, $payload); }
    public function getCompanyConfig(string $environment, string $companyId): array { return $this->settings->getCompanyConfig($environment, $companyId); }
    public function validateCompanyServices(string $environment, string $companyId): array { return $this->settings->validateCompanyServices($environment, $companyId); }
    public function getCompanyConfigSection(string $environment, string $companyId, string $section): array { return $this->settings->getCompanyConfigSection($environment, $companyId, $section); }
    public function updateCompanyConfigSection(string $environment, string $companyId, string $section, array $payload): array { return $this->settings->updateCompanyConfigSection($environment, $companyId, $section, $payload); }
    public function resetCompanyConfig(string $environment, string $companyId, ?string $section = null): array { return $this->settings->resetCompanyConfig($environment, $companyId, $section); }
    public function migrateCompanyConfig(string $environment, string $companyId): array { return $this->settings->migrateCompanyConfig($environment, $companyId); }
    public function clearCompanyConfigCache(string $environment, string $companyId): array { return $this->settings->clearCompanyConfigCache($environment, $companyId); }
    public function getConfigDefaults(string $environment): array { return $this->settings->getConfigDefaults($environment); }
    public function getConfigSummary(string $environment, array $companyIds = []): array { return $this->settings->getConfigSummary($environment, $companyIds); }
    public function listWebhooks(array $query = []): array { return $this->webhooks->list($query); }
    public function createWebhook(array $payload): array { return $this->webhooks->create($payload); }
    public function getWebhook(string $id): array { return $this->webhooks->get($id); }
    public function updateWebhook(string $id, array $payload): array { return $this->webhooks->update($id, $payload); }
    public function deleteWebhook(string $id): array { return $this->webhooks->delete($id); }
    public function testWebhook(string $id): array { return $this->webhooks->test($id); }
    public function getWebhookStatistics(string $id): array { return $this->webhooks->statistics($id); }
    public function getWebhookDeliveries(string $id): array { return $this->webhooks->deliveries($id); }
    public function retryWebhookDelivery(string $deliveryId): array { return $this->webhooks->retryDelivery($deliveryId); }
    public function listDocuments(string $environment, string $resource, array $query = []): array { return $this->documents->list($environment, $resource, $query); }
    public function createDocument(string $environment, string $resource, array $payload): array { return $this->documents->create($environment, $resource, $payload); }
    public function getDocument(string $environment, string $resource, string $id): array { return $this->documents->get($environment, $resource, $id); }
    public function updateDocument(string $environment, string $resource, string $id, array $payload): array { return $this->documents->update($environment, $resource, $id, $payload); }
    public function sendDocumentToSunat(string $environment, string $resource, string $id, string $mode = 'async'): array { return $this->documents->sendToSunat($environment, $resource, $id, $mode); }
    public function checkDocumentStatus(string $environment, string $resource, string $id): array { return $this->documents->checkStatus($environment, $resource, $id); }
    public function generateDocumentPdf(string $environment, string $resource, string $id, string $format = 'A4'): array { return $this->documents->generatePdf($environment, $resource, $id, $format); }
    public function downloadDocumentFile(string $environment, string $resource, string $id, string $fileType): array { return $this->documents->downloadFile($environment, $resource, $id, $fileType); }
    public function listDailySummaryPendingReceipts(string $environment, array $query = []): array { return $this->documents->listDailySummaryPendingReceipts($environment, $query); }
    public function createDailySummaryFromPendingReceipts(string $environment, array $payload): array { return $this->documents->createDailySummaryFromPendingReceipts($environment, $payload); }
    public function listReceiptPendingForSummary(string $environment, array $query = []): array { return $this->documents->listReceiptPendingForSummary($environment, $query); }
    public function listReceiptPendingSummaryDates(string $environment, array $query = []): array { return $this->documents->listReceiptPendingSummaryDates($environment, $query); }
    public function listExpiredReceipts(string $environment, array $query = []): array { return $this->documents->listExpiredReceipts($environment, $query); }
    public function listVoidableReceipts(string $environment, array $query = []): array { return $this->documents->listVoidableReceipts($environment, $query); }
    public function listPendingVoidReceipts(string $environment, array $query = []): array { return $this->documents->listPendingVoidReceipts($environment, $query); }
    public function listVoidedReceipts(string $environment, array $query = []): array { return $this->documents->listVoidedReceipts($environment, $query); }
    public function voidReceiptsLocally(string $environment, array $payload): array { return $this->documents->voidReceiptsLocally($environment, $payload); }
    public function voidReceiptsOfficially(string $environment, array $payload): array { return $this->documents->voidReceiptsOfficially($environment, $payload); }
    public function sendReceiptSummaryToSunat(string $environment, string $id, string $mode = 'async'): array { return $this->documents->sendReceiptSummaryToSunat($environment, $id, $mode); }
    public function checkReceiptSummaryStatus(string $environment, string $id): array { return $this->documents->checkReceiptSummaryStatus($environment, $id); }
    public function listInvoicesByStatus(string $environment, array $input): array { return $this->documents->listInvoicesByStatus($environment, $input); }
    public function listReceiptsByStatus(string $environment, array $input): array { return $this->documents->listReceiptsByStatus($environment, $input); }
    public function getDispatchGuideTransferReasons(string $environment): array { return $this->catalogs->getDispatchGuideTransferReasons($environment); }
    public function getDispatchGuideTransportModes(string $environment): array { return $this->catalogs->getDispatchGuideTransportModes($environment); }
    public function getVoidedReasons(string $environment): array { return $this->catalogs->getVoidedReasons($environment); }
    public function listVoidedAvailableDocuments(string $environment, array $query = []): array { return $this->catalogs->listVoidedAvailableDocuments($environment, $query); }

    public function request(string $path, array $options = []): array
    {
        return $this->client->request($path, $options);
    }
}
