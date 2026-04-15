<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class CompaniesResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request($this->resourcePath('companies'), ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request($this->resourcePath('companies'), ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request($this->resourcePath('companies', $id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('companies', $id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function deactivate(string $id): array
    {
        return $this->request($this->resourcePath('companies', $id), [
            'method' => 'DELETE',
        ]);
    }

    public function activate(string $id): array
    {
        return $this->request($this->resourcePath('companies', $id, 'activate'), [
            'method' => 'POST',
        ]);
    }

    public function toggleProduction(string $id): array
    {
        return $this->request($this->resourcePath('companies', $id, 'toggle-production'), [
            'method' => 'POST',
        ]);
    }

    public function listBranches(string $companyId): array
    {
        return $this->request($this->resourcePath('companies', $companyId, 'branches'));
    }
}
