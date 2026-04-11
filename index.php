<?php
// ============================================================
// INDEX.PHP — Front Controller
// ============================================================
// PATTERN : Single Entry Point
// Ce fichier orchestre — il ne fait rien lui-même, il délègue.
//
// RESPONSABILITÉS (dans l'ordre) :
//   1. Auth guard     — pas connecté → login
//   2. Session        → variables locales
//   3. Contenu        → textes thématiques
//   4. Routeur        → page + vérification permission
//   5. Template       → HTML nav + container + footer
// ============================================================

session_start();

// ── Helpers ──────────────────────────────────────────────────
// Définis avant tout usage — disponibles dans les pages incluses

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function actif(string $p): string {
    return $GLOBALS['page'] === $p ? 'class="actif"' : '';
}

// ── 1. Session → variables locales ───────────────────────────
// Anonyme = participant officiel — le site est public par défaut
$connecte = isset($_SESSION['user']);
$theme    = $connecte ? $_SESSION['theme'] : 'officiel';
$role     = $connecte ? $_SESSION['role']  : 'participant';
$nom      = $connecte ? $_SESSION['nom']   : '';

// ── 2. Contenu thématique ────────────────────────────────────
require_once 'config/bdd.php';     // définit $pdo — disponible dans toutes les pages incluses
require_once 'config/contenu.php'; // définit $textes + $themes_valides
require_once 'config/logger.php';  // définit lpb_log()
$t = $textes[$theme];

// ── 3. Routeur ───────────────────────────────────────────────
// page → rôle minimum requis (null = tout le monde, connecté ou non)
$routes = [
    'accueil'         => null,
    'news'            => null,
    'resultats'       => null,
    'contact'         => null,
    'admin-resultats' => 'organisateur', // organisateur + admin
    'admin-news'      => 'admin',        // admin uniquement
];

// Hiérarchie des rôles — ordonné du plus haut au plus bas
// array_slice depuis la position du rôle courant =
// tous les rôles que cet utilisateur "couvre"
// ex : admin        → ['admin', 'organisateur', 'participant']
// ex : organisateur → ['organisateur', 'participant']
$hierarchie = ['admin', 'organisateur', 'participant'];
$pos        = array_search($role, $hierarchie);

// Guard : rôle inconnu en session → déconnexion immédiate
if ($pos === false) {
    lpb_log('ERROR', 'auth', 'Rôle corrompu en session — user=' . ($_SESSION['user'] ?? '?') . ', role=' . var_export($role, true));
    session_destroy();
    header('Location: index.php');
    exit();
}

$acces = array_slice($hierarchie, $pos);

$page = $_GET['page'] ?? 'accueil';

// Route inconnue → accueil
// Route protégée sans droits suffisants → login si anonyme, accueil si connecté
if (!array_key_exists($page, $routes)) {
    $page = 'accueil';
} elseif ($routes[$page] && !in_array($routes[$page], $acces)) {
    if (!$connecte) {
        header('Location: login.php');
        exit();
    }
    $page = 'accueil';
}

