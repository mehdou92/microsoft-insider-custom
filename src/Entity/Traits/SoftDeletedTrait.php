<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 2018-11-28
 * Time: 14:56
 */

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait SoftDeletedTrait{

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $deleted = false;

    /**
     * @return bool
     */
    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     * @return SoftDeletedTrait
     */
    public function setDeleted(bool $deleted): self
    {
        $this->deleted = $deleted;
        return $this;
    }

}
