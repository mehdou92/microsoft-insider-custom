<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LabelRepository")
 */
class Label
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank(message="Veuillez choisir un titre !")
     */
    private $title;


    // Attention la regex ne prend pas en compte le '#', il faudra le mettre dans l'input
    /**
     * @ORM\Column(type="string", length=7)
     * @Assert\NotBlank(message="Veuillez choisir une couleur !")
     * @Assert\Regex(
     *     pattern="/\b[0-9A-Fa-f]+\b",
     *     match=false,
     *     message="Veuillez entrer une couleur en Hexadecimal"
     * )
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Issue", inversedBy="labels")
     * @Assert\Choice(callback={"App\Entity\Issue", "getId"})
     * @Assert\NotBlank(message="Veuillez choisir un bug ou une feature !")
     */
    private $Issue;

    public function __construct()
    {
        $this->Issue = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return Collection|Issue[]
     */
    public function getIssue(): Collection
    {
        return $this->Issue;
    }

    public function addIssue(Issue $issue): self
    {
        if (!$this->Issue->contains($issue)) {
            $this->Issue[] = $issue;
        }

        return $this;
    }

    public function removeIssue(Issue $issue): self
    {
        if ($this->Issue->contains($issue)) {
            $this->Issue->removeElement($issue);
        }

        return $this;
    }
}
