<?php

namespace Ilius\DemoWsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Point
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ilius\DemoWsBundle\Entity\PointRepository")
 */
class Point
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="x", type="decimal", precision=10, scale=3) 
     */
    private $x;

    /**
     * @var float
     *
     * @ORM\Column(name="y", type="decimal", precision=10, scale=3)
     */
    private $y;

    /**
     * @var string
     *
     * @ORM\Column(name="pType", type="string", length=25)
     */
    private $pType;

    /**
    * @ORM\ManyToOne(targetEntity="MRoute", inversedBy="points")
    */
    private $route;

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
     * Set name
     *
     * @param string $name
     * @return Point
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set x
     *
     * @param float $x
     * @return Point
     */
    public function setX($x)
    {
        $this->x = $x;
    
        return $this;
    }

    /**
     * Get x
     *
     * @return float 
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Set y
     *
     * @param float $y
     * @return Point
     */
    public function setY($y)
    {
        $this->y = $y;
    
        return $this;
    }

    /**
     * Get y
     *
     * @return float 
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * Set pType
     *
     * @param string $pType
     * @return Point
     */
    public function setPType($pType)
    {
        $this->pType = $pType;
    
        return $this;
    }

    /**
     * Get pType
     *
     * @return string 
     */
    public function getPType()
    {
        return $this->pType;
    }

    /**
     * Set route
     *
     * @param \Ilius\DemoWsBundle\Entity\MRoute $route
     * @return Point
     */
    public function setRoute(\Ilius\DemoWsBundle\Entity\MRoute $route = null)
    {
        $this->route = $route;
    
        return $this;
    }

    /**
     * Get route
     *
     * @return \Ilius\DemoWsBundle\Entity\MRoute 
     */
    public function getRoute()
    {
        return $this->route;
    }
}