<?php

namespace App\Entity;

use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistSubscriptionRepository::class)]
class PlaylistSubscription
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $subscribed_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubscribedAt(): ?int
    {
        return $this->subscribed_at;
    }

    public function setSubscribedAt(int $subscribed_at): static
    {
        $this->subscribed_at = $subscribed_at;

        return $this;
    }
}
