<?php
namespace kaiako\AdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections as Collections;


/**
 * @ORM\Entity
*/
class Schedule
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\AdBundle\Entity\Ad", inversedBy="schedules")
     * @ORM\JoinColumn(name="ad_id", referencedColumnName="id", nullable=false)
     */
    protected $ad;
    
    /** @ORM\Column(type="string", length=5) */
    protected $timeFrom;
    
    /** @ORM\Column(type="string", length=5) */
    protected $timeTo;
    
    /**
     * @ORM\OneToMany(targetEntity="kaiako\AdBundle\Entity\Day", mappedBy="schelude")
     */
    protected $days;

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
     * Set ad
     *
     * @param \kaiako\AdBundle\Entity\Ad $ad
     * @return Schedule
     */
    public function setAd(\kaiako\AdBundle\Entity\Ad $ad)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return \kaiako\AdBundle\Entity\Ad 
     */
    public function getAd()
    {
        return $this->ad;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->days = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set timeFrom
     *
     * @param string $timeFrom
     * @return Schedule
     */
    public function setTimeFrom($timeFrom)
    {
        $this->timeFrom = $timeFrom;

        return $this;
    }

    /**
     * Get timeFrom
     *
     * @return string 
     */
    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    /**
     * Set timeTo
     *
     * @param string $timeTo
     * @return Schedule
     */
    public function setTimeTo($timeTo)
    {
        $this->timeTo = $timeTo;

        return $this;
    }

    /**
     * Get timeTo
     *
     * @return string 
     */
    public function getTimeTo()
    {
        return $this->timeTo;
    }

    /**
     * Add days
     *
     * @param \kaiako\AdBundle\Entity\Day $days
     * @return Schedule
     */
    public function addDay(\kaiako\AdBundle\Entity\Day $days)
    {
        $this->days[] = $days;

        return $this;
    }

    /**
     * Remove days
     *
     * @param \kaiako\AdBundle\Entity\Day $days
     */
    public function removeDay(\kaiako\AdBundle\Entity\Day $days)
    {
        $this->days->removeElement($days);
    }

    /**
     * Get days
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDays()
    {
        return $this->days;
    }
}
