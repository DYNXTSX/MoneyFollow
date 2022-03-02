<?php

class Note
{
    protected $note;
    protected $coef;
    protected $matiere_id;
    protected $eleve_id;

    public function __construct(float $note, float $coef, int $matiere_id, int $eleve_id) {
        $this->note = $note;
        $this->coef = $coef;
        $this->matiere_id = $matiere_id;
        $this->eleve_id = $eleve_id;
    }

    /**
     * @return float
     */
    public function getCoef(): float
    {
        return $this->coef;
    }

    /**
     * @return float
     */
    public function getNote(): float
    {
        return $this->note;
    }

    /**
     * @return int
     */
    public function getEleveId(): int
    {
        return $this->eleve_id;
    }

    /**
     * @return int
     */
    public function getMatiereId(): int
    {
        return $this->matiere_id;
    }

}