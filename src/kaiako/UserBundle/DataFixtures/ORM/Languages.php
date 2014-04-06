<?php 
namespace kaiako\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use kaiako\UserBundle\Entity\Language;


class Languages extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
	public function getOrder()
	{
		return 20;
	}

	private $container;

	public function setContainer(ContainerInterface $container = null){
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		$languages = array(
			'Español', 
			'Inglés', 
			'Aleman',
			'Frances',
			'Italiano',
			'Chino',
			'Portugués',
			'Polaco',
			'Sueco');

		foreach ($languages as $nombre) {
			$language = new Language();
			$language->setName($nombre);

			$manager->persist($language);
		}

		$manager->flush();
	}
}

 ?>