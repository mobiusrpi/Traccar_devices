<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TcDevicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name'], message: 'Le nom du tracker doit être unique')]
#[UniqueEntity(fields: ['uniqueid'], message: 'L\'id du trackers doit être unique')]
#[ORM\Entity(repositoryClass: TcDevicesRepository::class)]
class TcDevices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]    
    private ?string $name = null;
  
    #[ORM\ManyToMany(targetEntity: TcUsers::class, mappedBy: "devices")]
	private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    #[ORM\Column(length: 128)]    
    private ?string $uniqueid = null;

    #[ORM\Column(length: 128)]    
    private ?string $phone = null;

    #[ORM\Column(length: 128)]    
    private ?string $model = null;

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

    public function getUniqueid(): ?string
    {
        return $this->uniqueid;
    }

    public function setUniqueid(string $uniqueid): static
    {
        $this->uniqueid = $uniqueid;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }
    
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(tcUsers $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }

        return $this;
    }

    public function removeUser(tcUsers $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeDevice($this);
        }

        return $this;
    }
}
