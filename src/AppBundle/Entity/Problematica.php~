<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Problematica
 *
 * @ORM\Table(name="problematica")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProblematicaRepository")
 */
class Problematica
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="calle", type="string", length=255)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="altura", type="string", length=255)
     */
    private $altura;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=255)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="provincia", type="string", length=255)
     */
    private $provincia;

    /**
     * @var string
     *
     * @ORM\Column(name="pais", type="string", length=255)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="latitud", type="string", length=255)
     */
    private $latitud;

    /**
     * @var string
     *
     * @ORM\Column(name="longitud", type="string", length=255)
     */
    private $longitud;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $fecha;


    /**
     * @var \Date
     *
     * @ORM\Column(name="fecha_estado", type="date")
     */
    private $fecha_estado;

    /**
     * @return \DateTime
     */
    public function getFechaEstado()
    {
        return $this->fecha_estado;
    }

    /**
     * @param \DateTime $fecha_estado
     */
    public function setFechaEstado($fecha_estado)
    {
        $this->fecha_estado = $fecha_estado;
    }
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set calle
     *
     * @param string $calle
     *
     * @return Problematica
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;

        return $this;
    }

    /**
     * Get calle
     *
     * @return string
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * Set altura
     *
     * @param string $altura
     *
     * @return Problematica
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;

        return $this;
    }

    /**
     * Get altura
     *
     * @return string
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Problematica
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set provincia
     *
     * @param string $provincia
     *
     * @return Problematica
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return string
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * Set pais
     *
     * @param string $pais
     *
     * @return Problematica
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set latitud
     *
     * @param string $latitud
     *
     * @return Problematica
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;

        return $this;
    }

    /**
     * Get latitud
     *
     * @return string
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param string $longitud
     *
     * @return Problematica
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;

        return $this;
    }

    /**
     * Get longitud
     *
     * @return string
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Problematica
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Problematica
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @ORM\ManyToOne(targetEntity="TipoProblematica", inversedBy="problematica")
     * @ORM\JoinColumn(name="tipoproblematica_id", referencedColumnName="id")
     */
    private $tipoproblematica;

    /**
     * Set tipoproblematica
     *
     * @param \AppBundle\Entity\TipoProblematica $tipoproblematica
     *
     * @return Problematica
     */
    public function setTipoproblematica(\AppBundle\Entity\TipoProblematica $tipoproblematica = null)
    {
        $this->tipoproblematica = $tipoproblematica;

        return $this;
    }

    /**
     * Get tipoproblematica
     *
     * @return \AppBundle\Entity\TipoProblematica
     */
    public function getTipoproblematica()
    {
        return $this->tipoproblematica;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="problematicas")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private $estado;



    /**
     * Set estado
     *
     * @param \AppBundle\Entity\Estado $estado
     *
     * @return Problematica
     */
    public function setEstado(\AppBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return \AppBundle\Entity\Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
