<?php

class Etudiant
{
    protected $id_etu;
    protected $nom;
    protected $prenom;
    protected $code;

    public function __construct(int $id_etu, string $nom, string $prenom, int $code) {
        $this->id_etu=$id_etu;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->code = $code;
    }

    public function getNomComplet(): string {
        $nc = $this->nom." ".$this->prenom;
        return ($nc);
    }

    public function getIdEtu(): int
    {
        return $this->id_etu;
    }

    /**
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->prenom;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }
}