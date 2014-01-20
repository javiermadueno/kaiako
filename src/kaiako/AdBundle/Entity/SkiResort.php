<?php
namespace kaiako\AdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
*/
class SkiResort
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
    protected $id;
    
    /** @ORM\Column(type="string", length=60) */
    protected $name;
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\AdBundle\Entity\Province")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=false)
    */
    protected $province;

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
     * @return SkiResort
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
     * Set province
     *
     * @param \kaiako\AdBundle\Entity\Province $province
     * @return SkiResort
     */
    public function setProvince(\kaiako\AdBundle\Entity\Province $province)
    {
        $this->province = $province;

        return $this;
    }

    /**
     * Get province
     *
     * @return \kaiako\AdBundle\Entity\Province 
     */
    public function getProvince()
    {
        return $this->province;
    }
}
