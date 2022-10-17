<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Familia;
/**
 * Subfamilia
 *
 * @ORM\Table(name="subfamilia", indexes={@ORM\Index(name="IDX_150B6A80C6BB373F", columns={"CODFAMILIA"})})
 * @ORM\Entity
 */
class Subfamilia
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODSUBFAMILIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $codsubfamilia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMBRE", type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IMAGEN", type="blob", length=65535, nullable=true)
     */
    private $imagen;

    /**
     * @var \Familia
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Familia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODFAMILIA", referencedColumnName="CODFAMILIA")
     * })
     */
    private $codfamilia;

    public function getCodsubfamilia(): ?int
    {
        return $this->codsubfamilia;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setCodSubFamilia(?int $codSubfamilia): self
    {
        $this->codsubfamilia = $codSubfamilia;

        return $this;
    }
    
    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

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

    public function getCodfamilia(): ?Familia
    {
        return $this->codfamilia;
    }

    public function setCodfamilia(?Familia $codfamilia): self
    {
        $this->codfamilia = $codfamilia;

        return $this;
    }
    public function __toString ( ) : string
    {
        return $this->getCodsubfamilia()." - ".$this->getNombre();
    }

}
