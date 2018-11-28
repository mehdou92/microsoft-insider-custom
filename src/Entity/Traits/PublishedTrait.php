<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;


trait PublishedTrait
{
    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $published = false;

    /**
     * @return bool
     */
    public function isPublished(): bool
    {
        return $this->published;
    }

    /**
     * @param bool $published
     * @return PublishedTrait
     */
    public function setPublished(bool $published): self
    {
        $this->published = $published;
        return $this;
    }


}