<?php
class VisiteurControl
{

    function __construct()
    {

        /**
         *
         * Le visiteur désigne une personne non connecté
         * Ses actions sont très réduite
         *
         */

        global $vues;
        try{
            $action = $_REQUEST['action'] ?? NULL;
            switch ($action) {
                case NULL:
                    $this->casNull();
                    break;

                case "app" : //page principale
                    $this->app();
                    break;

                default:
                    $this->casDefault();
                    break;
            }
        }catch (PDOException $e)
        {
            $codeErreur = $e;
            require_once($vues['Erreur']);
        }
        catch (Exception $e2)
        {
            $codeErreur = $e2;
            require ($vues['Erreur']);
        }
    }

    /**
     * casNull() :
     *
     * Ce cas désigne le fait qu'il n'y a pas d'action de la part du visiteur
     * Ainsi, nous le redirigons vers la page de login
     */
    function casNull() {
        global $vues;
        $_SESSION['erreur'] = "";
        require_once($vues['Accueil']);
    }

    /**
     * casDefault() :
     *
     * Ce cas désigne l'action par défault (quand elle ne correspond à rien).
     * Ici, un visiteur est redirigé sur la page d'erreur
     */
    function casDefault() {
        global $vues;
        $_SESSION['erreur'] = "Cet URL ne semble pas exister ! ";
        require_once($vues['Erreur']);
    }

    function app() {
        global $vues;
        $_SESSION['erreur'] = "";
        require_once($vues['Accueil']);
    }

}