<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Origengasto
 *
 * @ORM\Table(name="origengasto")
 * @ORM\Entity(repositoryClass="App\Repository\OrigengastoRepository")
 */
class Origengasto
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODORIGEN", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codorigen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=40, nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CUENTA", type="string", length=9, nullable=true)
     */
    private $cuenta;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ESINMOLIZADO", type="boolean", nullable=true)
     */
    private $esinmolizado;

    public function getCodorigen(): ?int
    {
        return $this->codorigen;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getCuenta(): ?string
    {
        return $this->cuenta;
    }

    public function setCuenta(?string $cuenta): self
    {
        $this->cuenta = $cuenta;

        return $this;
    }

    public function isEsinmolizado(): ?bool
    {
        return $this->esinmolizado;
    }

    public function setEsinmolizado(?bool $esinmolizado): self
    {
        $this->esinmolizado = $esinmolizado;

        return $this;
    }
    public function __toString()
    {
        return $this->getCodorigen()." - ".$this->getDescripcion();
    }


}
