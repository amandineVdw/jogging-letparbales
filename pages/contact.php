<?php
// ============================================================
// PAGES/CONTACT.PHP — Page statique
// ============================================================
// Pas de BDD — données fixes + textes depuis $textes[$theme].
// $t['contact_note'] est optionnel — vide pour officiel,
// présent pour dark et rocky (ton humoristique).
//
// loading="lazy" sur l'iframe — performance :
// la carte se charge uniquement quand elle entre dans le viewport.
// title sur l'iframe — accessibilité WCAG AA obligatoire.
// ============================================================
?>

<h1><?= e($t['contact_titre']) ?></h1>
<p class="sous-titre"><?= e($t['contact_intro']) ?></p>

<div class="contact-bloc">

    <div class="contact-info">

        <?php if (!empty($t['contact_image'])): ?>
            <img src="<?= e($t['contact_image']) ?>"
                 alt="Gilles LETPARBALLES"
                 class="contact-portrait">
        <?php endif; ?>

        <strong>Gilles LETPARBALLES</strong><br>
        Joggeur indépendant<br>
        Rue des mollets n°8<br>
        1300 Wavre

        <?php if (!empty($t['contact_note'])): ?>
            <p class="contact-note"><?= e($t['contact_note']) ?></p>
        <?php endif; ?>
    </div>

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2526.0!2d4.6!3d50.71!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c17c6b7c5e5555%3A0x0!2sWavre!5e0!3m2!1sfr!2sbe!4v1"
        width="420"
        height="240"
        allowfullscreen=""
        loading="eager"
        title="Localisation Gilles LETPARBALLES — Wavre">
    </iframe>

</div>