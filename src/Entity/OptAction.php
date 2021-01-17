<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OptActionRepository")
 * @ORM\Table(name="opt_action",indexes={@Index(name="search_idx", columns={"urn", "opt_id"})})
 */
class OptAction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $urn;

    /**
     * @ORM\Column(type="integer")
     */
    private $opt_id;

    /**
     * @ORM\Column(type="smallint")
     */
    private $action;

    public function getId()
    {
        return $this->id;
    }

    public function getUrn(): ?int
    {
        return $this->urn;
    }

    public function setUrn(int $urn): self
    {
        $this->urn = $urn;

        return $this;
    }

    public function getOptId(): ?int
    {
        return $this->opt_id;
    }

    public function setOptId(int $opt_id): self
    {
        $this->opt_id = $opt_id;

        return $this;
    }

    public function getAction(): ?int
    {
        return $this->action;
    }

    public function setAction(int $action): self
    {
        $this->action = $action;

        return $this;
    }
}
