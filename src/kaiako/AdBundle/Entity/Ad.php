<?php
namespace kaiako\AdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="kaiako\AdBundle\Entity\AdRepository")
*/
class Ad
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\UserBundle\Entity\Teacher", inversedBy="ads")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id", nullable=false)
     */
    protected $teacher;
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\AdBundle\Entity\Category", inversedBy="ads")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    protected $category;
    
    /**
     * @ORM\OneToMany(targetEntity="kaiako\AdBundle\Entity\Message", mappedBy="ad")
     */
    protected $messages;
    
    /**
     * @ORM\OneToMany(targetEntity="kaiako\AdBundle\Entity\Schedule", mappedBy="ad")
     */
    protected $schedules;
    
    /** @ORM\Column(type="string") */
    protected $headline;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="float") */
    protected $prize;
    
    /** @ORM\Column(type="datetime") */
    protected $date;
    
    /** @ORM\Column(type="datetime",nullable=true) */
    protected $dateTo;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\AdBundle\Entity\Province", inversedBy="ads")
     * @ORM\JoinColumn(name="province_id", referencedColumnName="id", nullable=false)
     */
    protected $province;
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\AdBundle\Entity\SkiResort", inversedBy="ads")
     * @ORM\JoinColumn(name="skiresort_id", referencedColumnName="id", nullable=true)
     */
    protected $skiResort;
    
    /** @ORM\Column(type="boolean") */
    protected $groups;


    public function __construct()
    {
        $this->date = new \DateTime();
        $this->messages = new \Doctrine\Common\Collections\ArrayCollection();
        $this->schedules = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set headline
     *
     * @param string $headline
     * @return Ad
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ad
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set prize
     *
     * @param float $prize
     * @return Ad
     */
    public function setPrize($prize)
    {
        $this->prize = $prize;

        return $this;
    }

    /**
     * Get prize
     *
     * @return float 
     */
    public function getPrize()
    {
        return $this->prize;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Ad
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return Ad
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set teacher
     *
     * @param \kaiako\UserBundle\Entity\Teacher $teacher
     * @return Ad
     */
    public function setTeacher(\kaiako\UserBundle\Entity\Teacher $teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \kaiako\UserBundle\Entity\Teacher 
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set category
     *
     * @param \kaiako\AdBundle\Entity\Category $category
     * @return Ad
     */
    public function setCategory(\kaiako\AdBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \kaiako\AdBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add messages
     *
     * @param \kaiako\AdBundle\Entity\Message $messages
     * @return Ad
     */
    public function addMessage(\kaiako\AdBundle\Entity\Message $messages)
    {
        $this->messages[] = $messages;

        return $this;
    }

    /**
     * Remove messages
     *
     * @param \kaiako\AdBundle\Entity\Message $messages
     */
    public function removeMessage(\kaiako\AdBundle\Entity\Message $messages)
    {
        $this->messages->removeElement($messages);
    }

    /**
     * Get messages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Add schedules
     *
     * @param \kaiako\AdBundle\Entity\Schedule $schedules
     * @return Ad
     */
    public function addSchedule(\kaiako\AdBundle\Entity\Schedule $schedules)
    {
        $this->schedules[] = $schedules;

        return $this;
    }

    /**
     * Remove schedules
     *
     * @param \kaiako\AdBundle\Entity\Schedule $schedules
     */
    public function removeSchedule(\kaiako\AdBundle\Entity\Schedule $schedules)
    {
        $this->schedules->removeElement($schedules);
    }

    /**
     * Get schedules
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSchedules()
    {
        return $this->schedules;
    }

    /**
     * Set province
     *
     * @param \kaiako\AdBundle\Entity\Province $province
     * @return Ad
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
    
    /**
     * Set skiResort
     *
     * @param \kaiako\AdBundle\Entity\SkiResort $skiResort
     * @return Ad
     */
    public function setSkiResort(\kaiako\AdBundle\Entity\SkiResort $skiResort)
    {
        $this->skiResort = $skiResort;

        return $this;
    }

    /**
     * Get skiResort
     *
     * @return \kaiako\AdBundle\Entity\SkiResort
     */
    public function getSkiResort()
    {
        return $this->skiResort;
    }
    
    /**
     * Set groups
     *
     * @param string $groups
     * @return Ad
     */
    public function setGroups($groups)
    {
        $this->groups = (boolean)$groups;
    
        return $this;
    }

    /**
     * Get groups
     *
     * @return boolean 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
