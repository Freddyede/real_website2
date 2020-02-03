<?php

namespace App\Controller;

use App\Entity\Acteurs;
use App\Entity\Films;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilmsController extends AbstractController
{
    /**
     * @Route("/films", name="films")
     */
    public function index()
    {

        $acteurs = $this->getDoctrine()->getRepository(Acteurs::class)->findAll();
        foreach ($acteurs as $acteur){
            $titre_acteurs = $acteur->getFilmsTitre();
        }
        return $this->render('films/index.html.twig', array(
            'films'=>$this->getDoctrine()->getRepository(Films::class)->findBy(array('titre'=>$titre_acteurs)),
            'controller_name' => 'FilmsController',
        ));
    }

    /**
     * @Route("/film/{id}", name="findFilm")
     * @param $id
     * @return Response
     */
    public function find($id)
    {
        return $this->render('films/read.html.twig', array(
            'film'=>$this->getDoctrine()->getRepository(Films::class)->find($id),
            'controller_name' => 'FilmsController',
        ));
    }
}
