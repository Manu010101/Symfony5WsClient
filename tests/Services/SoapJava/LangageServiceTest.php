<?php

namespace App\Tests\Services\SoapJava;

use App\Services\SoapJava\LangageService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LangageServiceTest extends KernelTestCase
{

    private static $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE
    );

    private static $urlWsdlSoapPhp = 'http://localhost:9090/LangageWS?wsdl';
    private static $soapClient;
    private static $langageService;

    public static function setUpBeforeClass(): void
    {
        self::bootKernel();
        $container = static::getContainer();
        self::$langageService = $container->get(LangageService::class);
        self::$soapClient = new \SoapClient(self::$urlWsdlSoapPhp, self::$options);
    }

    public function testGetLangageReturnHasCorrectAttributes()
    {
        $id = self::$langageService->fetchLangageIds()[0];
        $param = new \stdClass();
        $param->id = $id;
        $reponse = self::$soapClient
            ->__soapcall("getLangage", array($param))
            ->return;

        $this->assertObjectHasAttribute("id", $reponse);
        $this->assertObjectHasAttribute("nom", $reponse);
        $this->assertObjectHasAttribute("caracteristiques", $reponse);

    }
}
