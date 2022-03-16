<?php
/**
 * test test MSI
 * le fichier est cree le 05/03/2022
 * symfony-api_platform
 * PhpStorm
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractController
{

    public function __construct()
    {
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function homepage()
    {
        return new Response('riadh');
    }

    /**
     * @Route("/questions/{slug}")
     * @return Response
     */
    public function show(string $slug)
    {
        $answers =[
            'riadh1',
            'riadh2',
            'riadh3',
        ];
        $slugEspace=ucwords(str_replace('-', ' ', $slug));
//        var_dump($slugEspace);die;
        return $this->render('question/show.html.twig',[
            'questions'=>$slugEspace,
            'answers'=>$answers,
        ]);
    }
}
