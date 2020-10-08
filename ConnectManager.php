<?php
require_once 'Manager.php';
class ConnectManager extends Manager
{
    public function connexion($pseudo)
    {
        $bdd = $this->dbConnect();
        

        $req = $bdd->prepare('SELECT id, pseudo, mot_de_passe, mail FROM membres WHERE pseudo = :pseudo');
        $req->execute(array(
            'pseudo' => $pseudo
        ));

        $resultat = $req->fetch();

        return $resultat;
    }
}
