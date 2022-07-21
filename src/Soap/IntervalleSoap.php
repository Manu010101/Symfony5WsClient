<?php

namespace App\Soap;

class IntervalleSoap
{
    /**
     * @var string
     */
    public $debut;

    /**
     * @var string
     */
    public $fin;

    /**
     * @param string $debut
     * @param string $fin
     */
    public function __construct($debut, $fin)
    {
        $this->debut = $debut;
        $this->fin = $fin;
    }

    /**
     * @return string
     */
    public function getDebut(): string
    {
        return $this->debut;
    }

    /**
     * @param string $debut
     */
    public function setDebut(string $debut): void
    {
        $this->debut = $debut;
    }

    /**
     * @return string
     */
    public function getFin(): string
    {
        return $this->fin;
    }

    /**
     * @param string $fin
     */
    public function setFin(string $fin): void
    {
        $this->fin = $fin;
    }


}