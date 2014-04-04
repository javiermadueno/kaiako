<?php
namespace kaiako\AdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections as Collections;
use kaiako\UserBundle\Entity\Teacher;


/**
 * @ORM\Entity
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

    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    
    /** @ORM\Column(type="string") */
    protected $description;
    
    /** @ORM\Column(type="float") */
    protected $prize;
    
    /** @ORM\Column(type="datetime") */
    protected $date;
    
    /** @ORM\Column(type="datetime",nullable=true) */
    protected $dateTo;
    
    /** 
     * @var ArrayCollection $provinces
     * @ORM\ManyToMany(targetEntity="kaiako\AdBundle\Entity\Province")
     * @ORM\JoinTable(name="provinces_ads",
     *      joinColumns={@ORM\JoinColumn(name="ad_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="province_id", referencedColumnName="id")}
     *      ) 
    */
    protected $provinces;
    
    /** 
     * @var ArrayCollection $skiResorts
     * @ORM\ManyToMany(targetEntity="kaiako\AdBundle\Entity\SkiResort")
     * @ORM\JoinTable(name="skiresorts_ads",
     *      joinColumns={@ORM\JoinColumn(name="ad_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="skiresort_id", referencedColumnName="id")}
     *      ) 
    */
    protected $skiResorts;


    public function __construct()
    {
        $this->date = new \DateTime();
        $this->messages = new Collections\ArrayCollection();
        $this->schedules = new Collections\ArrayCollection();
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
     * Add provinces
     *
     * @param \kaiako\AdBundle\Entity\Province $provinces
     * @return Ad
     */
    public function addProvince(\kaiako\AdBundle\Entity\Province $provinces)
    {
        $this->provinces[] = $provinces;

        return $this;
    }

    /**
     * Remove provinces
     *
     * @param \kaiako\AdBundle\Entity\Province $provinces
     */
    public function removeProvince(\kaiako\AdBundle\Entity\Province $provinces)
    {
        $this->provinces->removeElement($provinces);
    }

    /**
     * Get provinces
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProvinces()
    {
        return $this->provinces;
    }

    /**
     * Add skiResorts
     *
     * @param \kaiako\AdBundle\Entity\SkiResort $skiResorts
     * @return Ad
     */
    public function addSkiResort(\kaiako\AdBundle\Entity\SkiResort $skiResorts)
    {
        $this->skiResorts[] = $skiResorts;

        return $this;
    }

    /**
     * Remove skiResorts
     *
     * @param \kaiako\AdBundle\Entity\SkiResort $skiResorts
     */
    public function removeSkiResort(\kaiako\AdBundle\Entity\SkiResort $skiResorts)
    {
        $this->skiResorts->removeElement($skiResorts);
    }

    /**
     * Get skiResorts
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSkiResorts()
    {
        return $this->skiResorts;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Ad
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
