<?php

declare(strict_types=1);

namespace SunApi365\Sdk;

use SunApi365\Sdk\Concerns\InteractsWithAuthAndCatalogs;
use SunApi365\Sdk\Concerns\InteractsWithBusinessResources;
use SunApi365\Sdk\Concerns\InteractsWithCredentialsAndSettings;
use SunApi365\Sdk\Concerns\InteractsWithDocuments;
use SunApi365\Sdk\Concerns\InteractsWithTickets;
use SunApi365\Sdk\Concerns\InteractsWithWebhooks;
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
use SunApi365\Sdk\Resources\TicketsResource;
use SunApi365\Sdk\Resources\WebhooksResource;

final class SunApiSdk
{
    use InteractsWithAuthAndCatalogs;
    use InteractsWithBusinessResources;
    use InteractsWithCredentialsAndSettings;
    use InteractsWithDocuments;
    use InteractsWithTickets;
    use InteractsWithWebhooks;

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

    private readonly TicketsResource $tickets;

    /**
     * @param array<int, string> $defaultHeaders
     */
    public function __construct(
        ?string $baseUrl = null,
        ?string $accessToken = null,
        array $defaultHeaders = [],
        ?int $timeoutSeconds = null
    ) {
        $this->client = new SunApiHttpClient($baseUrl, $accessToken, $defaultHeaders, $timeoutSeconds);
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
        $this->tickets = new TicketsResource($this->client);
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

    public function tickets(): TicketsResource
    {
        return $this->tickets;
    }

    public function setAccessToken(?string $token): self
    {
        $this->client->setAccessToken($token);

        return $this;
    }

    public function request(string $path, array $options = []): array
    {
        return $this->client->request($path, $options);
    }
}
