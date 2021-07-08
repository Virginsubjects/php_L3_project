<?php

namespace App\Controller;

use App\Entity\Pokemon;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainControlleurController extends AbstractController
{
    /**
     * @Route("/main/controlleur", name="main_controlleur")
     */
    public function index(): Response
    {
        return $this->render('main_controlleur/train.html.twig', [
            'controller_name' => 'MainControlleurController',
        ]);
    }

    /**
     * @Route("/train/{id}", name="train")
     */
    public function trainPokemon($id, EntityManagerInterface $manager)
    {
        $pokemon = $this->getDoctrine()
            ->getRepository(Pokemon::class)->findById(['id' => $id]);
        $pokemon[0]->setExpe($pokemon[0]->getExpe()+random_int(10, 30));
        $manager->persist($pokemon[0]);
        $manager->flush();
        /*return $this->render('main_controlleur/train.html.twig', [
            'controller_name' => 'MainControlleurController',
        ]);*/

    }

    /**
     * @Route("/fight/{id}", name="fight")
     */
    public function chooseForFighting($id, EntityManagerInterface $manager)
    {
        $pokemon = $this->getDoctrine()
            ->getRepository(Pokemon::class)->findBy(['id' => $id]);
        $this->getUser()->setPokeForFighting($pokemon);
        $manager->persist($this->getUser());
        $manager->flush();
       /* return $this->render('main_controlleur/catch.html.twig', [
            'controller_name' => 'MainControlleurController', 'pokemon'=>$pokemon[0]
        ]);*/
        return $this->redirectToRoute('new',['pokemon'=>$pokemon]);
    }

    /**
     * @Route("/catch/{name},{evolution}", name="catch")
     */
    public function catchPokemon($name, $evolution, EntityManagerInterface $manager, LoggerInterface $logger)
    {
        $dresseurId= $this->getUser()->getId();
        $pokemon = new Pokemon();
        $pokemon->setName($name);
        $pokemon->setDresseurId($dresseurId);
        $pokemon->setEvolution($evolution);
        $manager->persist($pokemon);
        $manager->flush();
        $pokeForFighting = $this->getUser()->getPokeForFighting();
        return $this->render('main_controlleur/catch.html.twig', [
            'controller_name' => 'MainControlleurController', 'pokeForFighting'=>$pokeForFighting[0],'pokemon'=>$pokemon
        ]);
    }
}
