<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

use SunApi365\Sdk\Resources\Documents\HandlesDocumentCrud;
use SunApi365\Sdk\Resources\Documents\HandlesDocumentDelivery;
use SunApi365\Sdk\Resources\Documents\HandlesReceiptSummaryOperations;

final class DocumentsResource extends AbstractResource
{
    use HandlesDocumentCrud;
    use HandlesDocumentDelivery;
    use HandlesReceiptSummaryOperations;

    /**
     * @return array{created: array, sentToSunat: array|null}
     */
    public function createAndSendToSunat(
        string $environment,
        string $resource,
        array $payload,
        string $mode = 'sync'
    ): array {
        $created = $this->create($environment, $resource, $payload);
        $id = $this->readCreatedId($created);

        return [
            'created' => $created,
            'sentToSunat' => $id !== null ? $this->sendToSunat($environment, $resource, $id, $mode) : null,
        ];
    }

    /**
     * @return array{created: array, sentToSunat: array|null, whatsapp: array|null}
     */
    public function createSendToSunatAndWhatsapp(
        string $environment,
        string $resource,
        array $payload,
        array $whatsapp = [],
        string $mode = 'sync'
    ): array {
        $created = $this->create($environment, $resource, $payload);
        $id = $this->readCreatedId($created);

        return [
            'created' => $created,
            'sentToSunat' => $id !== null ? $this->sendToSunat($environment, $resource, $id, $mode) : null,
            'whatsapp' => $id !== null ? $this->sendByWhatsapp($environment, $resource, $id, $whatsapp) : null,
        ];
    }

    /**
     * @return array{created: array, sentToSunat: array|null}
     */
    public function createInvoiceAndSendToSunat(string $environment, array $payload, string $mode = 'sync'): array
    {
        return $this->createAndSendToSunat($environment, 'invoices', $payload, $mode);
    }

    /**
     * @return array{created: array, sentToSunat: array|null, whatsapp: array|null}
     */
    public function createInvoiceSendToSunatAndWhatsapp(
        string $environment,
        array $payload,
        array $whatsapp = [],
        string $mode = 'sync'
    ): array {
        return $this->createSendToSunatAndWhatsapp($environment, 'invoices', $payload, $whatsapp, $mode);
    }

    /**
     * @return array{created: array, whatsapp: array|null}
     */
    public function createReceiptAndQueueDailySummary(string $environment, array $payload, array $whatsapp = []): array
    {
        $created = $this->create($environment, 'receipts', $payload);
        $id = $this->readCreatedId($created);

        return [
            'created' => $created,
            'whatsapp' => $id !== null ? $this->sendByWhatsapp($environment, 'receipts', $id, $whatsapp) : null,
        ];
    }
}
