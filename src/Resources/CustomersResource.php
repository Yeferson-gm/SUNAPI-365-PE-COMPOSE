<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class CustomersResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request($this->resourcePath('customers'), ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request($this->resourcePath('customers'), ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request($this->resourcePath('customers', $id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('customers', $id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function delete(string $id): array
    {
        return $this->request($this->resourcePath('customers', $id), [
            'method' => 'DELETE',
        ]);
    }

    public function listByCompany(string $companyId): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'customers'));
    }

    public function searchByDocument(array $payload): array
    {
        return $this->request($this->resourcePath('customers', null, 'search-by-document'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }
}
