<?php

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;

#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
     
    ],
    normalizationContext: ['groups' => ['movie:read']],

    )]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
#[ORM\table(name: 'Movie')]
class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Le titre est obligatoire")]
    #[Assert\Length(max: 150, maxMessage: "Le titre ne peut pas faire plus de 150 caractères")]
    #[ORM\Column(length: 150)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $synopsis = null;

    #[Assert\NotBlank(message: "L'année de sortie est obligatoire")]
    #[Assert\GreaterThan(1888, message: "Petit malin, aucun film n'est aussi vieux :)")]
    #[Assert\LessThanOrEqual(value: 2026, message: "On n'est pas dans le futur !")]
    #[ORM\Column]
    private ?int $releaseYear = null;

    #[Assert\NotBlank(message: "Le genre est obligatoire")]
    #[ORM\Column(length: 50)]
    private ?string $genre = null;

    #[Assert\NotNull(message: "Le réalisateur est obligatoire")]
    #[ORM\ManyToOne(inversedBy: 'movies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Director $director = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSynopsis(): ?string
    {
        return $this->synopsis;
    }

    public function setSynopsis(string $synopsis): static
    {
        $this->synopsis = $synopsis;

        return $this;
    }

    public function getReleaseYear(): ?int
    {
        return $this->releaseYear;
    }

    public function setReleaseYear(int $releaseYear): static
    {
        $this->releaseYear = $releaseYear;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getDirector(): ?Director
    {
        return $this->director;
    }

    public function setDirector(?Director $director): static
    {
        $this->director = $director;

        return $this;
    }
}
