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
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $color;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Issue", inversedBy="labels")
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
