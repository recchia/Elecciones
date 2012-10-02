<?php

namespace Inass\EleccionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inass\EleccionBundle\Entity\Novedad
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Novedad
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
     * @var string $evento
     *
     * @ORM\Column(name="evento", type="text", length=1000)
     */
    private $evento;

    /**
     * @var string $accion
     *
     * @ORM\Column(name="accion", type="text", length=1000)
     */
    private $accion;

    /**
     * @var string $estado
     *
     * @ORM\ManyToOne(targetEntity="Estado", inversedBy="novedades")
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
     * Set evento
     *
     * @param string $evento
     * @return Novedad
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;
    
        return $this;
    }

    /**
     * Get evento
     *
     * @return string 
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set accion
     *
     * @param string $accion
     * @return Novedad
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;
    
        return $this;
    }

    /**
     * Get accion
     *
     * @return string 
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set estado
     *
     * @param Inass\EleccionBundle\Entity\Estado $estado
     * @return Novedad
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