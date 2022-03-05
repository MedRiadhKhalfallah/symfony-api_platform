<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\PostPublicationController;
use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @ApiResource(
 *     attributes={"pagination_items_per_page"=10,"maximum_items_per_page"=50,"pagination_client_items_per_page"=true},
 *     normalizationContext={"groups"={"read:Post:collection"}},
 *     denormalizationContext={"groups"={"write:Post"}},
 *     collectionOperations={
 *     "post",
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
 *          },
 *     "post_publication"={
 *         "method"="POST",
 *         "path"="/posts/{id}/publication",
 *         "controller"=PostPublicationController::class,
 *          "openapi_context"={
 *                              "summary"="Permet de publier un article",
 *                              "requestBody"={
 *                                              "content"={"application/json"={"schema"={"type"="object"}}}
 *                                              }
 *                              }
 *     }
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "title": "partial", "slug": "exact"})
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
     *     max = 50
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
     * @Assert\Valid()
     */
    private $category;

    /**
     * @ORM\Column(type="boolean",options={"default":"0"})
     * @Groups({"read:Post:collection","read:Post:item"})
     */
    private $online = false;

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

    public function getOnline(): ?bool
    {
        return $this->online;
    }

    public function setOnline(bool $online): self
    {
        $this->online = $online;

        return $this;
    }
}
