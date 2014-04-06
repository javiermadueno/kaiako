<?php 
namespace kaiako\AdBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use kaiako\AdBundle\Entity\Day;

class Dias extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
	public function getOrder()
	{
		return 16;
	}

	private $container;

	public function setContainer(ContainerInterface $container=null)
	{
		$this->conatiner = $container;
	}

	public function load(ObjectManager $manager)
	{
		$dias = array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');

		foreach ($dias as $nombre) {
			$dia = new Day();
			$dia->setName($nombre);

			$manager->persist($dia);
		}

		$manager->flush();
	}
}
 ?>