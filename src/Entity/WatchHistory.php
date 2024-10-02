<?php

namespace App\Entity;

use App\Repository\WatchHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WatchHistoryRepository::class)]
class WatchHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $last_watched = null;

    #[ORM\Column]
    private ?int $number_ofÂ_views = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastWatched(): ?int
    {
        return $this->last_watched;
    }

    public function setLastWatched(int $last_watched): static
    {
        $this->last_watched = $last_watched;

        return $this;
    }

    public function getNumberOfÂViews(): ?int
    {
        return $this->number_ofÂ_views;
    }

    public function setNumberOfÂViews(int $number_ofÂ_views): static
    {
        $this->number_ofÂ_views = $number_ofÂ_views;

        return $this;
    }
}
