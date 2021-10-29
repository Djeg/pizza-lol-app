<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\Collection;
use Gedmo\Mapping\Annotation\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Ignore;

/**
 * @ORM\Entity(repositoryClass=AuthorRepository::class)
 */
class Author
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array")
     */
    private $images = [];

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Timestampable(on="create")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Timestampable(on="update")
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Book::class, mappedBy="author", orphanRemoval=true, fetch="EAGER")
     * @Ignore()
     */
    private $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImages(): ?array
    {
        return $this->images;
    }

    public function setImages(array $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
