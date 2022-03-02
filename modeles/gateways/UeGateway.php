<?php

class UeGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function getAllUe(){
        $ue = $this->con->simpleQueryRetourTableau('SELECT DISTINCT ue.id, ue.nom, ue.coef, ue.semestre FROM ue, matieres WHERE ue.id = matieres.ue_id AND matieres.code != 0');
        return $ue;
    }
}