<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Estado
 *
 * @ORM\Table(name="estado")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EstadoRepository")
 */
class Estado
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
     * @ORM\Column(name="estado", type="string", length=255)
     */
    private $estado;


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
     * Set estado
     *
     * @param string $estado
     *
     * @return Estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @ORM\OneToMany(targetEntity="Problematica", mappedBy="estado")
     */
    private $problematicas;

    public function __construct()
    {
        $this->problematicas = new ArrayCollection();
    }

    /**
     * Add problematica
     *
     * @param \AppBundle\Entity\Problematica $problematica
     *
     * @return Estado
     */
    public function addProblematica(\AppBundle\Entity\Problematica $problematica)
    {
        $this->problematicas[] = $problematica;

        return $this;
    }

    /**
     * Remove problematica
     *
     * @param \AppBundle\Entity\Problematica $problematica
     */
    public function removeProblematica(\AppBundle\Entity\Problematica $problematica)
    {
        $this->problematicas->removeElement($problematica);
    }

    /**
     * Get problematicas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProblematicas()
    {
        return $this->problematicas;
    }
    public function __toString(){
        return (string) $this->estado;
    }

}
