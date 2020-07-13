<?php

namespace App\Entity;

use App\Repository\ChambreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=ChambreRepository::class)
 */
class Chambre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Batiment::class, inversedBy="chambre")
     * @ORM\JoinColumn(nullable=false)
     *  @Assert\NotNull
     */
    private $batiment;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotNull
     */
    private $typeChambre;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $matricule;

    /**
     * @ORM\OneToMany(targetEntity=Etudiant::class, mappedBy="chambre")
     */
    private $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    
    
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBatiment(): ?Batiment
    {
        return $this->batiment;
    }

    public function setBatiment(?Batiment $batiment): self
    {
        $this->batiment = $batiment;

        return $this;
    }

    public function getTypeChambre(): ?string
    {
        return $this->typeChambre;
    }

    public function setTypeChambre(string $typeChambre): self
    {
        $this->typeChambre = $typeChambre;

        return $this;
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


    public function CodeEtudiant($ID) : ?string

    {
        $ID=(string)$ID;
        if (strlen($ID)==1)
        {
            $code="000".$ID;
        }

        else
            if (strlen($ID)==2)
            {
                $code="00".$ID;
            }

        else

            if (strlen($ID)==3)
            {
                $code="0".$ID;
            }

        else

            if (strlen($ID)==4 && (int)$ID<=9998)
            {
                $code=$ID;
            }

 // Au cas où on aura un nombre supérieur à 9999
            else
            {
                $code="false";
            }
            return $code;
}

    public function createMatricule ($idBatiment,$idChambre) : ?string
    {
        return $this->CodeEtudiant($idBatiment)."-".$this->CodeEtudiant($idChambre); 
    }

    /**
     * @return Collection|Etudiant[]
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): self
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants[] = $etudiant;
            $etudiant->setChambre($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): self
    {
        if ($this->etudiants->contains($etudiant)) {
            $this->etudiants->removeElement($etudiant);
            // set the owning side to null (unless already changed)
            if ($etudiant->getChambre() === $this) {
                $etudiant->setChambre(null);
            }
        }

        return $this;
    }

    
    
    
}