<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Concerns;

trait InteractsWithBusinessResources
{
    public function listCompanies(array $query = []): array
    {
        return $this->companies->list($query);
    }

    public function createCompany(array $payload): array
    {
        return $this->companies->create($payload);
    }

    public function getCompany(string $id): array
    {
        return $this->companies->get($id);
    }

    public function updateCompany(string $id, array $payload): array
    {
        return $this->companies->update($id, $payload);
    }

    public function deactivateCompany(string $id): array
    {
        return $this->companies->deactivate($id);
    }

    public function activateCompany(string $id): array
    {
        return $this->companies->activate($id);
    }

    public function toggleCompanyProduction(string $id): array
    {
        return $this->companies->toggleProduction($id);
    }

    public function listCompanyBranches(string $companyId): array
    {
        return $this->companies->listBranches($companyId);
    }

    public function listBranches(array $query = []): array
    {
        return $this->branches->list($query);
    }

    public function createBranch(array $payload): array
    {
        return $this->branches->create($payload);
    }

    public function getBranch(string $id): array
    {
        return $this->branches->get($id);
    }

    public function updateBranch(string $id, array $payload): array
    {
        return $this->branches->update($id, $payload);
    }

    public function deactivateBranch(string $id): array
    {
        return $this->branches->deactivate($id);
    }

    public function activateBranch(string $id): array
    {
        return $this->branches->activate($id);
    }

    public function listCustomers(array $query = []): array
    {
        return $this->customers->list($query);
    }

    public function createCustomer(array $payload): array
    {
        return $this->customers->create($payload);
    }

    public function getCustomer(string $id): array
    {
        return $this->customers->get($id);
    }

    public function updateCustomer(string $id, array $payload): array
    {
        return $this->customers->update($id, $payload);
    }

    public function deleteCustomer(string $id): array
    {
        return $this->customers->delete($id);
    }

    public function listCompanyCustomers(string $companyId): array
    {
        return $this->customers->listByCompany($companyId);
    }

    public function searchCustomerByDocument(array $payload): array
    {
        return $this->customers->searchByDocument($payload);
    }

    public function listProducts(array $query = []): array
    {
        return $this->products->list($query);
    }

    public function createProduct(array $payload): array
    {
        return $this->products->create($payload);
    }

    public function getProduct(string $id): array
    {
        return $this->products->get($id);
    }

    public function updateProduct(string $id, array $payload): array
    {
        return $this->products->update($id, $payload);
    }

    public function deleteProduct(string $id): array
    {
        return $this->products->delete($id);
    }

    public function listCorrelatives(string $environment, array $query = []): array
    {
        return $this->branches->listCorrelatives($environment, $query);
    }

    public function activateCorrelativeSeries(string $environment, array $payload): array
    {
        return $this->branches->activateCorrelativeSeries($environment, $payload);
    }

    public function getCorrelativeDocumentTypes(): array
    {
        return $this->branches->getCorrelativeDocumentTypes();
    }
}
