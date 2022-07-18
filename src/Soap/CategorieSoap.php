<?php

namespace App\Soap;

class CategorieSoap
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $libelle;

    /**
     * @var string
     */
    public $texte;

    /**
     * @param int $id
     * @param string $libelle
     * @param string $texte
     */
    public function __construct( $id, $libelle,  $texte)
    {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->texte = $texte;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return string
     */
    public function getTexte(): string
    {
        return $this->texte;
    }

    /**
     * @param string $texte
     */
    public function setTexte(string $texte): void
    {
        $this->texte = $texte;
    }




}