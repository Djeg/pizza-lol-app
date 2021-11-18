<?php

declare(strict_types=1);

namespace App\DTO;

class CreditCard
{
    public ?int $numbers = null;

    public ?string $name = null;

    public ?int $expirationMonth = null;

    public ?int $expirationYear = null;

    public ?int $cryptogram = null;
}
