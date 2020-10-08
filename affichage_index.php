<?php
$title = 'Mon Blog';

ob_start();
function paginator(int &$nbPage)
{
    echo '<nav aria-label="Pagination"><ul class="pagination d-flex justify-content-center">';
    for ($i = 0; $i < $nbPage; $i++) {
        echo '<li class="page-item"><a class="page-link" href="index.php?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
    }
    echo '</ul></nav>';
};
paginator($nbPage);

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

paginator($nbPage);

$content = ob_get_clean();

require ('template.php');
?>