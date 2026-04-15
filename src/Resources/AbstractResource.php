<?php

declare(strict_types=1);

namespace SunApi365\Sdk\Resources;

use SunApi365\Sdk\Http\SunApiHttpClient;

abstract class AbstractResource
{
    public function __construct(protected readonly SunApiHttpClient $client)
    {
    }

    /**
     * @param array{
     *   method?: string,
     *   query?: array<string, scalar|null>,
     *   json?: array<string, mixed>|list<mixed>,
     *   form?: array<string, scalar|null>,
     *   setupToken?: ?string,
     *   accessToken?: ?string
     * } $options
     */
    protected function request(string $path, array $options = []): array
    {
        return $this->client->request($path, $options);
    }

    protected function documentBasePath(string $environment, string $resource): string
    {
        return '/api/' . $environment . '/v2/' . $resource;
    }
}
