<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoProblematica
 *
 * @ORM\Table(name="tipo_problematica")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoProblematicaRepository")
 */
class TipoProblematica
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="marcador", type="string", length=255)
     */
    private $marcador;


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoProblematica
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set marcador
     *
     * @param string $marcador
     *
     * @return TipoProblematica
     */
    public function setMarcador($marcador)
    {
        $this->marcador = $marcador;

        return $this;
    }

    /**
     * Get marcador
     *
     * @return string
     */
    public function getMarcador()
    {
        return $this->marcador;
    }


    /**
     * @ORM\OneToMany(targetEntity="Problematica", mappedBy="tipoproblematica")
     */
    private $problematica;

    public function __construct()
    {
        $this->problematica = new ArrayCollection();
    }

    /**
     * Add problematica
     *
     * @param \AppBundle\Entity\Problematica $problematica
     *
     * @return TipoProblematica
     */
    public function addProblematica(\AppBundle\Entity\Problematica $problematica)
    {
        $this->problematica[] = $problematica;

        return $this;
    }

    /**
     * Remove problematica
     *
     * @param \AppBundle\Entity\Problematica $problematica
     */
    public function removeProblematica(\AppBundle\Entity\Problematica $problematica)
    {
        $this->problematica->removeElement($problematica);
    }

    /**
     * Get problematica
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProblematica()
    {
        return $this->problematica;
    }

    public function __toString(){
        return (string) $this->nombre;
    }
}
