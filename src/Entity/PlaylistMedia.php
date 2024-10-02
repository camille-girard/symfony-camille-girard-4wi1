<?php

namespace App\Entity;

use App\Repository\PlaylistMediaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistMediaRepository::class)]
class PlaylistMedia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $added_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddedAt(): ?int
    {
        return $this->added_at;
    }

    public function setAddedAt(int $added_at): static
    {
        $this->added_at = $added_at;

        return $this;
    }
}
