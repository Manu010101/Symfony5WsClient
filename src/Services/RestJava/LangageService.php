<?php

namespace App\Services\RestJava;

use Symfony\Component\HttpClient\HttpClient;

class LangageService
{
    public $baseUrl = "http://localhost:8081/JavaWS_war_exploded/api/langage/";

    public function getLangage($id)
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl . $id
        );
        return $reponse->toArray();
    }

    public function getLangages()
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl . "all"
        );
        return $reponse->toArray();
    }

    public function deleteLangage($id)
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl . "delete/" . $id
        );
    }

    public function createLangage($nom, $caracteristiques)
    {
        $client = HttpClient::create();
        $reponse = $client->request('POST', $this->baseUrl . "create", [
            'headers' => [
                'Content-Type' => ['application/x-www-form-urlencoded'],
                'Accept' => 'application/json'
            ],
            'body' => [
                'nom' => $nom,
                'caracteristiques' => $caracteristiques
            ]
        ]);
        return $reponse->toArray();
    }
}