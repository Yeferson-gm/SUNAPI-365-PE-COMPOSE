<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Concerns;

trait InteractsWithDocuments
{
    public function listDocuments(string $environment, string $resource, array $query = []): array
    {
        return $this->documents->list($environment, $resource, $query);
    }

    public function createDocument(string $environment, string $resource, array $payload): array
    {
        return $this->documents->create($environment, $resource, $payload);
    }

    public function createDocumentAndSendToSunat(
        string $environment,
        string $resource,
        array $payload,
        string $mode = 'sync'
    ): array {
        return $this->documents->createAndSendToSunat($environment, $resource, $payload, $mode);
    }

    public function createDocumentSendToSunatAndWhatsapp(
        string $environment,
        string $resource,
        array $payload,
        array $whatsapp = [],
        string $mode = 'sync'
    ): array {
        return $this->documents->createSendToSunatAndWhatsapp(
            $environment,
            $resource,
            $payload,
            $whatsapp,
            $mode
        );
    }

    public function createInvoiceAndSendToSunat(
        string $environment,
        array $payload,
        string $mode = 'sync'
    ): array {
        return $this->documents->createInvoiceAndSendToSunat($environment, $payload, $mode);
    }

    public function createInvoiceSendToSunatAndWhatsapp(
        string $environment,
        array $payload,
        array $whatsapp = [],
        string $mode = 'sync'
    ): array {
        return $this->documents->createInvoiceSendToSunatAndWhatsapp(
            $environment,
            $payload,
            $whatsapp,
            $mode
        );
    }

    public function createReceiptAndQueueDailySummary(
        string $environment,
        array $payload,
        array $whatsapp = []
    ): array {
        return $this->documents->createReceiptAndQueueDailySummary($environment, $payload, $whatsapp);
    }

    public function getDocument(string $environment, string $resource, string $id): array
    {
        return $this->documents->get($environment, $resource, $id);
    }

    public function updateDocument(
        string $environment,
        string $resource,
        string $id,
        array $payload
    ): array {
        return $this->documents->update($environment, $resource, $id, $payload);
    }

    public function sendDocumentToSunat(
        string $environment,
        string $resource,
        string $id,
        string $mode = 'async'
    ): array {
        return $this->documents->sendToSunat($environment, $resource, $id, $mode);
    }

    public function sendDocumentByWhatsapp(
        string $environment,
        string $resource,
        string $id,
        array $payload = []
    ): array {
        return $this->documents->sendByWhatsapp($environment, $resource, $id, $payload);
    }

    public function checkDocumentStatus(string $environment, string $resource, string $id): array
    {
        return $this->documents->checkStatus($environment, $resource, $id);
    }

    public function generateDocumentPdf(
        string $environment,
        string $resource,
        string $id,
        string $format = 'A4'
    ): array {
        return $this->documents->generatePdf($environment, $resource, $id, $format);
    }

    public function downloadDocumentFile(
        string $environment,
        string $resource,
        string $id,
        string $fileType
    ): array {
        return $this->documents->downloadFile($environment, $resource, $id, $fileType);
    }

    public function listDailySummaryPendingReceipts(string $environment, array $query = []): array
    {
        return $this->documents->listDailySummaryPendingReceipts($environment, $query);
    }

    public function createDailySummaryFromPendingReceipts(string $environment, array $payload): array
    {
        return $this->documents->createDailySummaryFromPendingReceipts($environment, $payload);
    }

    public function listReceiptPendingForSummary(string $environment, array $query = []): array
    {
        return $this->documents->listReceiptPendingForSummary($environment, $query);
    }

    public function listReceiptPendingSummaryDates(string $environment, array $query = []): array
    {
        return $this->documents->listReceiptPendingSummaryDates($environment, $query);
    }

    public function listExpiredReceipts(string $environment, array $query = []): array
    {
        return $this->documents->listExpiredReceipts($environment, $query);
    }

    public function listVoidableReceipts(string $environment, array $query = []): array
    {
        return $this->documents->listVoidableReceipts($environment, $query);
    }

    public function listPendingVoidReceipts(string $environment, array $query = []): array
    {
        return $this->documents->listPendingVoidReceipts($environment, $query);
    }

    public function listVoidedReceipts(string $environment, array $query = []): array
    {
        return $this->documents->listVoidedReceipts($environment, $query);
    }

    public function voidReceiptsLocally(string $environment, array $payload): array
    {
        return $this->documents->voidReceiptsLocally($environment, $payload);
    }

    public function voidReceiptsOfficially(string $environment, array $payload): array
    {
        return $this->documents->voidReceiptsOfficially($environment, $payload);
    }

    public function sendReceiptSummaryToSunat(
        string $environment,
        string $id,
        string $mode = 'async'
    ): array {
        return $this->documents->sendReceiptSummaryToSunat($environment, $id, $mode);
    }

    public function checkReceiptSummaryStatus(string $environment, string $id): array
    {
        return $this->documents->checkReceiptSummaryStatus($environment, $id);
    }

    public function listInvoicesByStatus(string $environment, array $input): array
    {
        return $this->documents->listInvoicesByStatus($environment, $input);
    }

    public function listReceiptsByStatus(string $environment, array $input): array
    {
        return $this->documents->listReceiptsByStatus($environment, $input);
    }
}
