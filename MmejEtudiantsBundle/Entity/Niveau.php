<?php
namespace App\MmejEtudiantsBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\MmejEtudiantsBundle\Repository\NiveauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NiveauRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['niveau:read']],
    denormalizationContext: ['groups' => ['niveau:write']]
)]
class Niveau
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['niveau:read', 'etudiant:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    #[Groups(['niveau:read', 'niveau:write', 'etudiant:read'])]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'niveau', targetEntity: Etudiant::class)]
    #[Groups(['niveau:read'])]
    private Collection $etudiants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
    }

    // Getters & Setters...
}
