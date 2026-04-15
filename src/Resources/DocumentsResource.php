<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

final class DocumentsResource extends AbstractResource
{
    public function list(string $environment, string $resource, array $query = []): array
    {
        return $this->request($this->documentBasePath($environment, $resource), ['query' => $query]);
    }

    public function create(string $environment, string $resource, array $payload): array
    {
        return $this->request($this->documentBasePath($environment, $resource), [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function get(string $environment, string $resource, string $id): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id));
    }

    public function update(string $environment, string $resource, string $id, array $payload): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id), [
            'method' => 'PUT',
            'json' => $payload,
        ]);
    }

    public function sendToSunat(string $environment, string $resource, string $id, string $mode = 'async'): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/send-sunat', [
            'method' => 'POST',
            'query' => ['mode' => $mode],
        ]);
    }

    public function checkStatus(string $environment, string $resource, string $id): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/check-status', [
            'method' => 'POST',
        ]);
    }

    public function generatePdf(string $environment, string $resource, string $id, string $format = 'A4'): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/generate-pdf', [
            'method' => 'POST',
            'json' => ['format' => $format],
        ]);
    }

    public function downloadFile(string $environment, string $resource, string $id, string $fileType): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/download-' . $fileType);
    }

    public function listDailySummaryPendingReceipts(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/daily-summaries/pending-receipts', ['query' => $query]);
    }

    public function createDailySummaryFromPendingReceipts(string $environment, array $payload): array
    {
        return $this->request('/api/' . $environment . '/v2/daily-summaries/from-pending-receipts', [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function listReceiptPendingForSummary(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/pending-for-summary', ['query' => $query]);
    }

    public function listReceiptPendingSummaryDates(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/pending-summary-dates', ['query' => $query]);
    }

    public function listExpiredReceipts(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/expired', ['query' => $query]);
    }

    public function listVoidableReceipts(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/voidable', ['query' => $query]);
    }

    public function listPendingVoidReceipts(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/pending-void', ['query' => $query]);
    }

    public function listVoidedReceipts(string $environment, array $query = []): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/voided', ['query' => $query]);
    }

    public function voidReceiptsLocally(string $environment, array $payload): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/void-locally', [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function voidReceiptsOfficially(string $environment, array $payload): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/void-officially', [
            'method' => 'POST',
            'json' => $payload,
        ]);
    }

    public function sendReceiptSummaryToSunat(string $environment, string $id, string $mode = 'async'): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/summary/' . rawurlencode($id) . '/send-sunat', [
            'method' => 'POST',
            'query' => ['mode' => $mode],
        ]);
    }

    public function checkReceiptSummaryStatus(string $environment, string $id): array
    {
        return $this->request('/api/' . $environment . '/v2/receipts/summary/' . rawurlencode($id) . '/check-status', [
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
