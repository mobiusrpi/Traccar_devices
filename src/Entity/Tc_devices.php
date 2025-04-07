<?php

namespace App\Entity;

use App\Repository\Tc_devicesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name'], message: 'Le nom du tracker doit être unique')]
#[UniqueEntity(fields: ['uniqueid'], message: 'L\'id du trackers doit être unique')]
#[ORM\Entity(repositoryClass: Tc_devicesRepository::class)]
class Tc_devices
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]    
    private ?string $name = null;

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
}
