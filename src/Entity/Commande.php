<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[Assert\Regex(
        pattern: "/^(0|\+33)[1-9](\d{2}){4}$/",
        message: "Merci d’entrer un numéro de téléphone français valide."
    )]
    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $typeService = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $dateSouhaitee = null;

    #[ORM\Column(length: 100)]
    private ?string $creneauHoraire = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $message = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column]
    private ?bool $urgence = null;

    #[ORM\Column]
    private ?bool $accepteConditions = null;

    #[ORM\Column]
    private ?bool $autorisationContact = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(length: 50)]
    private ?string $statut = 'En attente';

    #[ORM\ManyToOne(inversedBy: 'commandes')]
    private ?Creneau $creneau = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getTypeService(): ?string
    {
        return $this->typeService;
    }

    public function setTypeService(string $typeService): static
    {
        $this->typeService = $typeService;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;
        return $this;
    }

    public function getDateSouhaitee(): ?\DateTime
    {
        return $this->dateSouhaitee;
    }

    public function setDateSouhaitee(\DateTime $dateSouhaitee): static
    {
        $this->dateSouhaitee = $dateSouhaitee;
        return $this;
    }

    public function getCreneauHoraire(): ?string
    {
        return $this->creneauHoraire;
    }

    public function setCreneauHoraire(string $creneauHoraire): static
    {
        $this->creneauHoraire = $creneauHoraire;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): static
    {
        $this->message = $message;
        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): static
    {
        $this->photo = $photo;
        return $this;
    }

    public function isUrgence(): ?bool
    {
        return $this->urgence;
    }

    public function setUrgence(bool $urgence): static
    {
        $this->urgence = $urgence;
        return $this;
    }

    public function isAccepteConditions(): ?bool
    {
        return $this->accepteConditions;
    }

    public function setAccepteConditions(bool $accepteConditions): static
    {
        $this->accepteConditions = $accepteConditions;
        return $this;
    }

    public function isAutorisationContact(): ?bool
    {
        return $this->autorisationContact;
    }

    public function setAutorisationContact(bool $autorisationContact): static
    {
        $this->autorisationContact = $autorisationContact;
        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(string $statut): static
    {
        $this->statut = $statut;
        return $this;
    }

    public function getCreneau(): ?Creneau
    {
        return $this->creneau;
    }

    public function setCreneau(?Creneau $creneau): static
    {
        $this->creneau = $creneau;

        return $this;
    }
}
