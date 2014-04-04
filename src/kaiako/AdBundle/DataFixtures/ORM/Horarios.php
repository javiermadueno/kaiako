<?php 

namespace kaiko\AdBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use kaiako\AdBundle\Entity\Schedule;


class Horarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
	public function getOrder()
	{
		return 70;
	}

	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		$anuncios = $manager->getRepository('AdBundle:Ad')->findAll();
		$dias = $manager->getRepository('AdBundle:Day')->findAll();

		
		$logger = $this->container->get('logger');

		foreach ($anuncios as $anuncio) {
		
			$horario = new Schedule();

			$numeroDias = rand(1,7);

			$diasSemana = array_rand($dias, $numeroDias);

			for($i = 0; $i < $numeroDias; $i++){
				if(is_array($diasSemana)){
					$dia = $dias[$diasSemana[$i]];
				}else{
					$dia = $dias[$diasSemana];
				}
				
				$horario->addDay($dia);
			}

			$timeFrom = new \DateTime('now');
			$timeFrom->setTime( rand(8,20), 00);

			$timeTo = clone $timeFrom;
			$timeTo->add(\DateInterval::createFromDateString(rand(1, 5).' hours'));

			$horario->setTimeFrom($timeFrom->format('H:i'));
			$horario->setTimeTo($timeTo->format('H:i'));

			$horario->setAd($anuncio);

			$manager->persist($horario);

		}

		$manager->flush();
	}
}

 ?>