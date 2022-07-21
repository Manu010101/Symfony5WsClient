<?php

namespace App\Controller;

use App\Soap\CategorieSoap;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function showAccueil()
    {
        return $this->render("base.html.twig");
    }
}