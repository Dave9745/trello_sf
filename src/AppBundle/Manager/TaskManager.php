<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Task;


class TaskManager{

    private $entityManager;
    private $nbLast;

    public function __construct($entityManager, $nbLast)
    {
        $this->entityManager = $entityManager;
        $this->nbLast = $nbLast;
    }

    public function createTask()
    {
        new Task();
    }

    public function saveTask($task){

        $em = $this->entityManager;
        $em->persist($task);
        $em->flush();

    }


    public function getTask(){

        $tasks = $this->entityManager->getRepository(Task::class)->getAllTask($this->nbLast);

        return $tasks;

    }


}