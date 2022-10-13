<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedor
 *
 * @ORM\Table(name="proveedor", indexes={@ORM\Index(name="PROVEEDOR_FK", columns={"CODFP"}), @ORM\Index(name="CAJ_PROV_FK", columns={"TIPOGASTO"})})
 * @ORM\Entity(repositoryClass="App\Repository\ProveedorRepository")
 */
class Proveedor
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODPROVEEDOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codproveedor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="RAZONSOCIAL", type="string", length=50, nullable=true)
     */
    private $razonsocial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NIF", type="string", length=9, nullable=true)
     */
    private $nif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DOMICILIO", type="string", length=55, nullable=true)
     */
    private $domicilio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODPOSTAL", type="string", length=10, nullable=true)
     */
    private $codpostal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="POBLACION", type="string", length=30, nullable=true)
     */
    private $poblacion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PROVINCIA", type="string", length=30, nullable=true)
     */
    private $provincia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EMAIL", type="string", length=60, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="WWW", type="string", length=70, nullable=true)
     */
    private $www;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TFNO1", type="string", length=20, nullable=true)
     */
    private $tfno1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="TFNO2", type="string", length=20, nullable=true)
     */
    private $tfno2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="FAX", type="string", length=20, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MOVIL", type="string", length=20, nullable=true)
     */
    private $movil;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CUENTA", type="string", length=9, nullable=true)
     */
    private $cuenta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CUENTAPAGO", type="string", length=9, nullable=true)
     */
    private $cuentapago;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IVAPERCENT", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $ivapercent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AB", type="string", length=1, nullable=true)
     */
    private $ab;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODPAIS_OFICIAL", type="string", length=2, nullable=true)
     */
    private $codpaisOficial;

    /**
     * @var string|null
     *
     * @ORM\Column(name="NIFPAISRESIDENCIA", type="string", length=20, nullable=true)
     */
    private $nifpaisresidencia;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CLAVEIDENPAISRESIDENCIA", type="string", length=2, nullable=true)
     */
    private $claveidenpaisresidencia;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CONTAB_INTRACOM", type="smallint", nullable=true)
     */
    private $contabIntracom;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="TIENE_RE", type="boolean", nullable=true)
     */
    private $tieneRe;

    /**
     * @var int|null
     *
     * @ORM\Column(name="ESINVERSIONSUJETOPASIVO", type="integer", nullable=true)
     */
    private $esinversionsujetopasivo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PAIS", type="string", length=20, nullable=true)
     */
    private $pais;

    /**
     * @var \Fp
     *
     * @ORM\ManyToOne(targetEntity="Fp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODFP", referencedColumnName="CODFP")
     * })
     */
    private $codfp;

    /**
     * @var \Origengasto
     *
     * @ORM\ManyToOne(targetEntity="Origengasto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="TIPOGASTO", referencedColumnName="CODORIGEN")
     * })
     */
    private $tipogasto;

    public function getCodproveedor(): ?int
    {
        return $this->codproveedor;
    }

    public function getRazonsocial(): ?string
    {
        return $this->razonsocial;
    }

    public function setRazonsocial(?string $razonsocial): self
    {
        $this->razonsocial = $razonsocial;

        return $this;
    }

    public function getNif(): ?string
    {
        return $this->nif;
    }

    public function setNif(?string $nif): self
    {
        $this->nif = $nif;

        return $this;
    }

    public function getDomicilio(): ?string
    {
        return $this->domicilio;
    }

    public function setDomicilio(?string $domicilio): self
    {
        $this->domicilio = $domicilio;

        return $this;
    }

    public function getCodpostal(): ?string
    {
        return $this->codpostal;
    }

    public function setCodpostal(?string $codpostal): self
    {
        $this->codpostal = $codpostal;

        return $this;
    }

    public function getPoblacion(): ?string
    {
        return $this->poblacion;
    }

    public function setPoblacion(?string $poblacion): self
    {
        $this->poblacion = $poblacion;

        return $this;
    }

    public function getProvincia(): ?string
    {
        return $this->provincia;
    }

    public function setProvincia(?string $provincia): self
    {
        $this->provincia = $provincia;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getWww(): ?string
    {
        return $this->www;
    }

    public function setWww(?string $www): self
    {
        $this->www = $www;

        return $this;
    }

    public function getTfno1(): ?string
    {
        return $this->tfno1;
    }

    public function setTfno1(?string $tfno1): self
    {
        $this->tfno1 = $tfno1;

        return $this;
    }

    public function getTfno2(): ?string
    {
        return $this->tfno2;
    }

    public function setTfno2(?string $tfno2): self
    {
        $this->tfno2 = $tfno2;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getMovil(): ?string
    {
        return $this->movil;
    }

    public function setMovil(?string $movil): self
    {
        $this->movil = $movil;

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

    public function getCuentapago(): ?string
    {
        return $this->cuentapago;
    }

    public function setCuentapago(?string $cuentapago): self
    {
        $this->cuentapago = $cuentapago;

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

    public function getAb(): ?string
    {
        return $this->ab;
    }

    public function setAb(?string $ab): self
    {
        $this->ab = $ab;

        return $this;
    }

    public function getCodpaisOficial(): ?string
    {
        return $this->codpaisOficial;
    }

    public function setCodpaisOficial(?string $codpaisOficial): self
    {
        $this->codpaisOficial = $codpaisOficial;

        return $this;
    }

    public function getNifpaisresidencia(): ?string
    {
        return $this->nifpaisresidencia;
    }

    public function setNifpaisresidencia(?string $nifpaisresidencia): self
    {
        $this->nifpaisresidencia = $nifpaisresidencia;

        return $this;
    }

    public function getClaveidenpaisresidencia(): ?string
    {
        return $this->claveidenpaisresidencia;
    }

    public function setClaveidenpaisresidencia(?string $claveidenpaisresidencia): self
    {
        $this->claveidenpaisresidencia = $claveidenpaisresidencia;

        return $this;
    }

    public function getContabIntracom(): ?int
    {
        return $this->contabIntracom;
    }

    public function setContabIntracom(?int $contabIntracom): self
    {
        $this->contabIntracom = $contabIntracom;

        return $this;
    }

    public function isTieneRe(): ?bool
    {
        return $this->tieneRe;
    }

    public function setTieneRe(?bool $tieneRe): self
    {
        $this->tieneRe = $tieneRe;

        return $this;
    }

    public function getEsinversionsujetopasivo(): ?int
    {
        return $this->esinversionsujetopasivo;
    }

    public function setEsinversionsujetopasivo(?int $esinversionsujetopasivo): self
    {
        $this->esinversionsujetopasivo = $esinversionsujetopasivo;

        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getCodfp(): ?Fp
    {
        return $this->codfp;
    }

    public function setCodfp(?Fp $codfp): self
    {
        $this->codfp = $codfp;

        return $this;
    }

    public function getTipogasto(): ?Origengasto
    {
        return $this->tipogasto;
    }

    public function setTipogasto(?Origengasto $tipogasto): self
    {
        $this->tipogasto = $tipogasto;

        return $this;
    }


}
