<?php

namespace App\Services;

use App\Soap\CategorieSoap;

class CategorieService
{

    private $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE);

    private $urlWsdlSoapPhp = 'http://localhost:8000/soap?wsdl';

    /**
     * méthode pour récupérer les ids des catégories disponibles sur le serveur
     * @return mixed
     * @throws \SoapFault
     */
    public function fetchCategorieIds()
    {
        $soapClient = new \SoapClient($this->urlWsdlSoapPhp, $this->options);
        return $soapClient->getCategorieIds();
    }

    public function fetchCategorie($idCategorie)
    {
        $soapClient = new \SoapClient($this->urlWsdlSoapPhp, $this->options);
        $categorie = new CategorieSoap($idCategorie, '', '');
        return $soapClient->getCategorieLibelle($categorie);
    }

}