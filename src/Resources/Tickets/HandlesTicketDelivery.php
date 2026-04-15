<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources\Tickets;

trait HandlesTicketDelivery
{
    public function history(string $id): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'history'));
    }

    public function print(string $id, array $query = []): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'print'), ['query' => $query]);
    }

    public function pdf(string $id, array $query = []): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'pdf'), ['query' => $query]);
    }

    public function sendByWhatsapp(string $id, array $payload = []): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'send-whatsapp'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }
}
