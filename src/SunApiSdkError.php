<?php

declare(strict_types=1);

namespace SunApi365\Sdk;

final class SunApiSdkError extends \RuntimeException
{
    public function __construct(
        string $message,
        public readonly ?int $status = null,
        public readonly ?string $codeName = null,
        public readonly mixed $data = null
    ) {
        parent::__construct($message);
    }
}
