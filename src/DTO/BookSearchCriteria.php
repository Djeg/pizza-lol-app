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
    public ?int $limit = 20;

    public ?int $page = 1;

    public ?string $name = null;

    public ?float $minPrice = null;

    public ?float $maxPrice = null;

    public ?Author $author = null;

    public ?ArrayCollection $kinds = null;

    public ?string $orderBy = 'updatedAt';

    public ?string $direction = 'DESC';
}
