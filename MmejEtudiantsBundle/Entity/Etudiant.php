<?php
namespace App\MmejEtudiantsBundle\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\MmejEtudiantsBundle\Repository\EtudiantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['etudiant:read']],
    denormalizationContext: ['groups' => ['etudiant:write']]
)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['etudiant:read', 'niveau:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    #[Groups(['etudiant:read', 'etudiant:write', 'niveau:read'])]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['etudiant:read', 'etudiant:write'])]
    private ?Niveau $niveau = null;

    #[Groups(['etudiant:read'])]
    public function getNomNiveau(): ?string
    {
        return $this->niveau?->getNom();
    }

    // Getters & Setters...
}
