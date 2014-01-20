<?php
namespace kaiako\AdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections as Collections;


/**
 * @ORM\Entity
*/
class Category
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
    protected $id;
    
    /** @ORM\Column(type="string", length=50) */
    protected $name;


    /**
     * @ORM\OneToMany(targetEntity="kaiako\AdBundle\Entity\Ad", mappedBy="category")
     */
    protected $ads;

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
     * Constructor
     */
    public function __construct()
    {
        $this->ads = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add ads
     *
     * @param \kaiako\AdBundle\Entity\Ad $ads
     * @return Category
     */
    public function addAd(\kaiako\AdBundle\Entity\Ad $ads)
    {
        $this->ads[] = $ads;

        return $this;
    }

    /**
     * Remove ads
     *
     * @param \kaiako\AdBundle\Entity\Ad $ads
     */
    public function removeAd(\kaiako\AdBundle\Entity\Ad $ads)
    {
        $this->ads->removeElement($ads);
    }

    /**
     * Get ads
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAds()
    {
        return $this->ads;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
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
}
