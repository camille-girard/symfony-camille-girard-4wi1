<?php

namespace App\Entity;

use App\Repository\SubscriptionHistoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'subscriptionHistory')]
    private Collection $subscriber;

    #[ORM\ManyToOne]
    private ?Subscription $subscription = null;

    public function __construct()
    {
        $this->subscriber = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, User>
     */
    public function getSubscriber(): Collection
    {
        return $this->subscriber;
    }

    public function addSubscriber(User $subscriber): static
    {
        if (!$this->subscriber->contains($subscriber)) {
            $this->subscriber->add($subscriber);
            $subscriber->setSubscriptionHistory($this);
        }

        return $this;
    }

    public function removeSubscriber(User $subscriber): static
    {
        if ($this->subscriber->removeElement($subscriber)) {
            // set the owning side to null (unless already changed)
            if ($subscriber->getSubscriptionHistory() === $this) {
                $subscriber->setSubscriptionHistory(null);
            }
        }

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): static
    {
        $this->subscription = $subscription;

        return $this;
    }
}
