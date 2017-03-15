<?php

namespace AppBundle\Repository;

/**
 * TasksRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TaskRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllTask($maxResults = 10){

        return $this->createQueryBuilder('t')
            ->select('t')
            ->setMaxResults($maxResults)
            ->getQuery()
            ->getResult();

    }

    public function getTask($id){

        return $this->createQueryBuilder('i')
            ->select('i')
            ->andWhere('i.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();

    }
}
