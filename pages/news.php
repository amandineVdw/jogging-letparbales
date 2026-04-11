<?php
// ============================================================
// PAGES/NEWS.PHP — Articles filtrés par thème
// ============================================================
// Variables disponibles via index.php :
//   $t     → textes du thème actif
//   $theme → filtre SQL — chaque thème voit ses articles
//
// nl2br() après htmlspecialchars() — ordre obligatoire :
//   1. htmlspecialchars() échappe les caractères dangereux
//   2. nl2br() convertit \n en <br> légitimes
//   Inverser l'ordre = nl2br() échappe ses propres <br>
// ============================================================

$req = $pdo->prepare('SELECT * FROM articles WHERE theme = ? ORDER BY cree_le DESC');
$req->execute([$theme]);
$articles = $req->fetchAll();
?>

<?php if (!empty($t['news_image'])): ?>
    <div class="hero-accueil">
        <img src="<?= e($t['news_image']) ?>"
             alt="News du Jogging de l'IFOSUP">
    </div>
<?php endif; ?>

<h1><?= e($t['news_titre']) ?></h1>
<p class="sous-titre"><?= e($t['news_intro']) ?></p>

<?php if (!$articles): ?>
    <p class="vide"><?= e($t['news_vide']) ?></p>

<?php else: ?>
    <?php foreach ($articles as $a): ?>
        <article class="news-item">
            <h3><?= e($a['titre']) ?></h3>
            <p><?= nl2br(e($a['contenu'])) ?></p>
            <?php if ($a['cree_le']): ?>
                <div class="news-date">
                    <?= date('d/m/Y', strtotime($a['cree_le'])) ?>
                </div>
            <?php endif; ?>
        </article>
    <?php endforeach; ?>
<?php endif; ?>