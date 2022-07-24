<?php

namespace App\Tests\Services\SoapPhp;

use App\Services\RestJava\LangageService;
use App\Services\SoapPhp\CategorieService;
use App\Soap\CategorieSoap;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CategorieServiceTest extends KernelTestCase
{

    private static $options = array(
        'trace' => 1,
        'exceptions' => 1,
        'connection_timeout' => 180,
        'encoding' => 'UTF-8',
        'soap_version' => SOAP_1_1,
        'cache_wsdl' => WSDL_CACHE_NONE
    );

    private static $urlWsdlSoapPhp = 'http://localhost:8000/soap?wsdl';
    private static $soapClient;
    private static $categorieService;

    public static function setUpBeforeClass(): void
    {
        //récupération du service -procédure spéciale pour les tests
        self::bootKernel();
        $container = static::getContainer();
        self::$categorieService = $container->get(CategorieService::class);
        self::$soapClient = new \SoapClient(self::$urlWsdlSoapPhp, self::$options);
    }

    public function testgetCategorieReturnHasCorrectAttributes()
    {
        $categorie = new CategorieSoap(1, '', '');
        $reponse = self::$soapClient->getCategorieLibelle($categorie);


        $this->assertObjectHasAttribute("id", $reponse);
        $this->assertObjectHasAttribute("libelle", $reponse);
        $this->assertObjectHasAttribute("texte", $reponse);

    }
}
