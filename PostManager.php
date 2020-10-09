<?php
require_once 'Manager.php';
class PostManager extends Manager
{
    public function getArticles(&$articles, $getPage)
    {
        $bdd = $this->dbConnect();
        $nbBillets = $bdd->query('SELECT COUNT(*) AS nb_billet FROM billets');
        $responsCount = $nbBillets->fetch();
        $limitArticle = 5;
        $totalArticle = $responsCount['nb_billet'];
        $numPage = $limitArticle * $getPage;
        $nbPage = ceil($totalArticle / $limitArticle);
        $respons = $bdd->prepare('SELECT id, titre, contenu, date_creation FROM billets ORDER BY ID LIMIT :limitArticle OFFSET :numPage');
   
        $respons->bindValue('limitArticle', $limitArticle, PDO::PARAM_INT);
        $respons->bindValue('numPage', $numPage, PDO::PARAM_INT);
        $respons->execute();

        $articles = $respons->fetchAll();

        return $nbPage;
    }
    public function getPost($id_billet)
    {
        $bdd = $this->dbConnect();
        $req = $bdd->prepare('SELECT titre, contenu, date_creation FROM billets WHERE id=' . $id_billet . '');
        $req->execute(array());
        $post = $req->fetch();
        return $post;
    }

    public function paginator(int &$nbPage)
    {
        echo '<nav aria-label="Pagination"><ul class="pagination d-flex justify-content-center">';
        for ($i = 0; $i < $nbPage; $i++) {
            echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
        }
        echo '</ul></nav>';
    }
}
