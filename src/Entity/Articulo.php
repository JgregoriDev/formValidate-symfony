<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Articulo
 *
 * @ORM\Table(name="articulo", indexes={@ORM\Index(name="articulo_FK2", columns={"CODPROVEEDORREL"}), @ORM\Index(name="articulo_FK3", columns={"CODFAMILIAREL", "CODSUBFAMILIAREL"}), @ORM\Index(name="ARTICULO_FK_1", columns={"CODMARCAREL"}), @ORM\Index(name="IDX_69E94E91819EFD6C", columns={"CODFAMILIAREL"})})
 * @ORM\Entity(repositoryClass="App\Repository\ArticuloRepository")
 */
class Articulo
{
    /**
     * @var int
     *
     * @ORM\Column(name="CODARTICULO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $codarticulo;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CODSUBFAMILIAREL", type="integer", nullable=true)
     */
    private $codsubfamiliarel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODIGOEAN", type="string", length=25, nullable=true)
     */
    private $codigoean;

    /**
     * @var string|null
     *
     * @ORM\Column(name="REFERENCIAPROVEEDOR", type="string", length=20, nullable=true)
     */
    private $referenciaproveedor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="REFERENCIAMARCA", type="string", length=20, nullable=true)
     */
    private $referenciamarca;

    /**
     * @var string|null
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=100, nullable=true)
     */
    private $descripcion;

    /**
     * @var string|null
     *
     * @ORM\Column(name="AUX_MARGEN", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $auxMargen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="Column1", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $column1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="MARGEN", type="decimal", precision=14, scale=4, nullable=true)
     */
    private $margen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BASE", type="decimal", precision=14, scale=4, nullable=true)
     */
    private $base;

    /**
     * @var string|null
     *
     * @ORM\Column(name="EXISTENCIASDISPONIBLE", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $existenciasdisponible;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PVP_OFERTA_MOSTRADOR", type="decimal", precision=14, scale=4, nullable=true)
     */
    private $pvpOfertaMostrador;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PVP", type="decimal", precision=14, scale=4, nullable=true)
     */
    private $pvp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PVP2", type="decimal", precision=14, scale=4, nullable=true)
     */
    private $pvp2;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CODIGO", type="integer", nullable=true)
     */
    private $codigo;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ESMANOOBRA", type="boolean", nullable=true)
     */
    private $esmanoobra;

    /**
     * @var string|null
     *
     * @ORM\Column(name="UDS_ULTIMAENTRADA", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $udsUltimaentrada;

    /**
     * @var string|null
     *
     * @ORM\Column(name="BASE2", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $base2;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="FAVORITO", type="boolean", nullable=true)
     */
    private $favorito;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="POSIBLEB", type="boolean", nullable=true)
     */
    private $posibleb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CODART_GRANEL", type="string", length=70, nullable=true)
     */
    private $codartGranel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="UD_X_UDGRANNEL", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $udXUdgrannel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IMAGEN", type="blob", length=65535, nullable=true)
     */
    private $imagen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="IVAPERCENT", type="decimal", precision=4, scale=2, nullable=true)
     */
    private $ivapercent;

    /**
     * @var int|null
     *
     * @ORM\Column(name="NORDEN_MOSTRAR", type="integer", nullable=true)
     */
    private $nordenMostrar;

    /**
     * @var string|null
     *
     * @ORM\Column(name="INTRASTAT", type="string", length=15, nullable=true)
     */
    private $intrastat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="UMEDIDA", type="string", length=5, nullable=true)
     */
    private $umedida;

    /**
     * @var string|null
     *
     * @ORM\Column(name="PESO", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $peso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="REQ_EQ", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $reqEq;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CODCATEGORIA", type="integer", nullable=true)
     */
    private $codcategoria;

    /**
     * @var int|null
     *
     * @ORM\Column(name="CODSUBCATEGORIA", type="integer", nullable=true)
     */
    private $codsubcategoria;

    /**
     * @var int|null
     *
     * @ORM\Column(name="IDWOOCOMMERCE", type="integer", nullable=true)
     */
    private $idwoocommerce;

    /**
     * @var string|null
     *
     * @ORM\Column(name="CARACTECNICAS", type="string", length=90, nullable=true)
     */
    private $caractecnicas;

    /**
     * @var \Proveedor
     *
     * @ORM\ManyToOne(targetEntity="Proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODPROVEEDORREL", referencedColumnName="CODPROVEEDOR")
     * })
     */
    private $codproveedorrel;

    /**
     * @var \Familia
     *
     * @ORM\ManyToOne(targetEntity="Familia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODFAMILIAREL", referencedColumnName="CODFAMILIA")
     * })
     */
    private $codfamiliarel;

    /**
     * @var \Marca
     *
     * @ORM\ManyToOne(targetEntity="Marca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CODMARCAREL", referencedColumnName="CODMARCA")
     * })
     */
    private $codmarcarel;

    public function getCodarticulo(): ?int
    {
        return $this->codarticulo;
    }

    public function getCodsubfamiliarel(): ?int
    {
        return $this->codsubfamiliarel;
    }

    public function setCodsubfamiliarel(?int $codsubfamiliarel): self
    {
        $this->codsubfamiliarel = $codsubfamiliarel;

        return $this;
    }

    public function getCodigoean(): ?string
    {
        return $this->codigoean;
    }

    public function setCodigoean(?string $codigoean): self
    {
        $this->codigoean = $codigoean;

        return $this;
    }

    public function getReferenciaproveedor(): ?string
    {
        return $this->referenciaproveedor;
    }

    public function setReferenciaproveedor(?string $referenciaproveedor): self
    {
        $this->referenciaproveedor = $referenciaproveedor;

        return $this;
    }

    public function getReferenciamarca(): ?string
    {
        return $this->referenciamarca;
    }

    public function setReferenciamarca(?string $referenciamarca): self
    {
        $this->referenciamarca = $referenciamarca;

        return $this;
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

    public function getAuxMargen(): ?string
    {
        return $this->auxMargen;
    }

    public function setAuxMargen(?string $auxMargen): self
    {
        $this->auxMargen = $auxMargen;

        return $this;
    }

    public function getColumn1(): ?string
    {
        return $this->column1;
    }

    public function setColumn1(?string $column1): self
    {
        $this->column1 = $column1;

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

    public function getBase(): ?string
    {
        return $this->base;
    }

    public function setBase(?string $base): self
    {
        $this->base = $base;

        return $this;
    }

    public function getExistenciasdisponible(): ?string
    {
        return $this->existenciasdisponible;
    }

    public function setExistenciasdisponible(?string $existenciasdisponible): self
    {
        $this->existenciasdisponible = $existenciasdisponible;

        return $this;
    }

    public function getPvpOfertaMostrador(): ?string
    {
        return $this->pvpOfertaMostrador;
    }

    public function setPvpOfertaMostrador(?string $pvpOfertaMostrador): self
    {
        $this->pvpOfertaMostrador = $pvpOfertaMostrador;

        return $this;
    }

    public function getPvp(): ?string
    {
        return $this->pvp;
    }

    public function setPvp(?string $pvp): self
    {
        $this->pvp = $pvp;

        return $this;
    }

    public function getPvp2(): ?string
    {
        return $this->pvp2;
    }

    public function setPvp2(?string $pvp2): self
    {
        $this->pvp2 = $pvp2;

        return $this;
    }

    public function getCodigo(): ?int
    {
        return $this->codigo;
    }

    public function setCodigo(?int $codigo): self
    {
        $this->codigo = $codigo;

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

    public function getUdsUltimaentrada(): ?string
    {
        return $this->udsUltimaentrada;
    }

    public function setUdsUltimaentrada(?string $udsUltimaentrada): self
    {
        $this->udsUltimaentrada = $udsUltimaentrada;

        return $this;
    }

    public function getBase2(): ?string
    {
        return $this->base2;
    }

    public function setBase2(?string $base2): self
    {
        $this->base2 = $base2;

        return $this;
    }

    public function isFavorito(): ?bool
    {
        return $this->favorito;
    }

    public function setFavorito(?bool $favorito): self
    {
        $this->favorito = $favorito;

        return $this;
    }

    public function isPosibleb(): ?bool
    {
        return $this->posibleb;
    }

    public function setPosibleb(?bool $posibleb): self
    {
        $this->posibleb = $posibleb;

        return $this;
    }

    public function getCodartGranel(): ?string
    {
        return $this->codartGranel;
    }

    public function setCodartGranel(?string $codartGranel): self
    {
        $this->codartGranel = $codartGranel;

        return $this;
    }

    public function getUdXUdgrannel(): ?string
    {
        return $this->udXUdgrannel;
    }

    public function setUdXUdgrannel(?string $udXUdgrannel): self
    {
        $this->udXUdgrannel = $udXUdgrannel;

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

    public function getIvapercent(): ?string
    {
        return $this->ivapercent;
    }

    public function setIvapercent(?string $ivapercent): self
    {
        $this->ivapercent = $ivapercent;

        return $this;
    }

    public function getNordenMostrar(): ?int
    {
        return $this->nordenMostrar;
    }

    public function setNordenMostrar(?int $nordenMostrar): self
    {
        $this->nordenMostrar = $nordenMostrar;

        return $this;
    }

    public function getIntrastat(): ?string
    {
        return $this->intrastat;
    }

    public function setIntrastat(?string $intrastat): self
    {
        $this->intrastat = $intrastat;

        return $this;
    }

    public function getUmedida(): ?string
    {
        return $this->umedida;
    }

    public function setUmedida(?string $umedida): self
    {
        $this->umedida = $umedida;

        return $this;
    }

    public function getPeso(): ?string
    {
        return $this->peso;
    }

    public function setPeso(?string $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getReqEq(): ?string
    {
        return $this->reqEq;
    }

    public function setReqEq(?string $reqEq): self
    {
        $this->reqEq = $reqEq;

        return $this;
    }

    public function getCodcategoria(): ?int
    {
        return $this->codcategoria;
    }

    public function setCodcategoria(?int $codcategoria): self
    {
        $this->codcategoria = $codcategoria;

        return $this;
    }

    public function getCodsubcategoria(): ?int
    {
        return $this->codsubcategoria;
    }

    public function setCodsubcategoria(?int $codsubcategoria): self
    {
        $this->codsubcategoria = $codsubcategoria;

        return $this;
    }

    public function getIdwoocommerce(): ?int
    {
        return $this->idwoocommerce;
    }

    public function setIdwoocommerce(?int $idwoocommerce): self
    {
        $this->idwoocommerce = $idwoocommerce;

        return $this;
    }

    public function getCaractecnicas(): ?string
    {
        return $this->caractecnicas;
    }

    public function setCaractecnicas(?string $caractecnicas): self
    {
        $this->caractecnicas = $caractecnicas;

        return $this;
    }

    public function getCodproveedorrel(): ?Proveedor
    {
        return $this->codproveedorrel;
    }

    public function setCodproveedorrel(?Proveedor $codproveedorrel): self
    {
        $this->codproveedorrel = $codproveedorrel;

        return $this;
    }

    public function getCodfamiliarel(): ?Familia
    {
        return $this->codfamiliarel;
    }

    public function setCodfamiliarel(?Familia $codfamiliarel): self
    {
        $this->codfamiliarel = $codfamiliarel;

        return $this;
    }

    public function getCodmarcarel(): ?Marca
    {
        return $this->codmarcarel;
    }

    public function setCodmarcarel(?Marca $codmarcarel): self
    {
        $this->codmarcarel = $codmarcarel;

        return $this;
    }


}