<?php

namespace App\Services\SoapPhp;

use App\Soap\CategorieSoap;

class CategorieService
{

    private $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE
    );

    private $urlWsdlSoapPhp = 'http://localhost:8000/soap?wsdl';
    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new \SoapClient($this->urlWsdlSoapPhp, $this->options);
    }


    /**
     * méthode pour récupérer les ids des catégories disponibles sur le serveur
     * @return mixed
     * @throws \SoapFault
     */
    public function fetchCategorieIds()
    {
        return $this->soapClient->getCategorieIds();
    }

    /**
     * Retourne une catégorie via son id
     * @param $idCategorie
     * @return mixed
     */
    public function fetchCategorie($idCategorie)
    {
        $categorie = new CategorieSoap($idCategorie, '', '');
        return $this->soapClient->getCategorieLibelle($categorie);
    }

}