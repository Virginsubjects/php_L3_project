<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    /**
     * @Route("/home", name="home")
     */
    public function home(){
        return $this->render('index/home.html.twig');
    }

    /**
     * @Route("/list", name="list")
     */
    public function list(){
        return $this->render('index/list.html.twig');
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail(){
        return $this->render('index/detail.html.twig');
    }

    /**
     * @Route("/new", name= "new")
     */
    public function new(){
        return $this->render('index/new.html.twig');
    }
}
