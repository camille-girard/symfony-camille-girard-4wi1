<?php

namespace App\Entity;

use App\Repository\SubscriptionHistoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubscriptionHistoryRepository::class)]
class SubscriptionHistory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $start_date = null;

    #[ORM\Column]
    private ?int $end_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?int
    {
        return $this->start_date;
    }

    public function setStartDate(int $start_date): static
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?int
    {
        return $this->end_date;
    }

    public function setEndDate(int $end_date): static
    {
        $this->end_date = $end_date;

        return $this;
    }
}
