<?php

class MatiereModele
{
    public function getAllMatieresDispo(){
        global $con;
        $gtwMat = new MatiereGateway($con);
        $c = $gtwMat->getAllMatieresDispo();

        $Tab_Matieres = [];

        while ($donnee = mysqli_fetch_all($c)) {
            foreach ($donnee as $row) {
                $matiere = new Matiere(
                    $row[0],
                    ($row[1]),
                    ($row[2]),
                    ($row[3]),
                    ($row[4])
                );
                $Tab_Matieres[] = $matiere;
            }
        }
        return $Tab_Matieres;
    }

    public function getMatieresByUe($id_ue){
        global $con;
        $gtwMat = new MatiereGateway($con);
        $c = $gtwMat->getMatieresByUe($id_ue);

        $Tab_Matieres = [];

        while ($donnee = mysqli_fetch_all($c)) {
            foreach ($donnee as $row) {
                $matiere = new Matiere(
                    $row[0],
                    ($row[1]),
                    ($row[2]),
                    ($row[3]),
                    ($row[4])
                );
                $Tab_Matieres[] = $matiere;
            }
        }
        return $Tab_Matieres;
    }
}