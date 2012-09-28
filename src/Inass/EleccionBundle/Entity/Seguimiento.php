<?php

namespace Inass\EleccionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inass\EleccionBundle\Entity\Seguimiento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Seguimiento
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $votos
     *
     * @ORM\Column(name="votos", type="integer")
     */
    private $votos;

    /**
     * @var \DateTime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var Inass\EleccionBundle\Entity\Estado $estado
     *
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="seguimientos")
     * @ORM\JoinColumn(name="estado_id", referencedColumnName="id")
     */
    private $estado;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set votos
     *
     * @param integer $votos
     * @return Seguimiento
     */
    public function setVotos($votos)
    {
        $this->votos = $votos;
    
        return $this;
    }

    /**
     * Get votos
     *
     * @return integer 
     */
    public function getVotos()
    {
        return $this->votos;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Seguimiento
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
     * Set estado
     *
     * @param Inass\EleccionBundle\Entity\Estado $estado
     * @return Seguimiento
     */
    public function setEstado(\Inass\EleccionBundle\Entity\Estado $estado = null)
    {
        $this->estado = $estado;
    
        return $this;
    }

    /**
     * Get estado
     *
     * @return Inass\EleccionBundle\Entity\Estado 
     */
    public function getEstado()
    {
        return $this->estado;
    }
}