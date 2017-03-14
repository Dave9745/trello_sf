<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Tasks;

class TweetController extends Controller
{
    /**
     * @Route("/", name="app_tasks_list")
     */
     public function getTasks(){

     }

}