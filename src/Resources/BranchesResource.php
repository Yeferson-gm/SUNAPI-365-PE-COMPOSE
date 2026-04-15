<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class BranchesResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request($this->resourcePath('branches'), ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request($this->resourcePath('branches'), ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request($this->resourcePath('branches', $id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('branches', $id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function deactivate(string $id): array
    {
        return $this->request($this->resourcePath('branches', $id), [
            'method' => 'DELETE',
        ]);
    }

    public function activate(string $id): array
    {
        return $this->request($this->resourcePath('branches', $id, 'activate'), [
            'method' => 'POST',
        ]);
    }

    public function listCorrelatives(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'correlatives'), ['query' => $query]);
    }

    public function activateCorrelativeSeries(string $environment, array $payload): array
    {
        return $this->request($this->versionedPath($environment, 'correlatives/active-series'), [
            'method' => 'PATCH',
            'json' => $payload,
        ]);
    }

    public function getCorrelativeDocumentTypes(): array
    {
        return $this->request($this->resourcePath('correlatives', null, 'document-types'));
    }
}
