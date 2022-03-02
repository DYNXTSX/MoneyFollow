<?php

class NoteModele
{
    public function addNote($note)
    {
        global $con;
        $gtwNote = new NoteGateway($con);
        $gtwNote->addNote($note);
    }

    public function removeAllNotes()
    {
        global $con;
        $gtwNote = new NoteGateway($con);
        $gtwNote->removeAllNotes();
    }

    public function getAllNotesForUser($id_user): array
    {
        global $con;
        $gtwNote = new NoteGateway($con);
        $Tab_de_notes = [];
        $notes = $gtwNote->getAllNotesForUser($id_user);

        while($donnee = mysqli_fetch_all($notes)){
            foreach ($donnee as $row){
                $note = new Note(
                    (float)$row[0],
                    (float)$row[1],
                    (int)$row[2],
                    (int)$row[3]);
                $Tab_de_notes[] = $note;
            }
        }
        return $Tab_de_notes;
    }

    public function getAllNotesForUserWithMat($id_user, $id_mat): array
    {
        global $con;
        $gtwNote = new NoteGateway($con);
        $Tab_de_notes = [];
        $notes = $gtwNote->getAllNotesForUserWithMat($id_user, $id_mat);

        while($donnee = mysqli_fetch_all($notes)){
            foreach ($donnee as $row){
                $note = new Note(
                    (float)$row[0],
                    (float)$row[1],
                    (int)$row[2],
                    (int)$row[3]);
                $Tab_de_notes[] = $note;
            }
        }
        return $Tab_de_notes;
    }

    public function getMoyenneForOneMat($id_user, $id_mat)
    {
        global $con;
        $gtwNote = new NoteGateway($con);
        $moyenneMat = 0;
        $noteTotal = 0;
        $coefTotal = 0;

        $notes = $this->getAllNotesForUserWithMat($id_user, $id_mat);
        foreach ($notes as $n){
            $noteTotal += ($n->getNote() * $n->getCoef());
            $coefTotal += $n->getCoef();
        }

        if($coefTotal != 0)
            $moyenneMat = $noteTotal / $coefTotal;
        return $moyenneMat;
    }

}