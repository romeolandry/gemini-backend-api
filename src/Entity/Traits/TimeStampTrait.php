<?php

namespace App\Entity\Traits;


use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TimeStampTrait
{

    #[ORM\Column]
    private DateTime $createdat;

    #[ORM\Column]
    private DateTime $updatedai;


    /**
     * Get the value of createdat
     *
     * @return DateTime
     */
    public function getCreatedat(): DateTime
    {
        return $this->createdat;
    }

    /**
     * Set the value of createdat
     *
     * @param DateTime $createdat
     *
     * @return self
     */
    public function setCreatedat(DateTime $createdat): self
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get the value of updatedai
     *
     * @return DateTime
     */
    public function getUpdatedai(): DateTime
    {
        return $this->updatedai;
    }

    /**
     * Set the value of updatedai
     *
     * @param DateTime $updatedai
     *
     * @return self
     */
    public function setUpdatedai(DateTime $updatedai): self
    {
        $this->updatedai = $updatedai;

        return $this;
    }
}
