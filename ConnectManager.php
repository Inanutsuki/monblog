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
        if ($resultat) {
            return $resultat;
        } else {
            return false;
        }
    }
    public function passworChecked($pseudo, $password)
    {
        $infosUser = $this->connexion($pseudo);
        if ($infosUser) {
            $resultPassword = $infosUser['mot_de_passe'];
            $isPasswordCorrect = password_verify($password, $resultPassword);
            if ($isPasswordCorrect) {
                return true;
            }
        } else {
            return false;
        }
    }
}