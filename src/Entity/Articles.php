<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=5, max=50, minMessage="Votre libelle est trop court il doit faire plus de 5 caractères", maxMessage="Votre libelle est trop long, il doit faire moins de 50 caractères")
     */
    private $libelle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Range(min=0, max=500), minMessage="Votre prix est bas il doit être supérieur à 0 euros", maxMessage="Votre prix est trop élevé il doit être inférieur à 500 euros")
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, max=200, minMessage="Votre description est trop courte elle doit faire plus de 10 caractères", maxMessage="Votre description est trop longue, elle doit faire moins de 200 caractères")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
