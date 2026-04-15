<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class CustomersResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request('/api/v2/customers', ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request('/api/v2/customers', ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request('/api/v2/customers/' . rawurlencode($id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request('/api/v2/customers/' . rawurlencode($id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function searchByDocument(array $payload): array
    {
        return $this->request('/api/v2/customers/search-by-document', [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }
}
