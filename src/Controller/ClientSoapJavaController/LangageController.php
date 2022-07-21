<?php

namespace App\Controller\ClientSoapJavaController;

use App\Services\SoapJava\LangageService;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class LangageController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/SoapJava", name="sjShow")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(SessionInterface $session, LangageService $langageService)
    {
        try {
            if (!$session->has('langageIds')) {
                $session->set('langageIds', $langageService->fetchLangageIds());
            }
            return $this->render("vuesApiSoapJava/langage.html.twig");
        } catch (\Exception $exception) {
            return $this->render(
                "vuesApiSoapJava/langage.html.twig",
                array("exception" => $exception)
            );
        }
    }

    /**
     * @Route("SoapJava/langage", name="sjLangage")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getLangage(\Symfony\Component\HttpFoundation\Request $request, LangageService $langageService)
    {

        try {
            return $this->render("vuesApiSoapJava/langage.html.twig",
                ['langage' => $langageService->fetchLangage($request->get("langageId"))]
            );
        } catch (\Exception $exception) {
            return $this->render("vuesApiSoapJava/langage.html.twig", array('exception' => $exception));
        }
    }


    public function getLangages(LangageService $langageService)
    {
        try {
            return $this->render("vuesApiSoapJava/langage.html.twig",
                ['langages' => $langageService->fetchLangages()]
            );
        } catch (\Exception $exception) {
            return $this->render("vuesApiSoapJava/langage.html.twig", array('exception' => $exception));
        }
    }
}