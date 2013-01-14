<?php

namespace Ilius\DemoWsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MRoute
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ilius\DemoWsBundle\Entity\MRouteRepository")
 */
class MRoute
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
     * @ORM\Column(name="name", type="string", length=125)
     */
    private $name;

    /**
    * @ORM\OneToMany(targetEntity="Point", mappedBy="route")
    * @var ArrayCollection $points
    */
    private $points;
    
    public function __construct() {

          $this->points = new ArrayCollection;
    } 
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
     * @return MRoute
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
     * Add points
     *
     * @param \Ilius\DemoWsBundle\Entity\Point $points
     * @return MRoute
     */
    public function addPoint(\Ilius\DemoWsBundle\Entity\Point $points)
    {
        $this->points[] = $points;
    
        return $this;
    }

    /**
     * Remove points
     *
     * @param \Ilius\DemoWsBundle\Entity\Point $points
     */
    public function removePoint(\Ilius\DemoWsBundle\Entity\Point $points)
    {
        $this->points->removeElement($points);
    }

    /**
     * Get points
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPoints()
    {
        return $this->points;
    }
}