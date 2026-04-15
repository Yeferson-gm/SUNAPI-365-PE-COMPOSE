<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources\Documents;

trait HandlesDocumentDelivery
{
    public function sendToSunat(string $environment, string $resource, string $id, string $mode = 'async'): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/send-sunat', [
            'method' => 'POST',
            'query' => ['mode' => $this->assertSunatMode($mode)],
        ]);
    }

    public function sendByWhatsapp(string $environment, string $resource, string $id, array $payload = []): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/send-whatsapp', [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function checkStatus(string $environment, string $resource, string $id): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/check-status', [
            'method' => 'POST',
        ]);
    }
}
