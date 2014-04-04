<?php 

namespace kaiako\AdBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use kaiako\AdBundle\Entity\Category;

class Categorias extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
	public function getOrder()
	{
		return 15;
	}

	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		$deportes = array('Padle', 'Tenis', 'Ski', 'Fútbol', 'Fitness', 'Crossfit', 'Ajedrez', 'Baloncesto', 'Hipica');

		foreach ($deportes as $nombre) {
			$categoria = new Category();
			$categoria->setName($nombre);

			$manager->persist($categoria);
		}

		$manager->flush();
	}
}

 ?>