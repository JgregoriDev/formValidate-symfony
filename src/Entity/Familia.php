<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Familia
 *
 * @ORM\Table(name="familia")
 * @ORM\Entity(repositoryClass="App\Repository\FamiliaRepository")
 */
class Familia
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODFAMILIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $codfamilia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMBRE", type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MARGEN", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $margen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IVAPERCENT", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $ivapercent;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ESMANOOBRA", type="boolean", nullable=true)
     */
    private $esmanoobra;

    /**
     * @var string|null
     *
     * @ORM\Column(name="INICIOCODEAN", type="string", length=2, nullable=true)
     */
    private $iniciocodean;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RE", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $re;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IMAGEN", type="blob", length=65535, nullable=true)
     */
    private $imagen;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ESANIMALES", type="boolean", nullable=true)
     */
    private $esanimales;

    public function getCodfamilia(): ?int
    {
        return $this->codfamilia;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getMargen(): ?string
    {
        return $this->margen;
    }

    public function setMargen(?string $margen): self
    {
        $this->margen = $margen;

        return $this;
    }

    public function getIvapercent(): ?string
    {
        return $this->ivapercent;
    }

    public function setIvapercent(?string $ivapercent): self
    {
        $this->ivapercent = $ivapercent;

        return $this;
    }

    public function isEsmanoobra(): ?bool
    {
        return $this->esmanoobra;
    }

    public function setEsmanoobra(?bool $esmanoobra): self
    {
        $this->esmanoobra = $esmanoobra;

        return $this;
    }

    public function getIniciocodean(): ?string
    {
        return $this->iniciocodean;
    }

    public function setIniciocodean(?string $iniciocodean): self
    {
        $this->iniciocodean = $iniciocodean;

        return $this;
    }

    public function getRe(): ?string
    {
        return $this->re;
    }

    public function setRe(?string $re): self
    {
        $this->re = $re;

        return $this;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function isEsanimales(): ?bool
    {
        return $this->esanimales;
    }

    public function setEsanimales(?bool $esanimales): self
    {
        $this->esanimales = $esanimales;

        return $this;
    }




    /**
     * Set the value of codfamilia
     */
    public function setCodfamilia($codfamilia): self
    {
        $this->codfamilia = $codfamilia;

        return $this;
    }
    public function __toString()
    {
        return $this->getCodFamilia() . " - " . $this->getNombre();
    }
}
