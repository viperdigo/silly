<?php

namespace ProjectSilly\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParameterRepository extends EntityRepository
{
    public function getValueParameter($id)
    {
        $qb = $this->getEntityManager()->createQueryBuilder();

        $qb->select("p.value")
            ->from('CoreBundle:Parameter', 'p')
            ->where('p.id = :id')
            ->setParameter('id', $id)
        ;

        $result =  $qb->getQuery()->getResult();

        if($result){
            return $result[0]['value'];
        }else{
            return null;
        }


    }

}