<?php

namespace App\Services\RestJava;

use Symfony\Component\HttpClient\HttpClient;

class LangageService
{
    public $baseUrl = "http://localhost:8081/JavaWS_war_exploded/api/langages";

    public function getLangage($id)
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl . " / " . $id
        );
        return $reponse->toArray();
    }

    public function getLangageWithIde($id)
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl . "/" . $id . "/ides"
        );
        return $reponse->toArray();
    }

    public function getLangages()
    {
        $client = HttpClient::create();
        $reponse = $client->request(
            'GET',
            $this->baseUrl
        );
        return $reponse->toArray();
    }

    public function deleteLangage($id)
    {
        $client = HttpClient::create();
        $client->request(
            'DELETE',
            $this->baseUrl . "/" . $id
        );
    }

    public function createLangage($nom, $caracteristiques)
    {
        $client = HttpClient::create();
        $reponse = $client->request('POST', $this->baseUrl, [
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