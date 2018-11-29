<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotationRepository")
 */
class Notation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull
     * @Assert\Type("integer", message="The value {{ value }} is not a valid {{ type }}.")
     */
    private $number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Issue", inversedBy="notations")
     * @Assert\Choice(callback={"App\Entity\Issue", "getId"})
     * @Assert\NotBlank(message="Please select a bug or feature !")
     */
    private $Issue;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="notations")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Choice(callback={"App\Entity\User", "getNickname"})
     * @Assert\NotBlank(message="Please select a user !")
     *
     */
    private $author;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getIssue(): ?Issue
    {
        return $this->Issue;
    }

    public function setIssue(?Issue $Issue): self
    {
        $this->Issue = $Issue;

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
