<?php 

namespace kaiako\UserBundle\Form\Frontend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', 'text', array('required'    => false,
                                  'label'       => 'E-mail'))
        ->add('password', 'repeated', array('required'          => false,
                                            'type'              => 'password',
                                            'invalid_message'   => 'Las dos contraseñas deben coincidir',
                                            'options'           => array('attr'  => array('maxlength' => 12)),
                                            'first_options'     => array('label' => 'Contraseña'),
                                            'second_options'    => array('label' => 'Repita contraseña')
                                            ))
        ->add('name', 'text', array('label'    => 'Nombre',
                                         'required' => false))
        ->add('surnames', 'text', array('label'    => 'Apellidos',
                                         'required' => false))
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolve)
    {
        $resolve->setDefaults(array('data_class' => 'kaiako\UserBundle\Entity\Student'));
    }
    
    public function getName()
    {
        return 'studenttype';
    }
}
