<?php
namespace kaiako\UserBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections as Collections;

use kaiako\AdBundle\Util\Util;


/**
 * @ORM\Entity
*/
class Language
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
     * @ORM\Column(type="string")
     */
    protected $slug;
    

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
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->slug = Util::getSlug($name);

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
    * Get slug
    *
    * @return string
    */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug
     *
     * @param string $name
     * @return Language
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }
}
