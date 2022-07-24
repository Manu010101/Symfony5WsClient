<?php

namespace App\Services\SoapJava;

class LangageService
{
    private $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE
    );

    private $soapClient;

    public function __construct()
    {
        $this->soapClient = new \SoapClient('http://localhost:9090/LangageWS?wsdl', $this->options);
    }


    public function fetchLangage($id)
    {
        $param = new \stdClass();
        $param->id = $id;
        return $this->soapClient->__soapCall("getLangage", array($param))->return;
    }

    public function fetchLangageIds()
    {
        return $this->soapClient->__soapCall("getLangageIds", array())->return;
    }

    public function fetchLangages()
    {
        return $this->soapClient->__soapCall("getLangages", [])->return;
    }
}