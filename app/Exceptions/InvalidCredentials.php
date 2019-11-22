<?php

namespace App\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class InvalidCredentials extends Exception implements RendersErrorsExtensions
{
    private $reason;

    public function __construct(string $message, string $reason)
    {
        parent::__construct($message);

        $this->reason = $reason;
    }

    public function isClientSafe(): bool
    {
        return true;
    }

    public function getCategory(): string
    {
        return 'invalid_credentials';
    }

    public function extensionsContent(): array
    {
        return [
            'code' => '402',
            'reason' => $this->reason,
        ];
    }
}
