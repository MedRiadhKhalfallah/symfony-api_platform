<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     normalizationContext={"groups"={"read:Post:collection"}},
 *     denormalizationContext={"groups"={"write:Post"}},
 *     collectionOperations={
 *     "post"={
 *     "validation_groups"={"create:Post:collection"}
 *     },
 *     "get"},
 *     itemOperations={
 *     "put",
 *     "delete",
 *     "get"={
 *     "normalization_context"={
 *                              "groups"={
 *                                  "read:Post:collection","read:Post:item","read:Post"
 *                                          }
 *                              }
 *          }
 *     }
 * )
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:Post:collection"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:Post:collection","write:Post"})
     * @Assert\Length(
     *     min = 2,
     *     max = 50,
     *     groups = {"create:Post:collection"}
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:Post:collection","write:Post"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Groups({"read:Post:item","write:Post"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"read:Post:item"})
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Groups({"read:read:Post:item"})
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="posts")
     * @Groups({"read:Post:item","write:Post"})
     */
    private $category;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
