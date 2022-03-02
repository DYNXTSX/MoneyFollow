<?php

class NoteGateway
{
    private $con;

    public function __construct(Connection $con)
    {
        $this->con = $con;
    }

    public function addNote($note){
        $insertion = $this->con->query('INSERT INTO note VALUES ('.$note->getNote().','.$note->getCoef().','.$note->getMatiereId().','.$note->getEleveId().')');
    }

    public function removeAllNotes(){
        $insertion = $this->con->query('DELETE FROM `note` WHERE note IS NOT NULL');
    }

    public function getAllNotesForUser($id_user){
        $notes = $this->con->simpleQueryRetourTableau("SELECT * FROM note WHERE eleve_id = ".$id_user);
        return $notes;
    }

    public function getAllNotesForUserWithMat($id_user, $id_mat){
        $notes = $this->con->simpleQueryRetourTableau("SELECT * FROM note WHERE eleve_id = ".$id_user." AND matiere_id = ".$id_mat);
        return $notes;
    }

}