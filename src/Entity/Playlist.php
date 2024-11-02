<?php

namespace App\Entity;

use App\Repository\PlaylistRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaylistRepository::class)]
class Playlist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $created_at = null;

    #[ORM\Column]
    private ?int $update_at = null;

    #[ORM\ManyToOne(inversedBy: 'playlists')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $creator = null;

    /**
     * @var Collection<int, playlistSubscription>
     */
    #[ORM\OneToMany(targetEntity: playlistSubscription::class, mappedBy: 'playlist', orphanRemoval: true)]
    private Collection $subscription;

    /**
     * @var Collection<int, PlaylistMedia>
     */
    #[ORM\OneToMany(targetEntity: PlaylistMedia::class, mappedBy: 'playlist')]
    private Collection $playlistMedia;

    public function __construct()
    {
        $this->subscription = new ArrayCollection();
        $this->playlistMedia = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    public function setCreatedAt(int $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?int
    {
        return $this->update_at;
    }

    public function setUpdateAt(int $update_at): static
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): static
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * @return Collection<int, playlistSubscription>
     */
    public function getSubscription(): Collection
    {
        return $this->subscription;
    }

    public function addSubscription(playlistSubscription $subscription): static
    {
        if (!$this->subscription->contains($subscription)) {
            $this->subscription->add($subscription);
            $subscription->setPlaylist($this);
        }

        return $this;
    }

    public function removeSubscription(playlistSubscription $subscription): static
    {
        if ($this->subscription->removeElement($subscription)) {
            // set the owning side to null (unless already changed)
            if ($subscription->getPlaylist() === $this) {
                $subscription->setPlaylist(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PlaylistMedia>
     */
    public function getPlaylistMedia(): Collection
    {
        return $this->playlistMedia;
    }

    public function addPlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if (!$this->playlistMedia->contains($playlistMedium)) {
            $this->playlistMedia->add($playlistMedium);
            $playlistMedium->setPlaylist($this);
        }

        return $this;
    }

    public function removePlaylistMedium(PlaylistMedia $playlistMedium): static
    {
        if ($this->playlistMedia->removeElement($playlistMedium)) {
            // set the owning side to null (unless already changed)
            if ($playlistMedium->getPlaylist() === $this) {
                $playlistMedium->setPlaylist(null);
            }
        }

        return $this;
    }
}
