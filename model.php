<?php 
function getArticles(&$articles){
try {
        $bdd = new PDO('mysql:host=localhost;dbname=monblog;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $nbBillets = $bdd->query('SELECT COUNT(*) AS nb_billet FROM billets');
    $responsCount = $nbBillets->fetch();
    $limitArticle = 5;
    $totalArticle = $responsCount['nb_billet'];
    $getPage = (isset($_GET['page']) ? ($_GET['page'])-1 : 1);
    $numPage = $limitArticle * $getPage;
    $nbPage = ceil($totalArticle / $limitArticle);
    $respons = $bdd->query('SELECT id, titre, contenu, date_creation FROM billets ORDER BY ID LIMIT ' . $limitArticle . ' OFFSET ' . $numPage);

    $articles = $respons->fetchAll();

    return $nbPage;
}