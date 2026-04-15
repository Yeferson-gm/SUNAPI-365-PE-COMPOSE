<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class WebhooksResource extends AbstractResource
{
    public function list(array $query = []): array
    {
        return $this->request('/api/v2/webhooks', ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request('/api/v2/webhooks', ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request('/api/v2/webhooks/' . rawurlencode($id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request('/api/v2/webhooks/' . rawurlencode($id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function delete(string $id): array
    {
        return $this->request('/api/v2/webhooks/' . rawurlencode($id), ['method' => 'DELETE']);
    }

    public function test(string $id): array
    {
        return $this->request('/api/v2/webhooks/' . rawurlencode($id) . '/test', ['method' => 'POST']);
    }

    public function statistics(string $id): array
    {
        return $this->request('/api/v2/webhooks/' . rawurlencode($id) . '/statistics');
    }

    public function deliveries(string $id): array
    {
        return $this->request('/api/v2/webhooks/' . rawurlencode($id) . '/deliveries');
    }

    public function retryDelivery(string $deliveryId): array
    {
        return $this->request('/api/v2/webhooks/deliveries/' . rawurlencode($deliveryId) . '/retry', [
            'method' => 'POST',
        ]);
    }
}
