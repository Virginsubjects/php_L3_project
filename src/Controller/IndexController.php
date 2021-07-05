<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Psr\Log\LoggerInterface;

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
     * @IsGranted("ROLE_USER")
     */
    public function list(LoggerInterface $logger){
        $logger->info($this->getUser()->getId());
        $pokemons = $this->getDoctrine()
            ->getRepository(Pokemon::class)->findBy(['dresseur_id' =>$this->getUser()->getId()]);
        return $this->render('index/list.html.twig',[
            "pokemons" => $pokemons
        ]);
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
