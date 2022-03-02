<?php

class MatiereGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function getAllMatieresDispo(){
        $contacts = $this->con->simpleQueryRetourTableau("SELECT * FROM matieres WHERE code != 0 ORDER BY id ASC");
        return $contacts;
    }

    public function getMatieresByUe($id_ue){
        $contacts = $this->con->simpleQueryRetourTableau("SELECT * FROM matieres WHERE code != 0 AND ue_id = ".$id_ue." ORDER BY id ASC");
        return $contacts;
    }
}