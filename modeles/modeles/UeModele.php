<?php

class UeModele
{
    public function getAllUe(){
        global $con;
        $gtwMat = new UeGateway($con);
        $c = $gtwMat->getAllUe();

        $Tab_Ues = [];

        while ($donnee = mysqli_fetch_all($c)) {
            foreach ($donnee as $row) {
                $ue = new Ue(
                    $row[0],
                    ($row[1]),
                    ($row[2]),
                    ($row[3])
                );
                $Tab_Ues[] = $ue;
            }
        }
        return $Tab_Ues;
    }
}