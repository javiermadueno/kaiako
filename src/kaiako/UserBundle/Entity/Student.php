<?php
namespace kaiako\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\ExecutionContext;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @DoctrineAssert\UniqueEntity(fields = {"id", "email"})
*/
class Student implements UserInterface
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\GeneratedValue
    */
   protected $id;
   
    /**
     *  @ORM\Column(type="string",length=100)
     *  @Assert\NotBlank(message = "Por favor, indica el email")
     *  @Assert\Email(message = "El email introducido no es válido",
     *                checkMX=true)
    */
    protected $email;
    
    /**
     *  @ORM\Column(type="string")
     *  @Assert\Length(min=6, max=12, minMessage = "La contraseña debe contener entre 6 y 12 caracteres", maxMessage = "La contraseña debe contener entre 6 y 12 caracteres")
    */
    protected $password;
    
    /**
     *  @ORM\Column(type="string")
    */
    protected $salt;    

    
    /** @ORM\Column(type="string", length=100) 
     *  @Assert\NotBlank(message = "Por favor, indica un nombre")
     */
    protected $name;
    
    /** @ORM\Column(type="string", length=100) 
     *  @Assert\NotBlank(message = "Por favor, indica tus apellidos")
     */
    protected $surnames;

    
    /** @ORM\Column(type="datetime") */
    protected $date;
    
    public function __construct()
    {
        $this->date = new \DateTime();
    }
    
    function eraseCredentials()
    {
    }
    
    function getRoles()
    {

        return array('ROLE_USER_STUDENT');
    }
    
    function getUsername()
    {
        return $this->getName();
    }
    
    public function __sleep()
    {
        return array('id');
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    
        return $this;
    }

    /**
     * Get salt
     *
     * @return string 
     */
    public function getSalt()
    {
        return $this->salt;
    }    


    /**
     * Set name
     *
     * @param string $name
     * @return Student
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
     * Set date
     *
     * @param \DateTime $date
     * @return Student
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
    
    
    public function __toString()
    {
        return $this->getName().' '.$this->getSurNames();
    }
    
    public function getLabel()
    {
        return $this->getId() . ' ('. $this->getName() .')';
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Student
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set surnames
     *
     * @param string $surnames
     * @return Student
     */
    public function setSurnames($surnames)
    {
        $this->surnames = $surnames;

        return $this;
    }

    /**
     * Get surnames
     *
     * @return string 
     */
    public function getSurnames()
    {
        return $this->surnames;
    }

}
