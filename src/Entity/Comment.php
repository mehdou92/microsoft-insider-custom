<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotNull
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 25,
     *      max = 500,
     *      minMessage = "Your comment must be at least 25 characters long",
     *      maxMessage = "Your comment cannot be longer than 500 characters"
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Choice(callback={"App\Entity\User", "getNickname"})
     * @Assert\NotBlank(message="Please select a user !")
     */
    private $autor;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Issue", inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Choice(callback={"App\Entity\Issue", "getId"})
     * @Assert\NotBlank(message="Please select a bug or feature !")
     */
    private $Issue;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAutor(): ?User
    {
        return $this->autor;
    }

    public function setAutor(?User $autor): self
    {
        $this->autor = $autor;

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
}
