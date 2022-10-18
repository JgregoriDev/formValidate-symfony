<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;

/**
 * Fp
 *
 * @ORM\Table(name="fp")
 * @ORM\Entity
 */
class Fp
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODFP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codfp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMBRE", type="string", length=40, nullable=true)
     */
    private $nombre;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NPLAZOS", type="integer", nullable=true)
     */
    private $nplazos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="DISTANCIA", type="integer", nullable=true)
     */
    private $distancia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CODEEMPRESA", type="smallint", nullable=true)
     */
    private $codeempresa;

    public function getCodfp(): ?int
    {
        return $this->codfp;
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

    public function getNplazos(): ?int
    {
        return $this->nplazos;
    }

    public function setNplazos(?int $nplazos): self
    {
        $this->nplazos = $nplazos;

        return $this;
    }

    public function getDistancia(): ?int
    {
        return $this->distancia;
    }

    public function setDistancia(?int $distancia): self
    {
        $this->distancia = $distancia;

        return $this;
    }

    public function getCodeempresa(): ?int
    {
        return $this->codeempresa;
    }

    public function setCodeempresa(?int $codeempresa): self
    {
        $this->codeempresa = $codeempresa;

        return $this;
    }
    public function __toString(): String
    {
        return $this->getCodfp().' - '.$this->getNombre();
    }

}
