<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class ProductsResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request('/api/v2/products', ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request('/api/v2/products', ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request('/api/v2/products/' . rawurlencode($id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request('/api/v2/products/' . rawurlencode($id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function delete(string $id): array
    {
        return $this->request('/api/v2/products/' . rawurlencode($id), [
            'method' => 'DELETE',
        ]);
    }
}
