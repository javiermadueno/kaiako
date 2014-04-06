<?php
namespace kaiako\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints as DoctrineAssert;
use Symfony\Component\Validator\ExecutionContext;
use kaiako\AdBundle\Entity\Province;
use kaiako\AdBundle\Entity\Ad;


/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @DoctrineAssert\UniqueEntity(fields = {"id", "nifCif"})
 * @Assert\Callback(methods={"check_DNI_CIF"})
*/
class Teacher implements UserInterface
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
    
    /**
     *  @ORM\Column(type="string",length=9)
     *  @Assert\NotBlank(message = "Por favor, indica el DNI/CIF")
     *  @Assert\Length(min=9, max=9, exactMessage = "El valor debe tener exactamente 9 caracteres")
    */
    protected $nifCif;
    
    /** @ORM\Column(type="string", length=100, nullable=true)
     *  @Assert\NotBlank(message = "Por favor, indica el nombre de la compañia")
     */
    protected $companyName;
    
    /** @ORM\Column(type="string", length=100) 
     *  @Assert\NotBlank(message = "Por favor, indica un nombre")
     */
    protected $name; 
    
    /** @ORM\Column(type="string", length=100) 
     *  @Assert\NotBlank(message = "Por favor, indica tus apellidos")
     */
    protected $surnames;
    
    /** @ORM\Column(type="string") 
     *  @Assert\NotBlank(message = "Por favor, indica un número de teléfono")
     *  @Assert\Length(min = 9, 
     *                 minMessage = "El teléfono debe tener {{ limit }} caracteres como mínimo",
     *                 max = 14,
     *                 maxMessage = "El teléfono debe tener {{ limit }} caracteres como máximo")
     */
    protected $telephone;
    
    /** @ORM\Column(type="string",nullable=true) 
     *  @Assert\Length(min = 9, 
     *                 minMessage = "El móvil debe tener {{ limit }} caracteres como mínimo",
     *                 max = 14,
     *                 maxMessage = "El móvil debe tener {{ limit }} caracteres como máximo")
     */
    protected $mobile;
    

    
    /** @ORM\Column(type="datetime") */
    protected $date;
    
    /**
     * @ORM\OneToMany(targetEntity="kaiako\AdBundle\Entity\Ad", mappedBy="teacher")
     */
    protected $ads;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $address;

    /**
    * @ORM\Column(type="string")
    */
    protected $town;

    /**
    * @ORM\Column(type="string")
    */
    protected $province;

    /**
    * @ORM\Column(type="string")
    */
    protected $zipcode;
    
    /** 
     * @var ArrayCollection $languages
     * @ORM\ManyToMany(targetEntity="kaiako\UserBundle\Entity\Language")
     * @ORM\JoinTable(name="languages_teachers",
     *      joinColumns={@ORM\JoinColumn(name="teacher_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="language_id", referencedColumnName="id")}
     *      ) 
    */
    protected $languages;
    
    /**
    * @ORM\Column(type="string")
    */
    protected $photo;


    public function __construct()
    {
        $this->date = new \DateTime();
        $this->ads = new \Doctrine\Common\Collections\ArrayCollection();
        $this->languages = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    function eraseCredentials()
    {
    }
    
    function getRoles()
    {

        return array('ROLE_USER_TEACHER');
    }
    
    function getUsername()
    {
        return $this->getId();
    }
    
    // public function __sleep()
    // {
    //     return array('id');
    // }

    /**
     * Set password
     *
     * @param string $password
     * @return Teacher
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
     * @return Teacher
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
    
    public function __toString()
    {
        return $this->getName();
    }
    
    public function getLabel()
    {
        return $this->getId() . ' ('. $this->getName() .')';
    }

    /**
     * Get Id
     *
     * @return integer 
     */
    public function getId(){
        return $this->id;
    }

    
    /*-------------------------------------------------------------------------------------
     * -------------------- Función para comprobar DNI/NIE/CIF válido ---------------------
     * ------------------------------------------------------------------------------------
     */
    function check_DNI_CIF( ExecutionContext $context )
    {
        if ($this->getNifCif() != "")
        {
            // Normalizamos el formato
            $str = preg_replace( '/[^0-9A-Z]/i', '', $this->getNifCif() );

            // NIF (DNI)
            if (preg_match('/X?[0-9]{8}[A-Z]/i', $str))
            {
                // Calculamos que letra corresponde al número del DNI
                $stack = 'TRWAGMYFPDXBNJZSQVHLCKE';
                $pos = substr($str, 0, 8) % 23;
                if (strtoupper( substr($str, 8, 1) ) == substr($stack, $pos, 1) )
                    return true;
                else
                {
                    $context->addViolationAt('dni', 'El DNI introducido no es correcto. Comprueba que no tenga guiones ni espacios en blanco', array(), null);
                    return;
                }
            }
            // NIE
            else if(preg_match('/^[XYZ][0-9]{7}[A-Z]$/i', $str))
            {
                // Sustituimos la primera letra (X, Y o Z) por los números 0, 1 o 2 respectivamente
                $str2 = str_replace(array('X', 'Y', 'Z'), array(0, 1, 2), $str);

                // Calculamos que letra corresponde al número del NIE
                $stack = 'TRWAGMYFPDXBNJZSQVHLCKE';
                $pos = substr($str2, 0, 8) % 23;
                if (strtoupper( substr($str2, 8, 1) ) == substr($stack, $pos, 1) )
                    return true;
                else
                {
                    $context->addViolationAt('dni', 'El NIE introducido no es correcto. Comprueba que no tenga guiones ni espacios en blanco', array(), null);
                    return;
                }
            }
            // CIF
            else if (preg_match('/[A-HK-NPQS][0-9]{7}[A-J0-9]/i', $str)) //CIF
            {
                // Sumar los digitos en posiciones pares
                $sum = 0;
                for ($i=2; $i<strlen($str)-1; $i+=2) 
                    $sum += substr($str, $i, 1);            

                // Multiplicar los digitos en posiciones impares por 2 y sumar los digitos del resultado
                for ($i=1; $i<strlen($str)-1; $i+=2) {
                    $t = substr($str, $i, 1) * 2;
                    //agrega la suma de los digitos del resultado de la multiplicación
                    $sum += ($t>9)?($t-9):$t;
                }

                // Restamos el último digito de la suma actual a 10 para obtener el control
                $control = 10 - ($sum % 10);

                // El control puede ser un número o una letra
                if ( substr($str, 8, 1) == $control || strtoupper(substr($str, 8, 1)) == substr('JABCDEFGHI', $control, 1 ))
                      return true;
                else
                {
                    $context->addViolationAt('dni', 'El CIF no es válido. Comprueba que no tenga guiones ni espacios en blanco', array(), null);
                    return;
                }
            // ERROR GENERAL
            }else{
                $context->addViolationAt('dni', 'El DNI/CIF no es válido. Comprueba que no tenga guiones ni espacios en blanco', array(), null);
                return;
            }
        }
    }    

    /**
     * Set email
     *
     * @param string $email
     * @return Teacher
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
     * Set nifCif
     *
     * @param string $nifCif
     * @return Teacher
     */
    public function setNifCif($nifCif)
    {
        $this->nifCif = $nifCif;

        return $this;
    }

    /**
     * Get nifCif
     *
     * @return string 
     */
    public function getNifCif()
    {
        return $this->nifCif;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Teacher
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Teacher
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
     * Set telephone
     *
     * @param string $telephone
     * @return Teacher
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Teacher
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Teacher
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
     * Set address
     *
     * @param string $address
     * @return Teacher
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add ads
     *
     * @param \kaiako\AdBundle\Entity\Ad $ads
     * @return Teacher
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
     * Add languages
     *
     * @param \kaiako\UserBundle\Entity\Language $languages
     * @return Teacher
     */
    public function addLanguage(\kaiako\UserBundle\Entity\Language $languages)
    {
        $this->languages[] = $languages;

        return $this;
    }

    /**
     * Remove languages
     *
     * @param \kaiako\UserBundle\Entity\Language $languages
     */
    public function removeLanguage(\kaiako\UserBundle\Entity\Language $languages)
    {
        $this->languages->removeElement($languages);
    }

    /**
     * Get languages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set surnames
     *
     * @param string $surnames
     * @return Teacher
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

    /**
     * Get zipcode
     *
     * @return string 
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }
    
    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Teacher
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get town
     *
     * @return string 
     */
    public function getTown()
    {
        return $this->town;
    }
    
    /**
     * Set town
     *
     * @param string $town
     * @return Teacher
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }
    
    /**
     * Get province
     *
     * @return string 
     */
    public function getProvince()
    {
        return $this->province;
    }
    
    /**
     * Set province
     *
     * @param string $province
     * @return Teacher
     */
    public function setProvince($province)
    {
        $this->province = $province;

        return $this;
    }

    public function setPhoto($url){
        $this->photo = $url;
        return $this;
    }

    public function getPhoto(){
        return $this->photo;
    }
    
}
