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
    private $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE);


    /**
     * @Route("/", name="accueil")
     * @return Response
     */
    public function showAccueil()
    {
        return $this->render("base.html.twig");
    }

//TODO:faudra la virer remplacer....
    /**
     * @Route("/apiSoapPhp", name="apiSoapPhp")
     * @return Response
     */
    public function getApiSoapPhp()
    {

        try {
//            TODO: voir ce qui se passe si onvoie plue que 3 genre 7 - visiblement exceptioon
            $soapClient = new \SoapClient('http://localhost:8000/soap?wsdl', $this->options);
            $categorie = new CategorieSoap(2, '', '');

            return $this->render(
                "apiSoapPhp.html.twig",
                array(
                    'fonctionsDisponibles' => $soapClient->__getFunctions(),
                    'categorie' => $soapClient->getCategorieLibelle($categorie)
                )
            );
        } catch (\Exception $e) {
            return $this->render("apiSoapPhp.html.twig", array('exception' => $e));
        }

    }


    /**
     * @Route("appelRestJava", name="appelApiRestJava")
     * Appel à l'API Java
     * @return Response
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function getApiRestJava()
    {
        try {
            $client = HttpClient::create();
            $reponse = $client->request('GET', 'http://localhost:8080/demo7_war_exploded/api/hello-world');
            $content = $reponse->getContent();
            return $this->render("apiRestJava.html.twig", array("reponseApi" => $content));
        } catch (\Exception $exception) {
            return $this->render("apiRestJava.html.twig", array('exception' => $exception));
        }

    }

    /**
     * @Route("appelSoapJava", name="appelSoapJava")
     * @return Response
     */
    public function getApiSoapJava()
    {

        try {
            $soapClient = new \SoapClient('http://localhost:9090/BoutiqueService?wsdl', $this->options);

            return $this->render("apiSoapJava.html.twig",
                ['res' => $soapClient->getProduit()]
            );
        } catch (\Exception $exception) {
            return $this->render("apiSoapJava.html.twig", array('exception' => $exception));
        }
    }

}