<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources\Documents;

trait HandlesReceiptSummaryOperations
{
    public function listDailySummaryPendingReceipts(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'daily-summaries/pending-receipts'), ['query' => $query]);
    }

    public function createDailySummaryFromPendingReceipts(string $environment, array $payload): array
    {
        return $this->request($this->versionedPath($environment, 'daily-summaries/from-pending-receipts'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function listReceiptPendingForSummary(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/pending-for-summary'), ['query' => $query]);
    }

    public function listReceiptPendingSummaryDates(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/pending-summary-dates'), ['query' => $query]);
    }

    public function listExpiredReceipts(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/expired'), ['query' => $query]);
    }

    public function listVoidableReceipts(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/voidable'), ['query' => $query]);
    }

    public function listPendingVoidReceipts(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/pending-void'), ['query' => $query]);
    }

    public function listVoidedReceipts(string $environment, array $query = []): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/voided'), ['query' => $query]);
    }

    public function voidReceiptsLocally(string $environment, array $payload): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/void-locally'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function voidReceiptsOfficially(string $environment, array $payload): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/void-officially'), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function sendReceiptSummaryToSunat(string $environment, string $id, string $mode = 'async'): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/summary/' . rawurlencode($id) . '/send-sunat'), [
            'method' => 'POST',
            'query' => ['mode' => $this->assertSunatMode($mode)],
        ]);
    }

    public function checkReceiptSummaryStatus(string $environment, string $id): array
    {
        return $this->request($this->versionedPath($environment, 'receipts/summary/' . rawurlencode($id) . '/check-status'), [
            'method' => 'POST',
        ]);
    }

    public function listInvoicesByStatus(string $environment, array $input): array
    {
        $query = [
            'companyId' => $input['companyId'],
            'perPage' => $input['perPage'] ?? 100,
            'branchId' => $input['branchId'] ?? null,
            'sunatStatus' => $input['sunatStatus'] ?? null,
        ];

        if (isset($input['issueDate']) && is_string($input['issueDate']) && trim($input['issueDate']) !== '') {
            $query['dateFrom'] = $input['issueDate'];
            $query['dateTo'] = $input['issueDate'];
        }

        return $this->list($environment, 'invoices', $query);
    }

    public function listReceiptsByStatus(string $environment, array $input): array
    {
        $query = [
            'companyId' => $input['companyId'],
            'perPage' => $input['perPage'] ?? 100,
            'branchId' => $input['branchId'] ?? null,
            'sunatStatus' => $input['sunatStatus'] ?? null,
        ];

        if (isset($input['issueDate']) && is_string($input['issueDate']) && trim($input['issueDate']) !== '') {
            $query['dateFrom'] = $input['issueDate'];
            $query['dateTo'] = $input['issueDate'];
        }

        return $this->list($environment, 'receipts', $query);
    }
}
