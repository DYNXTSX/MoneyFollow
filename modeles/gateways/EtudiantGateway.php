<?php

class EtudiantGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function getAllEtudiants(){
        $contacts = $this->con->simpleQueryRetourTableau("SELECT * FROM eleves ORDER BY nom ASC");
        return $contacts;
    }

}