<?php
$title = 'Mon Blog';

ob_start();

$postManager->paginator($nbPage);

foreach ($articles as $article) {
?>
    <div class="container">
        <article>
            <h1><?= $article['titre'] ?></h1>
            <div class="date">Ecrit le : <?= $article['date_creation'] ?></div>
            <div class="content-box"><?= $article['contenu'] ?></div>
            <a href="index.php?action=post&id=<?= $article['id'] ?>">Commentaires</a>
    </div>
    </article>
<?php
}

$postManager->paginator($nbPage);

$content = ob_get_clean();

require ('template.php');
?>