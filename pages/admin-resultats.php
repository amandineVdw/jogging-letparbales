<?php
// ============================================================
// PAGES/ADMIN-RESULTATS.PHP — CRUD Coureurs
// ============================================================
// Accessible aux admins ET organisateurs (vérifié dans index.php).
// $pdo disponible via index.php — pas de require ici.
//
// Même pattern que admin-news.php :
// PRG + messages flash + formulaire d'édition inline.
// ============================================================

$messages = [
    'ajoute'   => ['ok',  'Résultat ajouté.'],
    'modifie'  => ['ok',  'Modification enregistrée.'],
    'supprime' => ['ok',  'Résultat supprimé.'],
    'erreur'   => ['err', 'Champs manquants. Réessaie.'],
];

if (isset($_GET['msg'], $messages[$_GET['msg']])):
    [$type, $texte] = $messages[$_GET['msg']];
?>
    <div class="msg-<?= $type === 'ok' ? 'ok' : 'err' ?>"><?= e($texte) ?></div>
<?php endif; ?>

<?php $id_edition = $_POST['montrer_modifier'] ?? null; ?>

<h1><?= e($t['nav_admin_coureurs']) ?></h1>

<?php if (!$id_edition): ?>
<!-- ── AJOUT ─────────────────────────────────────────────── -->
<h2>Ajouter</h2>

<form action="actions/traitement-resultats.php" method="post">
    <input type="hidden" name="action" value="ajouter">

    <label for="nom">Nom</label>
    <input type="text" name="nom" id="nom" required>

    <label for="prenom">Prénom</label>
    <input type="text" name="prenom" id="prenom" required>

    <!--
        type="time" step="1" = champ heure:minute:seconde
        Correspond au format TIME de MySQL (HH:MM:SS)
    -->
    <label for="temps">Temps (hh:mm:ss)</label>
    <input type="time" name="temps" id="temps" step="1" required>

    <label>Sexe</label>
    <div class="radio-group">
        <label><input type="radio" name="sexe" value="F" required> F</label>
        <label><input type="radio" name="sexe" value="M"> M</label>
    </div>

    <input type="submit" value="Ajouter">
</form>

<?php else: ?>
<!-- ── MODIFIER ───────────────────────────────────────────── -->
<h2>Modifier</h2>

<?php
// Récupère le coureur en cours d'édition pour pré-remplir le formulaire
$cour = $pdo->prepare('SELECT * FROM coureurs WHERE id = ?');
$cour->execute([$id_edition]);
$c_edit = $cour->fetch();
?>

<?php if ($c_edit): ?>
<form action="actions/traitement-resultats.php" method="post" class="form-edition">
    <input type="hidden" name="action" value="modifier">
    <input type="hidden" name="id"     value="<?= e($c_edit['id']) ?>">

    <label>Nom</label>
    <input type="text" name="nom"
           value="<?= e($c_edit['nom']) ?>" required>

    <label>Prénom</label>
    <input type="text" name="prenom"
           value="<?= e($c_edit['prenom']) ?>" required>

    <label>Temps</label>
    <input type="time" name="temps"
           value="<?= e($c_edit['temps']) ?>" step="1" required>

    <label>Sexe</label>
    <div class="radio-group">
        <label>
            <input type="radio" name="sexe" value="F"
                <?= $c_edit['sexe'] === 'F' ? 'checked' : '' ?>> F
        </label>
        <label>
            <input type="radio" name="sexe" value="M"
                <?= $c_edit['sexe'] === 'M' ? 'checked' : '' ?>> M
        </label>
    </div>

    <input type="submit" value="Enregistrer">
    <a href="?page=admin-resultats" class="lien-annuler">Annuler</a>
</form>
<?php endif; ?>

<?php endif; ?>

<!-- ── LISTE ─────────────────────────────────────────────── -->
<h2>Liste</h2>

<?php
$coureurs = $pdo->query('SELECT * FROM coureurs ORDER BY temps ASC')->fetchAll();

if (!$coureurs): ?>
    <p class="vide">Aucun résultat enregistré.</p>

<?php else: ?>
    <?php foreach ($coureurs as $c): ?>
        <div class="admin-ligne">
            <span>
                <?= e($c['nom']) ?> <?= e($c['prenom']) ?>
                <span class="tag-theme"><?= e($c['temps']) ?> — <?= e($c['sexe']) ?></span>
            </span>
            <div class="btns">
                <form action="actions/traitement-resultats.php" method="post">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="id"     value="<?= e($c['id']) ?>">
                    <button type="submit" class="btn-sup"
                            onclick="return confirm('Supprimer ce résultat ?')">
                        Supprimer
                    </button>
                </form>

                <form action="?page=admin-resultats" method="post">
                    <input type="hidden" name="montrer_modifier" value="<?= e($c['id']) ?>">
                    <button type="submit" class="btn-mod">Modifier</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>