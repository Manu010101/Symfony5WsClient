<?php

namespace App\Tests\Services\RestJava;

use App\Services\RestJava\LangageService;
use phpDocumentor\Reflection\Types\Void_;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpClient\HttpClient;

class LangageServiceTest extends KernelTestCase
{


    public $baseUrl = "http://localhost:8081/JavaWS_war_exploded/api/langages";
    public static $langageService;

    public static function setUpBeforeClass(): void
    {
        //récupération du service -procédure spéciale pour les tests
        self::bootKernel();
        $container = static::getContainer();
        self::$langageService = $container->get(LangageService::class);
    }

    public function testCreateLangageReturn201AndObject()
    {
        //attributs du langage
        $data = array(
            "nom" => "test_nom",
            "caracteristiques" => "test_caracteristiques"
        );

        //envoi de la requête
        $client = HttpClient::create();
        $reponse = $client->request('POST', $this->baseUrl, [
            'headers' => [
                'Content-Type' => ['application/x-www-form-urlencoded'],
                'Accept' => 'application/json'
            ],
            'body' => $data
        ]);

        $langage = json_decode($reponse->getContent(), true);

        $this->assertEquals(
            201,
            $reponse->getStatusCode()
        );
        $this->assertIsArray($langage);
        $this->assertArrayHasKey('nom', $langage);
        $this->assertArrayHasKey('caracteristiques', $langage);
        $this->assertEquals(
            $data["nom"],
            $langage['nom']
        );
        $this->assertEquals(
            $data["caracteristiques"],
            $langage['caracteristiques']
        );

    }

    /**
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     */
    public function testGetLangageReturn200IfPresent()
    {

        $id = self::$langageService->getLangageIds()[0];

        if ($id !== null) {
            $client = HttpClient::create();
            $reponse = $client->request(
                'GET',
                $this->baseUrl . "/" . $id
            );

            $this->assertEquals(
                200,
                $reponse->getStatusCode()
            );
        }


    }

    public function testGetLangageRetrurn404IfNotPresent(){
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl . "/123456789"
        );

        $this->assertEquals(
            404,
            $reponse->getStatusCode()
        );
    }

    public function testDeleteLangageReturn404IfNotPresent()
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'DELETE',
            $this->baseUrl . "/1234"
        );

        $this->assertEquals(
            404,
            $reponse->getStatusCode()
        );
    }

    public function testDeleteLangageReturn200IfOk()
    {
        $id = self::$langageService->getLangageIds()[0];

        if ($id !== null){
            $client = HttpClient::create();
            $reponse = $client->request(
                'DELETE',
                $this->baseUrl . "/" . $id
            );

            $this->assertEquals(
                200,
                $reponse->getStatusCode()
            );
        }



    }
}
