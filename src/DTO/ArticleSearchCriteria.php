<?php

declare(strict_types=1);

namespace App\DTO;

class ArticleSearchCriteria
{
    public ?string $search = null;

    public ?string $authorName = null;

    public ?string $orderBy = 'createdAt';

    public ?string $direction = 'DESC';

    public ?int $limit = 25;

    public ?int $page = 1;
}
