<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EtudiantRepository::class)
 */
class Etudiant
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotNull
     */
     
    private $prenom;

    

    /**
     * @ORM\Column(type="date")
     *  @Assert\NotNull
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeBourse;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email(
     *     message = "Email '{{ value }}' invalide !."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class, inversedBy="etudiants")
     */
    private $chambre;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

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

    

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->date_naissance = $dateNaissance;

        return $this;
    }

    public function getTypeBourse(): ?string
    {
        return $this->typeBourse;
    }

    public function setTypeBourse(?string $typeBourse): self
    {
        $this->typeBourse = $typeBourse;

        return $this;
    }

    public function TwoFirstChar(): ?string
    
    {
        $name=$this->getNom();
        $CC=$name[0]."".$name[1];
        return $CC;
    }

    public function TwoLastChar(): ?string
    
    {
        $firstname=$this->getPrenom();
        $long_ch=strlen($firstname);
        $LL=$firstname[$long_ch-2]."".$firstname[$long_ch-1];
        return $LL;
    }

    public function CodeEtudiant($ID) : ?string

    {
        $ID=(string)$ID;
        if (strlen($ID)==1)
        {
            $code="000"."".$ID;
        }

        else
            if (strlen($ID)==2)
            {
                $code="00"."".$ID;
            }

        else

            if (strlen($ID)==3)
            {
                $code="0"."".$ID;
            }

        else

            if (strlen($ID)==4 && (int)$ID<=9998)
            {
                $code=$ID;
            }

            else
            {
                $code="false";
            }
            return $code;
}

    public function createMatricule($ID) : ?string
    {
        $date=date('Y');
        $matricule=$date."-".$this->TwoFirstChar()."-".$this->TwoLastChar()."-".$this->CodeEtudiant($ID);
        return $matricule;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

        return $this;
    }

    
}
