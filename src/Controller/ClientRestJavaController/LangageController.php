<?php

namespace App\Controller\ClientRestJavaController;

use App\Services\RestJava\LangageService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LangageController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/RestJava", name="RestJavaShow")
     * @return Response
     */
    public function showAccueil(SessionInterface $session, LangageService $langageService)
    {
        try {
            if (!$session->has('langageIds')) {
                $session->set('langageIds', $langageService->getLangageIds());
            }
            return $this->render(
                "vuesApiRestJava/langage.html.twig"
            );
        } catch (\Exception $exception) {
            return $this->render(
                "vuesApiRestJava/langage.html.twig",
                ["exception" => $exception]
            );
        }

    }

    /**
     * @Route("restJava/langage", name="rjLangage")
     * @return Response
     */
    public function getLangage(Request $request, LangageService $langageService)
    {
        try {
            return $this->render(
                "vuesApiRestJava/langage.html.twig",
                ["langage" => $langageService->getLangage($request->get("id"))]
            );
        } catch (\Exception $exception) {
            return $this->render("vuesApiRestJava/langage.html.twig", array('exception' => $exception));
        }
    }

    /**
     * @Route("restJava/langage/ide", name="rjLangageIde")
     * @param Request $request
     * @param LangageService $langageService
     * @return Response
     */
    public function getLangageWithIde(Request $request, LangageService $langageService)
    {
        try {
            $resultat = $langageService->getLangageWithIde($request->get("id"));
            return $this->render(
                "vuesApiRestJava/langage.html.twig",
                [
                    "langage" => $resultat["langage"],
                    "ides" => $resultat["ides"]
                ]
            );
        } catch (\Exception $exception) {
            return $this->render("vuesApiRestJava/langage.html.twig", array('exception' => $exception));
        }
    }

    /**
     * @Route("restJava/langages", name="rjLangages")
     * @return Response
     */
    public function getLangages(LangageService $langageService)
    {
        try {
            return $this->render(
                "vuesApiRestJava/langage.html.twig",
                array("langages" => $langageService->getLangages()));
        } catch (\Exception $exception) {
            return $this->render("vuesApiRestJava/langage.html.twig", array('exception' => $exception));
        }
    }

    /**
     * @Route("restJava/langage/delete", name="rjLangageDelete")
     * @param Request $request
     * @param LangageService $langageService
     * @return Response
     */
    public function deleteLangage(Request $request, LangageService $langageService, SessionInterface $session)
    {
        try {
            $langageService->deleteLangage($request->get("id"));
            $session->set("langageIds", $langageService->getLangageIds());
            return $this->redirectToRoute("RestJavaShow");
        } catch (\Exception $exception) {
            return $this->render("vuesApiRestJava/langage.html.twig", array('exception' => $exception));
        }
    }

    /**
     * @Route("/RestJava/createCategorie", name="RestJavaCreateCategorie")
     * @param Request $request
     * @return Response
     */
    public function createCategorie(Request $request, LangageService $langageService, SessionInterface $session)
    {

        try {
            $langage = $langageService->createLangage(
                $request->get("nom"),
                $request->get("caracteristiques")
            );
            $session->set("langageIds", $langageService->getLangageIds());
            return $this->render(
                "vuesApiRestJava/langage.html.twig",
                ["langageCreated" => $langage]
            );
        } catch (\Exception $exception) {
            return $this->render("vuesApiRestJava/langage.html.twig", array('exception' => $exception));
        }

    }

}