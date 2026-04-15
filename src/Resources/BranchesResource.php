<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class BranchesResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request('/api/v2/branches', ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request('/api/v2/branches', ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request('/api/v2/branches/' . rawurlencode($id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request('/api/v2/branches/' . rawurlencode($id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function listCorrelatives(array $query = []): array
    {
        return $this->request('/api/v2/correlatives', ['query' => $query]);
    }

    public function getCorrelativeDocumentTypes(): array
    {
        return $this->request('/api/v2/correlatives/document-types');
    }
}
