<?php
// ============================================================
// PAGES/ADMIN-NEWS.PHP — CRUD Articles
// ============================================================
// Accessible aux admins uniquement (vérifié dans index.php).
// $pdo disponible via index.php — pas de require ici.
//
// CRUD :
//   Create → actions/traitement-news.php (action=ajouter)
//   Read   → SELECT ici
//   Update → actions/traitement-news.php (action=modifier)
//   Delete → actions/traitement-news.php (action=supprimer)
//
// PRG pattern : chaque action POST redirige vers GET
// → évite la double soumission au refresh.
// ============================================================

// Messages flash — définis en tableau, une donnée = un endroit
$messages = [
    'ajoute'   => ['ok',  'Article ajouté.'],
    'modifie'  => ['ok',  'Modification enregistrée.'],
    'supprime' => ['ok',  'Article supprimé.'],
    'erreur'   => ['err', 'Champs manquants. Réessaie.'],
];

if (isset($_GET['msg'], $messages[$_GET['msg']])):
    [$type, $texte] = $messages[$_GET['msg']];
?>
    <div class="msg-<?= $type === 'ok' ? 'ok' : 'err' ?>"><?= e($texte) ?></div>
<?php endif; ?>

<?php
// ID de l'article en cours d'édition — null = aucun
$id_edition = $_POST['montrer_modifier'] ?? null;

// $themes_valides chargé via config/contenu.php → index.php
// Une seule source de vérité pour la liste des thèmes
$themes_dispo = array_combine(
    $themes_valides,
    array_map('ucfirst', $themes_valides)
);
?>

<h1><?= e($t['nav_admin_articles']) ?></h1>

<?php if (!$id_edition): ?>
<!-- ── AJOUT ─────────────────────────────────────────────── -->
<h2>Ajouter</h2>

<form action="actions/traitement-news.php" method="post">
    <input type="hidden" name="action" value="ajouter">

    <label for="titre">Titre</label>
    <input type="text" name="titre" id="titre" required>

    <label for="contenu">Contenu</label>
    <textarea name="contenu" id="contenu" required></textarea>

    <label for="theme">Thème</label>
    <select name="theme" id="theme">
        <?php foreach ($themes_dispo as $val => $label): ?>
            <option value="<?= e($val) ?>"><?= e($label) ?></option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Ajouter">
</form>

<?php else: ?>
<!-- ── MODIFIER ───────────────────────────────────────────── -->
<h2>Modifier</h2>

<?php
// Récupère l'article en cours d'édition pour pré-remplir le formulaire
$art = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
$art->execute([$id_edition]);
$a_edit = $art->fetch();
?>

<?php if ($a_edit): ?>
<form action="actions/traitement-news.php" method="post" class="form-edition">
    <input type="hidden" name="action" value="modifier">
    <input type="hidden" name="id"     value="<?= e($a_edit['id']) ?>">

    <label>Titre</label>
    <input type="text" name="titre"
           value="<?= e($a_edit['titre']) ?>" required>

    <label>Contenu</label>
    <!--
        htmlspecialchars() dans textarea : entre les balises,
        pas dans value= — le textarea n'a pas d'attribut value
    -->
    <textarea name="contenu" required><?= e($a_edit['contenu']) ?></textarea>

    <label>Thème</label>
    <select name="theme">
        <?php foreach ($themes_dispo as $val => $label): ?>
            <option value="<?= e($val) ?>"
                <?= $a_edit['theme'] === $val ? 'selected' : '' ?>>
                <?= e($label) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Enregistrer">
    <a href="?page=admin-news" class="lien-annuler">Annuler</a>
</form>
<?php endif; ?>

<?php endif; ?>

<!-- ── LISTE ─────────────────────────────────────────────── -->
<h2>Liste</h2>

<?php
$articles = $pdo->query('SELECT * FROM articles ORDER BY cree_le DESC')->fetchAll();

if (!$articles): ?>
    <p class="vide">Aucun article pour le moment.</p>

<?php else: ?>
    <?php foreach ($articles as $a): ?>
        <div class="admin-ligne">
            <span>
                <?= e($a['titre']) ?>
                <span class="tag-theme">[<?= e($a['theme']) ?>]</span>
            </span>
            <div class="btns">
                <form action="actions/traitement-news.php" method="post">
                    <input type="hidden" name="action" value="supprimer">
                    <input type="hidden" name="id"     value="<?= e($a['id']) ?>">
                    <button type="submit" class="btn-sup"
                            onclick="return confirm('Supprimer cet article ?')">
                        Supprimer
                    </button>
                </form>

                <form action="?page=admin-news" method="post">
                    <input type="hidden" name="montrer_modifier" value="<?= e($a['id']) ?>">
                    <button type="submit" class="btn-mod">Modifier</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>