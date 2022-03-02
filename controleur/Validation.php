<?php
class Validation
{
    /**
     * Nettoyer_string() :
     *
     * Permet de nétoyer une chaine de caractère, empechant les failles XSS
     */
    static function Nettoyer_string($string){
        return filter_var($string,FILTER_SANITIZE_STRING);
    }

    static function Quotes_string($string){
        return htmlspecialchars($string, ENT_QUOTES);
    }

    static function Null_Or_Not_Null($string){
        if($string === null){
            return null;
        }
        return $string;
    }

    static function DescSort($item1,$item2)
    {
        if ($item1['note'] == $item2['note']) return 0;
        return ($item1['note'] < $item2['note']) ? 1 : -1;
    }

    static function GetAllNotes($codeUser, $codeMatiere, $key){
        $urlBase = "https://esaip.alcuin.com/OPDotNet/ePlug/FPC/Process/Annuaire/Parcours/pDetailEvaluations.aspx?idProcessDip=-1&idProcessPer=31294&idProcess=$codeMatiere&idUser=$codeUser&idIns=440107&typeRef=module";

        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Content-Type: text/xml\r\n".
                    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Safari/537.36\r\n".
                    "Accept: */*\r\n".
                    "Sec-GPC: 1\r\n".
                    "Sec-Fetch-Site: none\r\n".
                    "Sec-Fetch-Mode: cors\r\n".
                    "Sec-Fetch-Dest: empty\r\n".
                    "Accept-Encoding: gzip, deflate, br\r\n".
                    "Accept-Language: fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7\r\n".
                    $key,

            ]
        ];

        $context = stream_context_create($opts);
        $html = file_get_contents($urlBase, false, $context);
        $body = strip_tags($html, ['td', 'tr', 'table']);

        //getNotes
        preg_match_all('/(5px;">)([0-9]*\,?[0-9]*)(<\/td>)/',
            $body,
            $out, PREG_PATTERN_ORDER);

        return $out;
    }

    static function MajAllNotes($key){
        $etudiants = new EtudiantModele();
        $matieres = new MatiereModele();
        $notes = new NoteModele();

        $notes->removeAllNotes();

        $Liste_Etudiants = $etudiants->getAllEtudiants();
        $Liste_Matieres = $matieres->getAllMatieresDispo();
        foreach ($Liste_Matieres as $m){
            foreach ($Liste_Etudiants as $e){
                $out = Validation::GetAllNotes($e->getCode(), $m->getCode(), $key);

                if (array_key_exists(1, $out[2]))
                    for ($i=0; $i < count($out[2]); $i+=2) {
                        $coef = floatval(str_replace(',', '.', str_replace('.', '', $out[2][$i])));
                        $note = floatval(str_replace(',', '.', str_replace('.', '', $out[2][$i+1])));

                        $note = new Note(
                            $note,
                            $coef,
                            $m->getIdMat(),
                            $e->getIdEtu()
                        );
                        $notes->addNote($note);
                    }
                else{
                    $note = new Note(
                        0,
                        0,
                        $m->getIdMat(),
                        $e->getIdEtu()
                    );
                    $notes->addNote($note);
                }
            }
        }
    }

    /**
     * Nettoyer_int() :
     *
     * Permet de nétoyer un entier, empechant les failles XSS
     */
    static function Nettoyer_int($string){
        return filter_var($string,FILTER_SANITIZE_NUMBER_INT);
    }

    /**
     * prepSession() :
     *
     * Ceci définie la session de base.
     * Avec le role Visiteur et aucun Login.
     */
    static function prepSession(){
        if(session_status() == PHP_SESSION_NONE) {
            session_start();

            if(!isset($_SESSION['role']))
            {
                $_SESSION['role']="Visiteur";
            }

            if(!isset($_SESSION['login']))
            {
                $_SESSION['login']="";
            }
        }
    }

    /**
     * dateToFrench() :
     *
     * Cette méthode permet de retourner une date dans un format donné
     * Le tout en Français.
     */
    static function dateToFrench($date, $format)
    {
        $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
        $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
        $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
        return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date) ) ) );
    }
}