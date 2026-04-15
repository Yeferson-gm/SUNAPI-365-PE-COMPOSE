<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class CompaniesResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request('/api/v2/companies', ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request('/api/v2/companies', ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request('/api/v2/companies/' . rawurlencode($id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request('/api/v2/companies/' . rawurlencode($id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }
}
