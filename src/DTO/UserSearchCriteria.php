<?php

declare(strict_types=1);

namespace App\DTO;

class UserSearchCriteria
{
    use PaginationCriteria;
    use OrderableCriteria;

    public ?string $email = null;
}
