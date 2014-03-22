<?php 

namespace kaiako\AdBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class AdType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('category', 'entity', array('required'      => false,
                                                    'label'         => 'Categoría', 
                                                    'empty_value'   => '-- Selecciona una categoría --',
                                                    'class'         => 'AdBundle:Category',
                                                    'query_builder'   => function(EntityRepository $er) 
                                                                            {
                                                                                return $er->createQueryBuilder('c')
                                                                                ->orderBy('c.name', 'ASC');
                                                                            },))
        ->add('province', 'entity', array('required'      => false,
                                                    'label'         => 'Provincia', 
                                                    'empty_value'   => '-- Selecciona una provincia --',
                                                    'class'         => 'AdBundle:Province',
                                                    'query_builder'   => function(EntityRepository $er) 
                                                                            {
                                                                                return $er->createQueryBuilder('p')
                                                                                ->orderBy('p.name', 'ASC');
                                                                            },))
        ->add('skiResort', 'entity', array('required'      => false,
                                                    'label'         => 'Estación de Esquí', 
                                                    'empty_value'   => '-- Selecciona una estación --',
                                                    'class'         => 'AdBundle:SkiResort',
                                                    'query_builder'   => function(EntityRepository $er) 
                                                                            {
                                                                                return $er->createQueryBuilder('s')
                                                                                ->orderBy('s.name', 'ASC');
                                                                            },))                                                                            
        ->add('headline', 'text', array('label'       => 'Titular',
                                  'required'    => false))
        ->add('description','textarea', array('label'    => 'Descripción',
                                     'required' => false))
        ->add('prize', 'number', array('required'   => false,
                                           'label'      => 'Precio por hora'))
        ->add('dateTo', 'datetime', array('required'    => false, 
                                                      'label'       => ' ', 
                                                      'widget'      =>'single_text',
                                                      'format'      =>'dd/MM/yyyy',
                                                      'read_only'   => 'true'))
        ->add('groups', 'choice', array('required'   => false, 
                                          'label'       => 'Grupos',
                                          'choices'     => array("1"    => 'Sí',
                                                                 "0"    => 'No'),
                                          'multiple'    => false,
                                          'expanded'    => true,
                                          'empty_value' => false))                                                                
        
        ;
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolve)
    {
        $resolve->setDefaults(array(
        'data_class' => 'kaiako\AdBundle\Entity\Ad'
        ));
    }
    
    public function getName()
    {
        return 'adtype';
    }
}
