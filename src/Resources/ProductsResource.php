<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class ProductsResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request($this->resourcePath('products'), ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request($this->resourcePath('products'), ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request($this->resourcePath('products', $id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('products', $id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function delete(string $id): array
    {
        return $this->request($this->resourcePath('products', $id), [
            'method' => 'DELETE',
        ]);
    }
}
