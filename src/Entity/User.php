<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $name;

    #[ORM\Column(type: 'datetime')]
    private $birthDate;

    #[ORM\Column(type: 'string', length: 50)]
    private $city;

    #[ORM\ManyToMany(targetEntity: VoucherCode::class, inversedBy: 'users')]
    private $voucherCodeUsed;

    public function __construct()
    {
        $this->voucherCodeUsed = new ArrayCollection();
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

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return Collection<int, VoucherCode>
     */
    public function getVoucherCodeUsed(): Collection
    {
        return $this->voucherCodeUsed;
    }

    public function addVoucherCodeUsed(VoucherCode $voucherCodeUsed): self
    {
        if (!$this->voucherCodeUsed->contains($voucherCodeUsed)) {
            $this->voucherCodeUsed[] = $voucherCodeUsed;
        }

        return $this;
    }

    public function removeVoucherCodeUsed(VoucherCode $voucherCodeUsed): self
    {
        $this->voucherCodeUsed->removeElement($voucherCodeUsed);

        return $this;
    }
}
