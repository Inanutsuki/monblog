<?php 
class Manager
{

    protected function dbConnect()
    {
        global $bdd;
        if (empty($bdd)) {
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $bdd;
    }

}
?>