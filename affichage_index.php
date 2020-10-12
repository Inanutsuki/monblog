<?php
$title = 'Mon Blog';

$postManager->paginator($nbPage);

foreach ($data['articles'] as $article) {
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
?>