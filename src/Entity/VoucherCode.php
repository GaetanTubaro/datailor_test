<?php

namespace App\Entity;

use App\Repository\VoucherCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoucherCodeRepository::class)]
class VoucherCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $birthLimit;

    #[ORM\Column(type: 'string', length: 50)]
    private $cityLimit;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $startingDate;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $endingDate;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'voucherCodeUsed')]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBirthLimit(): ?\DateTimeInterface
    {
        return $this->birthLimit;
    }

    public function setBirthLimit(\DateTimeInterface $birthLimit): self
    {
        $this->birthLimit = $birthLimit;

        return $this;
    }

    public function getCityLimit(): ?string
    {
        return $this->cityLimit;
    }

    public function setCityLimit(string $cityLimit): self
    {
        $this->cityLimit = $cityLimit;

        return $this;
    }

    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->startingDate;
    }

    public function setStartingDate(?\DateTimeInterface $startingDate): self
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    public function setEndingDate(?\DateTimeInterface $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addVoucherCodeUsed($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeVoucherCodeUsed($this);
        }

        return $this;
    }
}
