<?php

namespace AppBundle\Controller;

use AppBundle\Form\TaskType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Task;
use AppBundle\Entity\Category;

class TaskController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $categories = $this->container->get('app.category.manager')->getCategory();



        return $this->render('default/index.html.twig', ['categories' => $categories]);

    }

    /**
     * @Route("/newTask", name="app_new_task")
     */
    public function addTaskAction(Request $request){

        $task = $this->container->get('app.task.manager')->createTask();

        //créer et enregistrer une nouvelle tâche
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $task = $form->getData();
            $this->container->get('app.task.manager')->saveTask($task);

            return $this->redirectToRoute('homepage');
        }

        return $this->render(':task:newTask.html.twig', ['form' => $form->createView(),]);
    }

    /**
     * @Route("/task/{id}", name="app_task_edit")
     */
    public function editAction(Request $request, $id)
    {
        $task     = $this->getDoctrine()->getRepository(Task::class)->getTask($id);
        $category = $task->getCategory();

        //modifier une tâche
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $task = $form->getData();
            $this->container->get('app.task.manager')->saveTask($task);

            return $this->redirectToRoute('homepage');
        }

        if(!$task instanceof Task){

            throw $this->createNotFoundException(sprintf('La tâche° %d n\'existe pas', $id));

        }elseif($form->isSubmitted() && $form->isValid()){

            $task = $form->getData();
            $this->container->get('app.task.manager')->saveTask($task);

            return $this->redirectToRoute('homepage');
        }

        return $this->render(':task:edit.html.twig', ['task'     => $task,
                                                        'category' => $category,
                                                        'form'     => $form->createView()]
        );
    }


}