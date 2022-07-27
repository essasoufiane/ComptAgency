<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WordRepository::class)]
class Word
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 55)]
    private ?string $cin = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_associe = null;

    #[ORM\Column(length: 255)]
    private ?string $date_de_naissance = null;

    #[ORM\Column(length: 255)]
    private ?string $entreprise = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse_societe = null;

    #[ORM\Column(length: 255)]
    private ?string $activite = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getCin(): ?string
    {
        return $this->cin;
    }

    public function setCin(string $cin): self
    {
        $this->cin = $cin;

        return $this;
    }

    public function getAdresseAssocie(): ?string
    {
        return $this->adresse_associe;
    }

    public function setAdresseAssocie(string $adresse_associe): self
    {
        $this->adresse_associe = $adresse_associe;

        return $this;
    }

    public function getDateDeNaissance(): ?string
    {
        return $this->date_de_naissance;
    }

    public function setDateDeNaissance(string $date_de_naissance): self
    {
        $this->date_de_naissance = $date_de_naissance;

        return $this;
    }

    public function getEntreprise(): ?string
    {
        return $this->entreprise;
    }

    public function setEntreprise(string $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getAdresseSociete(): ?string
    {
        return $this->adresse_societe;
    }

    public function setAdresseSociete(string $adresse_societe): self
    {
        $this->adresse_societe = $adresse_societe;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

        return $this;
    }
}
