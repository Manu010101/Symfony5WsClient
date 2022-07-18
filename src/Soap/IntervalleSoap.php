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
}