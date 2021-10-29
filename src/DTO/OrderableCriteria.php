<?php

declare(strict_types=1);

namespace App\DTO;

trait OrderableCriteria
{
    public ?string $orderBy = 'updatedAt';

    public ?string $direction = 'DESC';
}
