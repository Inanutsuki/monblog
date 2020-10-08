<?php
require_once 'Manager.php';
class CommentManager extends Manager
{
    public function getComments($id_billet)
    {
        $bdd = $this->dbConnect();
        $comments = $bdd->prepare('SELECT id, auteur, commentaire, date_commentaire FROM commentaires WHERE id_billet = ? ORDER BY ID DESC LIMIT 0,10');
        $comments->execute(array($id_billet));
        return $comments;
    }
    public function insertComment($author, $comment, $id_billet)
    {
        $bdd = $this->dbConnect();
        
        
        $req = $bdd->prepare('INSERT INTO commentaires( id, id_billet, auteur, commentaire, date_commentaire) VALUES(NULL, :id_billet, :auteur, :commentaire, now())');
        $req->execute(array(
            'id_billet' => $id_billet,
            'auteur' => $author,
            'commentaire' => $comment,
        ));
        header('Location: commentaires.php?id=' . $id_billet . '');
    }

    public function getCommentInfos($idComment)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT * FROM commentaires WHERE id = :thiscomment');
        $req->execute(array(
            'thiscomment' => $idComment
        ));
        $thisCommentInfos = $req->fetch();
        return $thisCommentInfos;
    }

    public function updateComment($idcomment, $updatedComment, $id_billet)
    {
        $bdd = $this->dbConnect();
        if(!empty($_SESSION['pseudo'])){
        $req = $bdd->prepare('UPDATE commentaires SET commentaire =" '. $updatedComment . '",date_commentaire = "'. $idcomment['date_commentaire'].'", date_modification = now() WHERE id = :this_id_comment');
        $req->execute(array(
            'this_id_comment' => $idcomment['id']
        ));

        }else{
            throw new Exception('Vous devez être connecté pour modifier votre commentaire.');
        }
        
        header('Location: index.php?action=post&id='.$id_billet.'');
    }
}
