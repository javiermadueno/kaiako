<?php 
namespace kaiako\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use kaiako\AdBundle\Entity\Ciudad;
use kaiako\UserBundle\Entity\Teacher;

class Usuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
	
	public function getOrder(){
		return 50;
	}

	private $container;

	public function setContainer(ContainerInterface $container = null)
	{
		$this->container = $container;
	}

	public function load(ObjectManager $manager)
	{
		$ciudades = $manager->getRepository('AdBundle:Province')->findAll();
        $idiomas = $manager->getRepository('UserBundle:Language')->findAll();

		for($i=0; $i<500; $i++){

			$teacher = new  Teacher();

			$teacher->setName($this->getNombre());
			$teacher->setSurnames($this->getApellidos());
			$teacher->setEmail('teacher'.$i.'@localhost.com');

			$teacher->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));

			$password = 'teacher'.$i;

			$encoder = $this->container->get('security.encoder_factory')->getEncoder($teacher);

			$passwordCodificado = $encoder->encodePassword($password, $teacher->getSalt());

			$teacher->setPassword($passwordCodificado);

			$teacher->setNifCif($this->getNif());
			$teacher->setCompanyName($this->getEmpresa());

			$ciudad = $ciudades[array_rand($ciudades)];
			$teacher->setAddress($this->getDireccion());

			$teacher->setProvince($ciudad);
			$teacher->setTown($ciudad);
			$teacher->setZipcode($this->getCodigoPostal());
			$teacher->setMobile($this->getTelefono());
			$teacher->setTelephone($this->getTelefono());

            $teacher->addLanguage($idiomas[array_rand($idiomas)]);
			

			$teacher->setDate(new \DateTime('now - '.rand(1, 150).' days'));
			$teacher->setPhoto('hola');


			$manager->persist($teacher);

		}

		$manager->flush();
	}
	/**
     * Generador aleatorio de nombres de personas.
     * Aproximadamente genera un 50% de hombres y un 50% de mujeres.
     *
     * @return string Nombre aleatorio generado para el usuario.
     */
    private function getNombre()
    {
        // Los nombres más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm

        $hombres = array(
            'Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David',
            'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier',
            'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel',
            'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando',
            'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto'
        );
        $mujeres = array(
            'María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María',
            'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca',
            'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta',
            'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción',
            'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María'
        );

        if (rand() % 2) {
            return $hombres[array_rand($hombres)];
        } else {
            return $mujeres[array_rand($mujeres)];
        }
    }

    /**
     * Generador aleatorio de apellidos de personas.
     *
     * @return string Apellido aleatorio generado para el usuario.
     */
    private function getApellidos()
    {
        // Los apellidos más populares en España según el INE
        // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm

        $apellidos = array(
            'García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez',
            'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz',
            'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero',
            'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez',
            'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina',
            'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín',
            'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido'
        );

        return $apellidos[array_rand($apellidos)].' '.$apellidos[array_rand($apellidos)];
    }

    /**
     * Generador aleatorio de direcciones postales.
     *
     * @param  Ciudad $ciudad Objeto de la ciudad para la que se genera una dirección postal.
     * @return string         Dirección postal aleatoria generada para la tienda.
     */
    private function getDireccion()
    {
        $prefijos = array('Calle', 'Avenida', 'Plaza');
        $nombres = array(
            'Lorem', 'Ipsum', 'Sitamet', 'Consectetur', 'Adipiscing',
            'Necsapien', 'Tincidunt', 'Facilisis', 'Nulla', 'Scelerisque',
            'Blandit', 'Ligula', 'Eget', 'Hendrerit', 'Malesuada', 'Enimsit'
        );

        return $prefijos[array_rand($prefijos)].' '.$nombres[array_rand($nombres)].', '.rand(1, 100)."\n"
               .$this->getCodigoPostal();
    }

    /**
     * Generador aleatorio de códigos postales
     *
     * @return string Código postal aleatorio generado para la tienda.
     */
    private function getCodigoPostal()
    {
        return sprintf('%02s%03s', rand(1, 52), rand(0, 999));
    }

    /**
    * Generador de empresas aleatorio
    * @return string Empresa aleatoria para los profesores
    */

    private function getEmpresa()
    {
    	$empresas = array(
            'Apple', 
            'Microsoft', 
            'Abengoa', 
            'Accenture', 
            'Everis', 
            'Movatec', 
            'Eccuo Ingenieria', 
            'Icca');

    	return $empresas[array_rand($empresas)];     
    }

    private function getNif(){
    	$stack = 'TRWAGMYFPDXBNJZSQVHLCKE';

    	$numeracion = sprintf('%02s%06s', rand(30,44), rand(111111,999999));

    	$pos = $numeracion % 23;

    	return $numeracion. strtoupper(substr($stack, $pos, 1));
    }

    private function getTelefono()
    {
    	return sprintf('%03s%06s', rand(600,799), rand(111111,999999));
    }
}
 ?>