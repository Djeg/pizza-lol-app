<?php

declare(strict_types=1);

namespace App\DTO;

trait PaginationCriteria
{
    public ?int $limit = 20;

    public ?int $page = 1;
}
