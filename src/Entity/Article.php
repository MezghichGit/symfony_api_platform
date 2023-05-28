<?php

namespace App\Entity;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    operations: [
        new Post(),
        new GetCollection(),
        new Put(),
        new Delete()
    ],
    normalizationContext: ['groups' => ['readArticle']],  
    denormalizationContext: ['groups' => ['writeArticle']],
)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['readArticle'])]
    private ?int $id = null;
    #[Groups(['readArticle', 'writeArticle'])]
    #[ORM\Column(length: 255)]
    private ?string $label = null;
    #[Groups(['readArticle', 'writeArticle'])]
    #[ORM\Column(length: 255)]
    private ?string $prix = null;
    #[Groups(['readArticle', 'writeArticle'])]
    #[ORM\Column(length: 255)]
    private ?string $photo = null;
    #[Groups(['readArticle', 'writeArticle'])]
    #[ORM\ManyToOne(inversedBy: 'articles')]
    private ?Provider $provider = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): self
    {
        $this->provider = $provider;

        return $this;
    }
}
