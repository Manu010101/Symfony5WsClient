<?php

namespace App\Controller\ClientSoapPhpController;

use App\Services\SoapPhp\CategorieService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{


    /**
     * @Route("/SoapPHp/show", name="SoapPHpShow")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(SessionInterface $session, CategorieService $categorieService)
    {
        try {
            if (!$session->has('categorieIds')) {
                $session->set('categorieIds', $categorieService->fetchCategorieIds());
            }
            return $this->render("vuesApiSoapPhp/categorieVue.html.twig");
        } catch (\Exception $exception) {
            return $this->render(
                "vuesApiSoapPhp/categorieVue.html.twig",
                array("exception" => $exception)
            );
        }
    }

    /**
     * @Route("/SoapPhp/getCategorie", name="SoapPhpGetCategorie")
     * Vérifie l'id passé via le formulaire, fait appel à l'API, renvoie la vue avec l'objet categorie récupéré
     * @param Request $request
     * @param SessionInterface $session
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCategorie(Request $request, SessionInterface $session, CategorieService $categorieService)
    {
        try {
            $categorieIds = $session->get('categorieIds', $categorieService->fetchCategorieIds());

            if (in_array($request->get('categorieId'), $categorieIds)) {
                $categorie = $categorieService->fetchCategorie($request->get('categorieId'));
                return $this->render(
                    "vuesApiSoapPhp/categorieVue.html.twig",
                    array("categorie" => $categorie)
                );
            }
            throw new \Exception('id ne figure pas dans les objets en BD');

        } catch (\Exception $exception) {
            return $this->render(
                "vuesApiSoapPhp/categorieVue.html.twig",
                array("exception" => $exception)
            );
        }

    }

}