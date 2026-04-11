<?php
// ============================================================
// PAGES/RESULTATS.PHP — Classement de la course
// ============================================================
// Variables disponibles via index.php :
//   $t     → textes du thème actif
//   $theme → 'officiel' | 'dark' | 'rocky'
//   $pdo   → connexion PDO chargée par index.php
//
// Fonctionnalités :
//   - Filtre M / F / Tous via ?filtre= (GET)
//   - Podium top 3 (classes CSS pos-1/2/3)
//   - Note Olaf — définie dans $textes, jamais hardcodée
//   - fetchAll() + count() — rowCount() non fiable sur SELECT
// ============================================================

// Whitelist filtre — seules ces 3 valeurs sont acceptées
$filtre = $_GET['filtre'] ?? 'tous';
if (!in_array($filtre, ['tous', 'M', 'F'])) $filtre = 'tous';

if ($filtre === 'tous') {
    $req = $pdo->query('SELECT * FROM coureurs ORDER BY temps ASC');
} else {
    $req = $pdo->prepare('SELECT * FROM coureurs WHERE sexe = ? ORDER BY temps ASC');
    $req->execute([$filtre]);
}

$coureurs = $req->fetchAll();

// Podium — tableau indexé : position → [classe CSS, médaille]
// Évite le if/elseif répété dans la boucle
$podium = [
    1 => ['pos-1', '🥇'],
    2 => ['pos-2', '🥈'],
    3 => ['pos-3', '🥉'],
];
?>

<?php if (!empty($t['res_image'])): ?>
    <div class="hero-accueil">
        <img src="<?= e($t['res_image']) ?>"
             alt="Résultats du Jogging de l'IFOSUP">
    </div>
<?php endif; ?>

<h1><?= e($t['res_titre']) ?></h1>
<p class="sous-titre"><?= e($t['res_intro']) ?></p>

<div class="filtre-bloc">
    <?php
    $filtres = ['tous' => 'Tous', 'M' => 'Hommes', 'F' => 'Femmes'];
    foreach ($filtres as $val => $label):
    ?>
        <a href="?page=resultats&filtre=<?= e($val) ?>"
           class="btn-filtre <?= $filtre === $val ? 'actif' : '' ?>">
            <?= e($label) ?>
        </a>
    <?php endforeach; ?>
</div>

<?php if (!$coureurs): ?>
    <p class="vide"><?= e($t['res_vide']) ?></p>

<?php else: ?>
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Sexe</th>
                    <th>Temps</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($coureurs as $i => $c):
                $pos      = $i + 1;
                $classe   = $podium[$pos][0] ?? '';
                $medaille = $podium[$pos][1] ?? '';
            ?>
                <tr <?= $classe ? 'class="' . e($classe) . '"' : '' ?>>
                    <td>
                        <span class="badge-pos">
                            <?= $medaille ? $medaille . ' ' : '' ?><?= $pos ?>
                        </span>
                    </td>
                    <td><?= e($c['nom']) ?></td>
                    <td><?= e($c['prenom']) ?></td>
                    <td><?= e($c['sexe']) ?></td>
                    <td><?= e($c['temps']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php if (!empty($t['res_note']) && $filtre === 'tous'): ?>
    <p class="note-dernier"><?= e($t['res_note']) ?></p>
<?php endif; ?>