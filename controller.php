<?php
class Controller
{

    public function listPosts()
    {
        $controllerManager = new ControllerManager();
        $postManager = new PostManager();
        $articles = [];
        $getPage = (isset($_GET['page']) ? ($_GET['page']) - 1 : 0);
        $nbPage = $postManager->getArticles($articles, $getPage);
        $posts = $postManager->getArticles($articles, $getPage);
        $pseudo = (empty($_SESSION['pseudo'])) ? '' : $_SESSION['pseudo'];
        $data = [
            'postManager' => $postManager,
            'articles' => $articles,
            'getPage' => $getPage,
            'nbPage' => $nbPage,
            'posts' => $posts,
            'pseudo' => $pseudo
        ];
        $controllerManager->render('affichage_index', $data);
    }

    public function post()
    {
        $controllerManager = new ControllerManager();
        $id_billet = $_GET['id'];
        $postManager = new PostManager();
        $commentManager = new CommentManager();
        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id']);

        $data = [
            'id_billet' => $id_billet,
            'postManager' => $postManager,
            'commentManager' => $commentManager,
            'post' => $post,
            'comments' => $comments
        ];
        $controllerManager->render('affichage_commentaire', $data);
    }

    public function startSession($id, $pseudo, $mail)
    {
        $_SESSION['id'] = $id;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['mail'] = $mail;
    }

    public function connect()
    {
        $errorMsg = "";
        $controllerManager = new ControllerManager();

        $data = [
            'errorMsg' => $errorMsg,
            'controllerManager' => $controllerManager
        ];
        if ($controllerManager->isPostMethod() == true) {
            $pseudo = $_POST['pseudo'];
            $connectManager = new ConnectManager();
            $resultat = $connectManager->connexion($pseudo);
            $password = $_POST['password'];
            $isPasswordCorrect = $connectManager->passworChecked($pseudo, $password);

            $data = [
                'pseudo' => $pseudo,
                'connectManager' => $connectManager,
                'resultat' => $resultat,
                'password' => $password,
                'isPasswordCorrect' => $isPasswordCorrect
            ];
            try {
                if ($resultat) {
                    if ($isPasswordCorrect == true) {
                        $_SESSION['id'] = $resultat['id'];
                        $_SESSION['pseudo'] = $resultat['pseudo'];
                        $_SESSION['mail'] = $resultat['mail'];
                        $this->startSession($resultat['id'], $resultat['pseudo'], $resultat['mail']);
                        header('Location: index.php?action=listPosts');
                    } else {
                        throw new Exception('Mauvais identifiant ou mot de passe');
                    }
                } else {
                    throw new Exception('Mauvais identifiant ou mot de passe');
                }
            } catch (Exception $err) {
                $errorMsg = $err->getMessage();
            }
        }
        $controllerManager->render('affichage_connexion', $data);
    }

    public function newInscription()
    {
        $inscriptionManager = new InscriptionManager();
        $errorMsg = "";
        $controllerManager = new ControllerManager();


        $data = [
            'errorMsg' => $errorMsg
        ];

        if ($controllerManager->isPostMethod() == true) {
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $password = $_POST['password'];
            $passwordCopy = htmlspecialchars($_POST['passwordCopy']);

            try {
                $subscribed = $inscriptionManager->inscription($pseudo, $mail, $password, $passwordCopy);

                if ($subscribed) {
                    header('Location: index.php');
                } else {
                    throw new Exception('Erreur lors de l\'inscription.', 500);
                }
            } catch (Exception $err) {
                $errorMsg = $err->getMessage();
            }
        }
        $controllerManager->render('affichage_inscription', $data);
    }

    public function addComment()
    {
        $id_billet = $_GET['id'];
        $comment = htmlspecialchars($_POST['text_commentaire']);
        $author = htmlspecialchars($_POST['auteur_commentaire']);
        $commentManager = new CommentManager();
        $commentManager->insertComment($author, $comment, $id_billet);
    }

    public function updateComments()
    {
        $id_billet = $_GET['id'];
        $commentManager = new CommentManager();
        $idcomment = $commentManager->getCommentInfos($_GET['thiscomment']);
        $controllerManager = new ControllerManager();

        $data = [
            'id_billet' => $id_billet,
            'commentManager' => $commentManager,
            'idcomment' => $idcomment,
            'controllerManager' => $controllerManager
        ];

        if ($controllerManager->isPostMethod() == true) {
            $updatedComment = htmlspecialchars($_POST['upadted_comment']);
            if (!empty($_POST['upadted_comment'])) {
                $commentManager = new CommentManager();
                $commentManager->updateComment($idcomment, $updatedComment, $id_billet);
            } else {
                throw new Exception('Vous n\'avez pas rempli le champ commentaire.');
            }
        }
        $controllerManager->render('update_comment', $data);
    }
}
