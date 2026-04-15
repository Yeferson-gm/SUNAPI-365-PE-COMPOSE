<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Concerns;

trait InteractsWithWebhooks
{
    public function listWebhooks(array $query = []): array
    {
        return $this->webhooks->list($query);
    }

    public function createWebhook(array $payload): array
    {
        return $this->webhooks->create($payload);
    }

    public function getWebhook(string $id): array
    {
        return $this->webhooks->get($id);
    }

    public function updateWebhook(string $id, array $payload): array
    {
        return $this->webhooks->update($id, $payload);
    }

    public function deleteWebhook(string $id): array
    {
        return $this->webhooks->delete($id);
    }

    public function testWebhook(string $id): array
    {
        return $this->webhooks->test($id);
    }

    public function getWebhookStatistics(string $id): array
    {
        return $this->webhooks->statistics($id);
    }

    public function getWebhookDeliveries(string $id): array
    {
        return $this->webhooks->deliveries($id);
    }

    public function retryWebhookDelivery(string $deliveryId): array
    {
        return $this->webhooks->retryDelivery($deliveryId);
    }
}
