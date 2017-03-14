<?php

namespace AppBundle\Manager;

use AppBundle\Entity\Category;


class CategoryManager{

    private $entityManager;
    private $nbLast;

    public function __construct($entityManager, $nbLast)
    {
        $this->entityManager = $entityManager;
        $this->nbLast = $nbLast;
    }

    /*public function createTask()
    {
        new Task();
    }

    public function saveTask($task){

        $em = $this->entityManager;
        $em->persist($task);
        $em->flush();

    } */


    public function getCategory(){

        $categories = $this->entityManager->getRepository(Category::class)->getAllCategories($this->nbLast);

        return $categories;

    }

}