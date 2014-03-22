<?php

namespace eurotransportcar\AdBundle\Entity;
use Doctrine\ORM\EntityRepository;

class AdRepository extends EntityRepository
{
    public function queryAllAds()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
        SELECT a
        FROM AdBundle:Ad a
        ORDER BY a.date DESC');
        return $query;
    }    
}