<?php 

namespace kaiako\UserBundle\Form\Frontend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class TeacherType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', 'text', array('label'       => 'E-mail',
                                  'required'    => false))
        ->add('password', 'repeated', array('required'          => false,
                                            'type'              => 'password',
                                            'invalid_message'   => 'Las dos contraseñas deben coincidir',
                                            'options'           => array('attr' => array('maxlength' => 12)),
                                            'first_options'     => array('label' => 'Contraseña'),
                                            'second_options'    => array('label' => 'Repita contraseña')
                                            ))
        ->add('nifCif','text', array('label'    => 'DNI/NIE/CIF',
                                     'required' => false,
                                     'attr'     => array('maxlength' => 9)))
        ->add('companyName', 'text', array('required'   => false,
                                           'label'      => 'Nombre de la empresa'))
        ->add('name', 'text', array('label'    => 'Nombre',
                                         'required' => false))
        ->add('surnames', 'text', array('label'    => 'Apellidos',
                                         'required' => false))
        ->add('telephone','number',array('label'    => 'Teléfono',
                                         'attr'     => array('maxlength' => 14), 
                                         'required' => false))
        ->add('mobile','number',array('required'    => false,
                                      'label'       => 'Móvil', 
                                      'attr'        => array('maxlength' => 14)))
        ->add('zipcode', 'text', array('required'   => false,
                                       'label'      => 'Código Postal',
                                       'attr'       => array('maxlength' => 5)))
        ->add('town', 'text', array('required' => false,
                                     'label'    => 'Población'))
        ->add('province', 'text', array('required' => false,
                                     'label'    => 'Provincia'))
        ->add('address', 'text', array('required' => false,
                                     'label'    => 'Dirección'))
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolve)
    {
        $resolve->setDefaults(array(
        'data_class' => 'kaiako\UserBundle\Entity\Teacher'
        ));
    }
    
    public function getName()
    {
        return 'teachertype';
    }
}
