<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TcUsersRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[UniqueEntity(fields: ['name'], message: 'Le tracker doit être unique')]
#[UniqueEntity(fields: ['email'], message: 'L\'IMEI doit être unique')]
#[ORM\Entity(repositoryClass: TcUsersRepository::class)]
class TcUsers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]    
    private ?string $name = null;

    #[ORM\Column(length: 180)]    
    private ?string $email = null;

    #[ORM\ManyToMany(targetEntity: TcDevices::class, inversedBy: "users")]
    #[ORM\JoinTable(name:"tc_user_device")]
    #[ORM\JoinColumn( 
         name: 'userid', 
         referencedColumnName: 'id' 
    )] 
    #[ORM\InverseJoinColumn( 
         name: 'deviceid', 
         referencedColumnName: 'id' 
    )]
//    #[ORM\Index(columns: ['uniqueid'], name: 'idx_devices_uniqueid')]     
    private Collection $devices;

    public function __construct()
    {
        $this->devices = new ArrayCollection();
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
    
     /**
     * @return Collection<int, Tdevices>
     */
    public function getDevices(): Collection
    {
        return $this->devices;
    }

    public function addDevice(TcDevices $device): self
    {
        if (!$this->devices->contains($device)) {
            $this->devices->add($device);

        }

        return $this;
    }

    public function removeDevice(TcDevices $device): self
    {
            $this->devices->removeElement($device);

        return $this;
    }
}