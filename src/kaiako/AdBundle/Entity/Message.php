<?php
namespace kaiako\AdBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
*/
class Message
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="kaiako\AdBundle\Entity\Ad", inversedBy="messages")
     * @ORM\JoinColumn(name="ad_id", referencedColumnName="id", nullable=false)
    */
    protected $ad;

    /** @ORM\Column(type="string") */
    protected $subject;
    
    /** @ORM\Column(type="string", length=50) */
    protected $sender;
    
    /** @ORM\Column(type="string", length=50) */
    protected $receiver;
    
    /** @ORM\Column(type="datetime") */
    protected $date;
    
    /** @ORM\Column(type="text") */
    protected $message;
    
    /** @ORM\Column(type="boolean") */
    protected $isRead;
    
    /** @ORM\Column(type="boolean") */
    protected $isApproved;
    
    /** @ORM\Column(type="boolean") */
    protected $isPendingApproval;
    
    public function __construct()
    {
        $this->date = new \DateTime();
        $this->isRead = false;
        $this->isApproved = false;
        $this->isPendingApproval = true;
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
     * Set ad
     *
     * @param \kaiako\AdBundle\Entity\Ad $ad
     * @return Message
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
     * Set subject
     *
     * @param string $subject
     * @return Message
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set sender
     *
     * @param string $sender
     * @return Message
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return string 
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Set receiver
     *
     * @param string $receiver
     * @return Message
     */
    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;

        return $this;
    }

    /**
     * Get receiver
     *
     * @return string 
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Message
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
     * Set message
     *
     * @param string $message
     * @return Message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set isRead
     *
     * @param boolean $isRead
     * @return Message
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return boolean 
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * Set isApproved
     *
     * @param boolean $isApproved
     * @return Message
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean 
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * Set isPendingApproval
     *
     * @param boolean $isPendingApproval
     * @return Message
     */
    public function setIsPendingApproval($isPendingApproval)
    {
        $this->isPendingApproval = $isPendingApproval;

        return $this;
    }

    /**
     * Get isPendingApproval
     *
     * @return boolean 
     */
    public function getIsPendingApproval()
    {
        return $this->isPendingApproval;
    }
}
