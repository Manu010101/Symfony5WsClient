<?php

namespace App\Services\SoapPhp;



use App\Soap\IntervalleSoap;

class CommandeService
{
    private $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE);

    private $urlWsdlSoapPhp = 'http://localhost:8000/soap?wsdl';

    public function fetchCommandes($debut, $fin){
        $intervalle = new IntervalleSoap($debut, $fin);
        $soapClient = new \SoapClient($this->urlWsdlSoapPhp, $this->options);
        return $soapClient->getCommandesByIntervalle($intervalle);
    }

}