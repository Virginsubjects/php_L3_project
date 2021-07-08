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
        return $this->render('index/train.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/home", name="home")
     * @IsGranted("ROLE_USER")
     */
    public function home()
    {
        $user = $this->getUser();
        return $this->render('index/home.html.twig', ["user" => $user]);
    }

    /**
     * @Route("/list", name="list")
     * @IsGranted("ROLE_USER")
     */
    public function list(LoggerInterface $logger)
    {
        $logger->info($this->getUser()->getId());
        $pokemons = $this->getDoctrine()
            ->getRepository(Pokemon::class)->findBy(['dresseur_id' => $this->getUser()->getId()]);
        return $this->render('index/list.html.twig', [
            "pokemons" => $pokemons
        ]);
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detail()
    {
        return $this->render('index/detail.html.twig');
    }

    /**
     * @Route("/new", name= "new")
     */
    public function new(LoggerInterface $logger)
    {
        $filename = 'C:\Users\rober\OneDrive\Bureau\tp6\src\Controller\pokemon.csv';
        // The nested array to hold all the arrays
        $pokemons = [];

        // Open the file for reading
        if (($h = fopen("{$filename}", "r")) !== FALSE) {
            // Each line in the file is converted into an individual array that we call $data
            // The items of the array are comma separated
            while (($data = fgetcsv($h, 1000, ",")) !== FALSE) {
                // Each individual array is being pushed into the nested array
                $pokemons[] = $data;
            }
            // Close the file
            fclose($h);
            $pokeForFighting = $this->getUser()->getPokeForFighting();
            return $this->render('index/new.html.twig', [
                "pokemons" => $pokemons, "pokeForFighting"=>$pokeForFighting[0]
            ]);
        }
    }
}
