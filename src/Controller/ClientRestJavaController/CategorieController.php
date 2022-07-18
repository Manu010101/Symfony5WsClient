<?php

namespace App\Controller\ClientRestJavaController;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    /**
     * @Route("/RestJava", name="RestJavaShow")
     * @return Response
     */
    public function showAccueil()
    {
        return $this->render("vuesApiRestJava/categorie.html.twig");
    }

    /**
     * @Route("/RestJava/createCategorie", name="RestJavaCreateCategorie")
     * @param Request $request
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function createCategorie(Request $request){

//        try {
            $client = HttpClient::create();
            $reponse = $client->request('POST', 'http://localhost:8080/demo7_war_exploded/api/categorie/create',[
                'headers' => [
                    'Content-Type' => ['application/x-www-form-urlencoded'],
                    'Accept' => 'application/json'
                ],
                'body' => [
                    'libelle' => $request->get('libelle'),
                    'texte' => $request->get('texte')
                    ]
            ]);
            $content = $reponse->getContent();
            return $this->render("vuesApiRestJava/categorie.html.twig", array("reponseApi" => $content));
//        } catch (\Exception $exception) {
//            return $this->render("vuesApiRestJava/categorie.html.twig", array('exception' => $exception));
//        }

    }

}