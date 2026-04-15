<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class WebhooksResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request($this->resourcePath('webhooks'), ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request($this->resourcePath('webhooks'), ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request($this->resourcePath('webhooks', $id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('webhooks', $id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function delete(string $id): array
    {
        return $this->request($this->resourcePath('webhooks', $id), ['method' => 'DELETE']);
    }

    public function test(string $id): array
    {
        return $this->request($this->resourcePath('webhooks', $id, 'test'), ['method' => 'POST']);
    }

    public function statistics(string $id): array
    {
        return $this->request($this->resourcePath('webhooks', $id, 'statistics'));
    }

    public function deliveries(string $id): array
    {
        return $this->request($this->resourcePath('webhooks', $id, 'deliveries'));
    }

    public function retryDelivery(string $deliveryId): array
    {
        return $this->request($this->resourcePath('webhooks/deliveries', $deliveryId, 'retry'), [
            'method' => 'POST',
        ]);
    }
}
