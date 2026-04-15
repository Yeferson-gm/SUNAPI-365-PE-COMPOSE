<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources\Tickets;

trait HandlesTicketCrud
{
    public function list(array $query = []): array
    {
        return $this->request($this->resourcePath('tickets'), ['query' => $query]);
    }

    public function create(array $payload): array
    {
        return $this->request($this->resourcePath('tickets'), ['method' => 'POST', 'json' => $payload]);
    }

    public function get(string $id): array
    {
        return $this->request($this->resourcePath('tickets', $id));
    }

    public function update(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('tickets', $id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function pay(string $id, array $payload): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'pay'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function cancel(string $id, array $payload = []): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'cancel'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function formalize(string $id, array $payload = []): array
    {
        return $this->request($this->resourcePath('tickets', $id, 'formalize'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function formalizeBatch(array $payload): array
    {
        return $this->request($this->resourcePath('tickets', null, 'formalize-batch'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }
}
