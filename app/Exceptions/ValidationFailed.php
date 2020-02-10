<?php

namespace App\Exceptions;

use Exception;
use Nuwave\Lighthouse\Exceptions\RendersErrorsExtensions;

class ValidationFailed extends Exception implements RendersErrorsExtensions
{
    private $validation;

    public function __construct(string $message, array $validation)
    {
        parent::__construct($message);

        $this->validation = $validation;
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
            'validation' => $this->validation,
        ];
    }
}
