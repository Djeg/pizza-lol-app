<?php

declare(strict_types=1);

namespace App\DTO;

use App\Entity\Author;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Contains all the fields needed for searching
 * books.
 */
class BookSearchCriteria
{
    use PaginationCriteria;
    use OrderableCriteria;

    public ?string $name = null;

    public ?float $minPrice = null;

    public ?float $maxPrice = null;

    public ?Author $author = null;

    public ?ArrayCollection $kinds = null;
}
