<?php

class Matiere
{
    protected $id_mat;
    protected $nom;
    protected $coef;
    protected $id_ue;
    protected $code;

    public function __construct(int $id_mat, string $nom, float $coef, int $id_ue, int $code) {
        $this->id_mat = $id_mat;
        $this->nom = $nom;
        $this->coef = $coef;
        $this->id_ue = $id_ue;
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return float
     */
    public function getCoef(): float
    {
        return $this->coef;
    }

    /**
     * @return int
     */
    public function getIdMat(): int
    {
        return $this->id_mat;
    }

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @return int
     */
    public function getIdUe(): int
    {
        return $this->id_ue;
    }
}