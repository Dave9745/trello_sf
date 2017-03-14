<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Tasks;


class TasksManager{

    private $entityManager;
    private $nbLast;

    public function __construct($entityManager, $nbLast)
    {
        $this->entityManager = $entityManager;
        $this->nbLast = $nbLast;
    }

    public function createTweet()
    {
        new Tasks();
    }

    /*public function saveTask($task){

        $em = $this->entityManager;
        $em->persist($task);
        $em->flush();

    }*/


    public function getTasks(){

        $tasks = $this->entityManager->getRepository(Tasks::class)->getAllTasks($this->nbLast);

        return $tasks;

    }

}