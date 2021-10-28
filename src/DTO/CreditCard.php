<?php

declare(strict_types=1);

namespace App\DTO;

class CreditCard
{
    public ?string $name;

    public ?int $number;

    public ?int $expirationMonth;

    public ?int $expirationYear;

    public ?int $cryptogram;
}
