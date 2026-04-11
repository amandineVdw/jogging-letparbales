<?php
// ============================================================
// PAGES/ACCUEIL.PHP — Page statique
// ============================================================
// Pas de BDD — contenu 100% depuis $textes[$theme].
// $t['accueil_p3'] et $t['accueil_sign'] sont optionnels —
// vides pour certains thèmes, présents pour d'autres.
// ============================================================
?>

<?php if (!empty($t['accueil_hero'])): ?>
    <div class="hero-accueil">
        <img src="<?= e($t['accueil_hero']) ?>"
             alt="Départ du Jogging de l'IFOSUP — Wavre">
    </div>
<?php endif; ?>

<h1><?= e($t['accueil_titre']) ?></h1>
<p class="sous-titre"><?= e($t['accueil_intro']) ?></p>

<p><?= e($t['accueil_p1']) ?></p>
<p><?= e($t['accueil_p2']) ?></p>

<?php if (!empty($t['accueil_p3'])): ?>
    <p><?= e($t['accueil_p3']) ?></p>
<?php endif; ?>

<?php if (!empty($t['accueil_sign'])): ?>
    <p class="signature"><?= e($t['accueil_sign']) ?></p>
<?php endif; ?>