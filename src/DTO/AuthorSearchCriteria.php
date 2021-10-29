<?php

declare(strict_types=1);

namespace App\DTO;

class AuthorSearchCriteria
{
    use PaginationCriteria;
    use OrderableCriteria;

    public ?string $name = null;
}
