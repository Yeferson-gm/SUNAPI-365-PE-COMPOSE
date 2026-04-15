<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Concerns;

trait InteractsWithTickets
{
    public function listTickets(array $query = []): array
    {
        return $this->tickets->list($query);
    }

    public function createTicket(array $payload): array
    {
        return $this->tickets->create($payload);
    }

    public function getTicket(string $id): array
    {
        return $this->tickets->get($id);
    }

    public function updateTicket(string $id, array $payload): array
    {
        return $this->tickets->update($id, $payload);
    }

    public function payTicket(string $id, array $payload): array
    {
        return $this->tickets->pay($id, $payload);
    }

    public function cancelTicket(string $id, array $payload = []): array
    {
        return $this->tickets->cancel($id, $payload);
    }

    public function formalizeTicket(string $id, array $payload = []): array
    {
        return $this->tickets->formalize($id, $payload);
    }

    public function formalizeTicketsBatch(array $payload): array
    {
        return $this->tickets->formalizeBatch($payload);
    }

    public function createTicketAndSendWhatsapp(array $payload, array $whatsapp = []): array
    {
        return $this->tickets->createAndSendWhatsapp($payload, $whatsapp);
    }

    public function createFormalizeTicketAndSendWhatsapp(
        array $payload,
        array $formalize = [],
        array $whatsapp = []
    ): array {
        return $this->tickets->createFormalizeAndSendWhatsapp($payload, $formalize, $whatsapp);
    }

    public function getTicketHistory(string $id): array
    {
        return $this->tickets->history($id);
    }

    public function printTicket(string $id, array $query = []): array
    {
        return $this->tickets->print($id, $query);
    }

    public function getTicketPdf(string $id, array $query = []): array
    {
        return $this->tickets->pdf($id, $query);
    }

    public function sendTicketByWhatsapp(string $id, array $payload = []): array
    {
        return $this->tickets->sendByWhatsapp($id, $payload);
    }
}
