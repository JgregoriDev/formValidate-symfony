<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Marca
 *
 * @ORM\Table(name="marca")
 * @ORM\Entity(repositoryClass="App\Repository\MarcaRepository")
 */
class Marca
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODMARCA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codmarca;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NOMBREMARCA", type="string", length=40, nullable=true)
     * @Assert\NotBlank()
     */
    private $nombremarca;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RUTALOGO", type="string", length=80, nullable=true)
     */
    private $rutalogo;

    public function getCodmarca(): ?int
    {
        return $this->codmarca;
    }

    public function getNombremarca(): ?string
    {
        return $this->nombremarca;
    }

    public function setNombremarca(?string $nombremarca): self
    {
        $this->nombremarca = $nombremarca;

        return $this;
    }

    public function getRutalogo(): ?string
    {
        return $this->rutalogo;
    }

    public function setRutalogo(?string $rutalogo): self
    {
        $this->rutalogo = $rutalogo;

        return $this;
    }
    public function __toString()
    {
        return $this->getCodmarca()." - ".$this->getNombremarca();
    }

}
