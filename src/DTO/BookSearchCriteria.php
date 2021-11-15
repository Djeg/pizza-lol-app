<?php

declare(strict_types=1);

namespace App\DTO;

class BookSearchCriteria
{
    public ?string $title = null;

    public ?string $author = null;

    public ?string $dealer = null;

    public ?string $category = null;

    public ?float $minPrice = null;

    public ?float $maxPrice = null;

    public ?int $page = 1;

    public ?int $limit = 25;

    public ?string $orderBy = 'updatedAt';

    public ?string $direction = 'ASC';
}
