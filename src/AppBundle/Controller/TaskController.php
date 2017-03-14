<?php

namespace AppBundle\Controller;

use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Task;

class TaskController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $categories = $this->container->get('app.category.manager')->getCategory();



        return $this->render('default/index.html.twig', [
                                                         'categories' => $categories]);

    }

    /**
     * @Route("/newTask", name="app_new_task")
     */
    public function addTask(Request $request){

        $task = $this->container->get('app.task.manager')->createTask();

        //créer et enregistrer une nouvelle tâche
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $task = $form->getData();
            $this->container->get('app.task.manager')->saveTask($task);

            return $this->redirectToRoute('homepage');
        }

        return $this->render(':tasks:newTask.html.twig', ['form' => $form->createView(),]);
    }

}