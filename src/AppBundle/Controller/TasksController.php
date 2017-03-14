<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tasks;

class TasksController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $tasks = $this->container->get('app.tasks.manager')->getTasks();

        return $this->render('default/index.html.twig', ['tasks' => $tasks,]);

    }

    public function addTask(Request $request){

        $tweet = $this->container->get('app.tasks.manager')->createTask();

        //créer et enregistrer une nouvelle tâche
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $task = $form->getData();
            $this->container->get('app.tasks.manager')->saveTask($task);
            $this->container->get('app.tasks.manager')->sendCreatedTask();

            return $this->redirectToRoute('homepage');
        }

        return $this->render(':task:newTask.html.twig', ['form' => $form->createView(),]);
    }

}