<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FaqRepository")
 */
class Faq
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Please enter a question !")
     */
    private $question;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Please enter a answer !")
     * @Assert\Length(
     *      min = 25,
     *      max = 500,
     *      minMessage = "Your answer must be at least 25 characters long",
     *      maxMessage = "Your answer cannot be longer than 500 characters"
     */
    private $answer;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank(message="This field can not be empty !")
     */
    private $active;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuestion(): ?string
    {
        return $this->question;
    }

    public function setQuestion(string $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

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
}
