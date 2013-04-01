<?php

namespace Inass\EleccionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Inass\EleccionBundle\Entity\Estado
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Inass\EleccionBundle\Entity\EstadoRepository")
 */
class Estado
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;
    
    /**
     * @ORM\Column(name="votantes", type="integer", nullable=true)
     */
    private $votantes;
    
    /**
     * @ORM\Column(name="votos", type="integer", nullable=true)
     */
    private $votos;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Estado
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
     * Set votantes
     *
     * @param integer $votantes
     * @return Estado
     */
    public function setVotantes($votantes)
    {
        $this->votantes = $votantes;
    
        return $this;
    }

    /**
     * Get votantes
     *
     * @return integer 
     */
    public function getVotantes()
    {
        return $this->votantes;
    }

    /**
     * Set votos
     *
     * @param integer $votos
     * @return Estado
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
     * toString
     * 
     * @return string $nombre
     */
    public function __toString() {
        return $this->getNombre();
    }
}