<?php

class ue
{
    protected $id;
    protected $nom;
    protected $coef;
    protected $semestre;

    public function __construct(int $id, string $nom, float $coef, int $semestre) {
        $this->id = $id;
        $this->nom = $nom;
        $this->coef = $coef;
        $this->semestre = $semestre;
    }

    /**
     * @return float
     */
    public function getCoef(): float
    {
        return $this->coef;
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
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSemestre(): int
    {
        return $this->semestre;
    }
}