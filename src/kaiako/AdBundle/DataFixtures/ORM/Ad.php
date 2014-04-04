<?php 

namespace kaiako\AdBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use kaiako\AdBundle\Entity\Ad;


class Anuncios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
	public function getOrder(){
		return 60;
	}

	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		$profesores = $manager->getRepository('UserBundle:Teacher')->findAll();
		$ciudades = $manager->getRepository('AdBundle:Province')->findAll();
		$categorias = $manager->getRepository('AdBundle:Category')->findAll();

		foreach ($ciudades as $ciudad) {
			$profesores = $manager->getRepository('UserBundle:Teacher')->findByProvince($ciudad->getName());
		
			for ($i=1; $i<=10; $i++){
				$anuncio = new Ad();

				$categoria = $categorias[array_rand($categorias)];

				$anuncio->setTitle('Clases de '. $categoria->getName());
				$anuncio->setDescription($this->getDescripcion());
				$anuncio->addProvince($ciudad);
				$anuncio->setTeacher($profesores[array_rand($profesores)]);
				$anuncio->setPrize(number_format( rand(1000,30000)/100 , 2 ));
				$anuncio->setCategory($categoria);

				if(1 == $i) {
					$fecha = 'today';
				} elseif ($i < 5) {
					$fecha = 'now - '.($i-1).' days';
				}else{
					$fecha = 'now + '.($i - 5 + 1).' days';
				}

				$fechaPublicacion = new \Datetime($fecha);
				$fechaPublicacion->setTime(23, 59, 59);

				$fechaExpiracion = clone $fechaPublicacion;
				$fechaExpiracion->add(\DateInterval::createFromDateString(rand(24, 360).' hours'));

				$anuncio->setDate($fechaPublicacion);
				$anuncio->setDateTo($fechaExpiracion);

				$manager->persist($anuncio);

			}
			

		}

		$manager->flush();
	}

	public function getCategoria()
	{
		$deportes = array_flip(array('Padle', 'Tenis', 'Ski', 'Fútbol', 'Fitness', 'Crossfit', 'Ajedrez', 'Baloncesto'));

		return array_rand($deportes);
	}


	public function getDescripcion()
	{
		$frases = array_flip(array(
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            'Mauris ultricies nunc nec sapien tincidunt facilisis.',
            'Nulla scelerisque blandit ligula eget hendrerit.',
            'Sed malesuada, enim sit amet ultricies semper, elit leo lacinia massa, in tempus nisl ipsum quis libero.',
            'Aliquam molestie neque non augue molestie bibendum.',
            'Pellentesque ultricies erat ac lorem pharetra vulputate.',
            'Donec dapibus blandit odio, in auctor turpis commodo ut.',
            'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
            'Nam rhoncus lorem sed libero hendrerit accumsan.',
            'Maecenas non erat eu justo rutrum condimentum.',
            'Suspendisse leo tortor, tempus in lacinia sit amet, varius eu urna.',
            'Phasellus eu leo tellus, et accumsan libero.',
            'Pellentesque fringilla ipsum nec justo tempus elementum.',
            'Aliquam dapibus metus aliquam ante lacinia blandit.',
            'Donec ornare lacus vitae dolor imperdiet vitae ultricies nibh congue.',
        ));

        $numeroFrases = rand(4, 7);

        return implode("\n", array_rand($frases, $numeroFrases));
	}


}

 ?>