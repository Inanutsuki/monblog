<?php
require_once 'Manager.php';

class InscriptionManager extends Manager
{
    public function inscription($pseudo, $mail, $password, $passwordCopy)
    {

        $pass_hash = password_hash($password, PASSWORD_DEFAULT);

        [$donnees_pseudo, $donnees_mail, $pseudo, $mail, $bdd] = $this->check_inscription($pseudo, $mail);

        if (empty($donnees_pseudo['pseudo'])) {
            if (empty($donnees_mail['mail'])) {
                if ($password == $passwordCopy) {
                    $req = $bdd->prepare('INSERT INTO membres(pseudo, mot_de_passe, mail, date_inscription) VALUE(:pseudo, :mypassword, :mail, now())');
                    $req->execute(array(
                        'pseudo' =>  $pseudo,
                        'mypassword' =>  $pass_hash,
                        'mail' =>  $mail
                    ));
                    connect();
                    return true;
                } else {
                    throw new Exception('Vos mots de passe ne sont pas les mêmes.');;
                }
            } else {
                throw new Exception('Cette email existe déjà.');;
            }
        } else {
            throw new Exception('Ce pseudo existe déjà.');
        }

        return false;
    }

    private function check_inscription($pseudo, $mail)
    {
        $bdd = $this->dbConnect();

        $reponse_mail = $bdd->prepare('SELECT * FROM membres WHERE mail = :mail');
        $reponse_pseudo = $bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');

        $reponse_mail->execute(array(
            'mail' => $mail
        ));

        $reponse_pseudo->execute(array(
            'pseudo' => $pseudo
        ));

        $donnees_mail = $reponse_mail->fetch();
        $donnees_pseudo = $reponse_pseudo->fetch();

        return [$donnees_pseudo, $donnees_mail, $pseudo, $mail, $bdd];
    }
}
