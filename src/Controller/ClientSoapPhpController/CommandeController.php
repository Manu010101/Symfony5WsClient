<?php

namespace App\Controller\ClientSoapPhpController;

use App\Services\SoapPhp\CommandeService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CommandeController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{

    /**
     * @Route("/commandes", name="commandeShow")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(){
        try {
            return $this->render("vuesApiSoapPhp/commandeVue.html.twig");
        } catch (\Exception $exception) {
            return $this->render(
                "vuesApiSoapPhp/commandeVue.html.twig",
                array("exception" => $exception)
            );
        }
    }

    /**
     * @Route("/commandes/get", name="SoapPhpGetCommande")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \SoapFault
     */
    public function getCommandes(Request $request, CommandeService $commandeService): \Symfony\Component\HttpFoundation\Response
    {
//        try {
            return $this->render(
                "vuesApiSoapPhp/commandeVue.html.twig",
                array("commande" => $commandeService->fetchCommandes(
                    $request->get('debut'),
                    $request->get("fin")
                ))
            );
//        }catch (\Exception $exception){
//            return $this->render(
//                "vuesApiSoapPhp/commandeVue.html.twig",
//                array("exception" => $exception)
//            );
//        }

    }

}