// ── Logos SVG inline par thème ───────────────────────────────
// Une donnée = un endroit.
// Pas de fichiers SVG externes — zéro dépendance non livrée.
$logos = [
    'officiel' => '
        <svg viewBox="0 0 60 60" fill="none" aria-hidden="true">
            <polygon points="30,4 54,17 54,43 30,56 6,43 6,17"
                     fill="#1e2a38" stroke="#e74c3c" stroke-width="2"/>
            <text x="30" y="26" text-anchor="middle"
                  font-family="Georgia,serif" font-size="14"
                  fill="#fff" font-weight="700">LPB</text>
            <line x1="14" y1="32" x2="46" y2="32"
                  stroke="#e74c3c" stroke-width="1"/>
            <text x="30" y="44" text-anchor="middle"
                  font-family="Georgia,serif" font-size="7"
                  fill="rgba(255,255,255,0.3)" letter-spacing="2">WAVRE</text>
        </svg>',
    'story' => '
        <svg viewBox="0 0 60 60" fill="none" aria-hidden="true">
            <rect width="60" height="60" fill="#000"/>
            <rect x="0" y="0" width="5" height="60" fill="#e74c3c"/>
            <text x="14" y="24" font-family="Courier New,monospace"
                  font-size="13" fill="#e74c3c" font-weight="700">LET</text>
            <text x="14" y="38" font-family="Courier New,monospace"
                  font-size="13" fill="#fff" font-weight="700">PAR</text>
            <text x="14" y="52" font-family="Courier New,monospace"
                  font-size="10" fill="#333">BALLES</text>
        </svg>',
    'rocky' => '
        <svg viewBox="0 0 60 60" fill="none" aria-hidden="true">
            <rect width="60" height="60" rx="2" fill="#f5c400"/>
            <text x="30" y="26" text-anchor="middle"
                  font-family="Arial Black,Arial,sans-serif"
                  font-size="18" fill="#000" font-weight="900">LPB</text>
            <line x1="8" y1="32" x2="52" y2="32"
                  stroke="#000" stroke-width="2"/>
            <path d="M8 40 L16 46 L30 40 L44 46 L52 40"
                  stroke="#000" stroke-width="1.5" fill="none"
                  stroke-linecap="round" stroke-linejoin="round"/>
        </svg>',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogging LETPARBALLES</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/tokens.css">
    <link rel="stylesheet" href="assets/css/base.css">
    <link rel="stylesheet" href="assets/css/theme-<?= e($theme) ?>.css">
    <link rel="stylesheet" href="assets/css/loader.css">
</head>
<body>

<?php require 'includes/loader.php'; ?>

<nav id="nav">

    <a href="index.php?page=accueil" class="nav-logo" aria-label="Accueil LETPARBALLES">
        <?= $logos[$theme] ?>
    </a>

    <div class="nav-liens" id="nav-liens">

        <a href="index.php?page=accueil"    <?= actif('accueil') ?>><?=    e($t['nav_accueil']) ?></a>
        <a href="index.php?page=news"       <?= actif('news') ?>><?=       e($t['nav_news']) ?></a>
        <a href="index.php?page=resultats"  <?= actif('resultats') ?>><?=  e($t['nav_resultats']) ?></a>
        <a href="index.php?page=contact"    <?= actif('contact') ?>><?=    e($t['nav_contact']) ?></a>

        <?php if ($role === 'admin'): ?>
            <span class="nav-sep" aria-hidden="true"></span>
            <a href="index.php?page=admin-news" <?= actif('admin-news') ?>>
                <?= e($t['nav_admin_articles']) ?>
            </a>
        <?php endif; ?>

        <?php if (in_array($role, ['admin', 'organisateur'])): ?>
            <?php if ($role !== 'admin'): ?>
                <span class="nav-sep" aria-hidden="true"></span>
            <?php endif; ?>
            <a href="index.php?page=admin-resultats" <?= actif('admin-resultats') ?>>
                <?= e($t['nav_admin_coureurs']) ?>
            </a>
        <?php endif; ?>

    </div>

    <div class="nav-user">
        <?php if ($connecte): ?>
            <?php if ($role !== 'admin'): ?>
                <span class="badge-role badge-<?= e($role) ?>"><?= e($role) ?></span>
            <?php endif; ?>
            <span class="nav-nom"><?= e($nom) ?></span>
            <a href="logout.php" class="nav-logout">Déconnexion</a>
        <?php else: ?>
            <a href="login.php" class="nav-logout">Se connecter</a>
        <?php endif; ?>
    </div>

    <button class="hamburger" id="hamburger"
            aria-label="Menu" aria-expanded="false">
        <span></span><span></span><span></span>
    </button>

</nav>

<main class="container">
    <?php require 'pages/' . $page . '.php'; ?>
</main>

<footer class="site-footer">
    Jogging de l'IFOSUP &copy; <?= date('Y') ?> — Wavre
</footer>

<script>
const cacherLoader = () => document.getElementById('loader').classList.add('hidden');
window.addEventListener('load', cacherLoader);
setTimeout(cacherLoader, 4000); // fallback : 4s max, même si une ressource externe ne répond pas

const nav       = document.getElementById('nav');
const hamburger = document.getElementById('hamburger');

hamburger.addEventListener('click', () => {
    const open = nav.classList.toggle('nav-ouverte');
    hamburger.setAttribute('aria-expanded', open);
});

nav.querySelectorAll('a').forEach(a =>
    a.addEventListener('click', () => {
        nav.classList.remove('nav-ouverte');
        hamburger.setAttribute('aria-expanded', false);
    })
);
</script>

</body>
</html>