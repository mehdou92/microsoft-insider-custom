<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IssueRepository")
 */
class Issue
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Please enter a title !")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Please enter a description to your issue !")
     * @Assert\Length(
     *      min = 25,
     *      max = 500,
     *      minMessage = "Your text must be at least 25 characters long",
     *      maxMessage = "Your text cannot be longer than 500 characters"
     */
    private $body;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotNull
     * @Assert\Type("boolean")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Label", mappedBy="Issue")
     * @Assert\Choice(callback={"App\Entity\Labels", "getTitle"})
     * @Assert\NotBlank(message="Please select a bug or feature !")
     */
    private $labels;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notation", mappedBy="Issue")
     */
    private $notations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="Issue", orphanRemoval=true)
     * @Assert\NotBlank(message="Please enter a comment !")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="issues")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Choice(callback={"App\Entity\User", "getNickname"})
     * @Assert\NotBlank(message="Please select a user !")
     */
    private $author;

    public function __construct()
    {
        $this->labels = new ArrayCollection();
        $this->notations = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getType(): ?bool
    {
        return $this->type;
    }

    public function setType(bool $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Label[]
     */
    public function getLabels(): Collection
    {
        return $this->labels;
    }

    public function addLabel(Label $label): self
    {
        if (!$this->labels->contains($label)) {
            $this->labels[] = $label;
            $label->addIssue($this);
        }

        return $this;
    }

    public function removeLabel(Label $label): self
    {
        if ($this->labels->contains($label)) {
            $this->labels->removeElement($label);
            $label->removeIssue($this);
        }

        return $this;
    }

    /**
     * @return Collection|Notation[]
     */
    public function getNotations(): Collection
    {
        return $this->notations;
    }

    public function addNotation(Notation $notation): self
    {
        if (!$this->notations->contains($notation)) {
            $this->notations[] = $notation;
            $notation->setIssue($this);
        }

        return $this;
    }

    public function removeNotation(Notation $notation): self
    {
        if ($this->notations->contains($notation)) {
            $this->notations->removeElement($notation);
            // set the owning side to null (unless already changed)
            if ($notation->getIssue() === $this) {
                $notation->setIssue(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setIssue($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getIssue() === $this) {
                $comment->setIssue(null);
            }
        }

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }
}
