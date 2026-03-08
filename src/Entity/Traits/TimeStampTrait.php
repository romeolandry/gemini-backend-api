<?php

namespace App\Entity\Traits;


use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[ORM\HasLifecycleCallbacks]
trait TimeStampTrait
{

    #[ORM\Column]
    private DateTime $createdat;

    #[ORM\Column]
    private DateTime $updatedat;


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
     * Get the value of updatedat
     *
     * @return DateTime
     */
    public function getUpdatedat(): DateTime
    {
        return $this->updatedat;
    }

    /**
     * Set the value of updatedat
     *
     * @param DateTime $updatedat
     *
     * @return self
     */
    public function setUpdatedat(DateTime $updatedat): self
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    #[ORM\PrePersist]
    public function setTimeStampValue(): void
    {
        var_dump("setTimeStampValue");
        die;
        $now = new DateTime();
        if($this->createdat === null) $this->createdat = $now;
        $this->updatedat = $now;
    }
}
