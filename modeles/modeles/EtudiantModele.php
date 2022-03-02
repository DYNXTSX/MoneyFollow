<?php

class EtudiantModele
{
    public function getAllEtudiants(){
        global $con;
        $gtwLog = new EtudiantGateway($con);
        $c = $gtwLog->getAllEtudiants();

        $Tab_etudiants = [];

        while ($donnee = mysqli_fetch_all($c)) {
            foreach ($donnee as $row) {
                $etudiant = new Etudiant(
                    $row[0],
                    ($row[1]),
                    ($row[2]),
                    ($row[3])
                );
                $Tab_etudiants[] = $etudiant;
            }
        }
        return $Tab_etudiants;
    }
}