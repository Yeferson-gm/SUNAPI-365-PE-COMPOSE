<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources\Documents;

trait HandlesDocumentCrud
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

    public function generatePdf(string $environment, string $resource, string $id, string $format = 'A4'): array
    {
        return $this->request($this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/generate-pdf', [
            'method' => 'POST',
            'json' => ['format' => $format],
        ]);
    }

    public function downloadFile(string $environment, string $resource, string $id, string $fileType): array
    {
        return $this->request(
            $this->documentBasePath($environment, $resource) . '/' . rawurlencode($id) . '/download-' . $this->assertDocumentFileType($fileType)
        );
    }
}
