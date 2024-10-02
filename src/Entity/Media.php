<?php

namespace App\Entity;

use App\Enum\MediaTypeEnum;
use App\Repository\MediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MediaRepository::class)]
class Media
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(enumType: MediaTypeEnum::class)]
    private ?MediaTypeEnum $media_type = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $short_desicription = null;

    #[ORM\Column(length: 255)]
    private ?string $long_description = null;

    #[ORM\Column]
    private ?int $release_date = null;

    #[ORM\Column(length: 255)]
    private ?string $cover_image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMediaType(): ?MediaTypeEnum
    {
        return $this->media_type;
    }

    public function setMediaType(MediaTypeEnum $media_type): static
    {
        $this->media_type = $media_type;

        return $this;
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

    public function getShortDesicription(): ?string
    {
        return $this->short_desicription;
    }

    public function setShortDesicription(string $short_desicription): static
    {
        $this->short_desicription = $short_desicription;

        return $this;
    }

    public function getLongDescription(): ?string
    {
        return $this->long_description;
    }

    public function setLongDescription(string $long_description): static
    {
        $this->long_description = $long_description;

        return $this;
    }

    public function getReleaseDate(): ?int
    {
        return $this->release_date;
    }

    public function setReleaseDate(int $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getCoverImage(): ?string
    {
        return $this->cover_image;
    }

    public function setCoverImage(string $cover_image): static
    {
        $this->cover_image = $cover_image;

        return $this;
    }
}
