<?php
// ============================================================
// LOGIN.PHP — Porte d'entrée
// ============================================================
// Pattern : POST → vérification → session → redirect.
// Standalone : pas de index.php, pas de tokens.css.
// ============================================================

session_start();

if (isset($_SESSION['user'])) { header('Location: index.php'); exit(); }

// ── Helpers ──────────────────────────────────────────────────

function e(string $s): string {
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

// ── Config ───────────────────────────────────────────────────

require_once __DIR__ . '/config/users.php';
require_once __DIR__ . '/config/logger.php';

// Métadonnées visuelles + mot de passe démo (affichage carte uniquement — pas auth)
$meta = [
    'gilles' => ['av'=>'GL', 'avBg'=>'#f5c400', 'avFg'=>'#000000', 'desc'=>'Gilet par balles. Fondateur.',     'pw_demo'=>'letparballes', 'photo'=>'assets/images/profil-photo/profil-image-gilles.png'],
    'olaf'   => ['av'=>'OH', 'avBg'=>'#1a1a1a', 'avFg'=>'#e74c3c', 'desc'=>'A une théorie. Sur tout.',         'pw_demo'=>'herme',    'photo'=>'assets/images/profil-photo/profil-image-olaf.png'],
    'bruno'  => ['av'=>'BZ', 'avBg'=>'#2563eb', 'avFg'=>'#ffffff', 'desc'=>'Premier. Encode les temps.',       'pw_demo'=>'zieuvair',    'photo'=>'assets/images/profil-photo/profil-image-bruno.png'],
];

// Cartes = fusion $users + $meta — une seule source de vérité
// pw_demo vient de $meta (plaintext pour le bouton démo), pas de $users (hash bcrypt)
$cartes = [];
foreach ($users as $id => $u) {
    $cartes[] = [
        'id'    => $id,
        'nom'   => $u['nom'],
        'role'  => $u['role'],
        'theme' => $u['theme'],
        ...$meta[$id],
    ];
}

// Textes UI + palette header par thème
// Même pattern que $textes dans le projet — cohérence totale
$themes = [
    'officiel' => [
        'head' => '#1e2a38', 'txt' => '#ffffff', 'sub' => 'rgba(255,255,255,0.4)',
        'll'   => 'Identifiant', 'lp' => 'Mot de passe',
        'btn'  => 'Se connecter →',
        'sep'  => 'Accès rapide',
        'foot' => 'letparballes.free.nf · ifosup · wavre · 2026',
    ],
    'story' => [
        'head' => '#000000', 'txt' => '#ffffff', 'sub' => 'rgba(255,255,255,0.2)',
        'll'   => 'Login', 'lp' => 'Password',
        'btn'  => 'Entrer. Ou pas.',
        'sep'  => '— ou —',
        'foot' => 'letparballes.free.nf · il fait ce qu\'il veut · 2026',
    ],
    'rocky' => [
        'head' => '#f5c400', 'txt' => '#000000', 'sub' => 'rgba(0,0,0,0.45)',
        'll'   => 'Identifiant', 'lp' => 'Mot de passe',
        'btn'  => 'Entrer dans l\'arène →',
        'sep'  => 'Choisir son camp',
        'foot' => 'tu peux encore reculer · letparballes · 2026',
    ],
];

$preview = isset($_GET['theme'], $themes[$_GET['theme']]) ? $_GET['theme'] : 'officiel';
$t       = $themes[$preview];

// ── Auth ─────────────────────────────────────────────────────

$erreur = '';

if (isset($_POST['login'])) {
    $id   = trim($_POST['username'] ?? '');
    $pass = $_POST['password'] ?? '';

    if (!isset($users[$id])) {
        lpb_log('WARN', 'login', 'Tentative échouée — utilisateur inconnu : ' . $id);
        $erreur = 'Identifiants incorrects.';
    } elseif (!password_verify($pass, $users[$id]['password'])) {
        lpb_log('WARN', 'login', 'Tentative échouée — mauvais mot de passe : ' . $id);
        $erreur = 'Identifiants incorrects.';
    } else {
        lpb_log('INFO', 'login', 'Connexion réussie — ' . $id . ' (' . $users[$id]['role'] . ')');
        $_SESSION['user']  = $id;
        $_SESSION['theme'] = $users[$id]['theme'];
        $_SESSION['role']  = $users[$id]['role'];
        $_SESSION['nom']   = $users[$id]['nom'];
        header('Location: index.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — Jogging LETPARBALLES</title>
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body class="theme-<?= e($preview) ?>">

<p class="site-label">letparballes.free.nf</p>

<a href="index.php" class="retour-accueil">← Retour à l'accueil</a>

<div class="login-card">

    <header class="login-head" style="background:<?= e($t['head']) ?>">
        <?php if ($preview === 'story'): ?>

            <p class="story-prompt">&gt;_ letparballes.free.nf — session non authentifiée</p>
            <h1 class="story-title">LET<span>PAR</span>BALLES<span class="cursor"></span></h1>
            <p class="story-sub" style="color:<?= e($t['sub']) ?>">// Un site sur le jogging. Parce que.</p>

        <?php elseif ($preview === 'rocky'): ?>

            <div class="rocky-stripe"></div>
            <p class="rocky-eyebrow" style="color:<?= e($t['sub']) ?>">Jogging de l'IFOSUP · Wavre</p>
            <h1 class="rocky-title" style="color:<?= e($t['txt']) ?>">LET<br>PAR<br>BALLES</h1>
            <p class="rocky-sub" style="color:<?= e($t['sub']) ?>">On court · On souffre · On revient</p>

        <?php else: ?>

            <div class="officiel-logo-row">
                <svg class="logo-lpb" viewBox="0 0 60 60" fill="none">
                    <polygon points="30,4 54,17 54,43 30,56 6,43 6,17" fill="#1e2a38" stroke="#e74c3c" stroke-width="2"/>
                    <text x="30" y="26" text-anchor="middle" font-family="Georgia,serif" font-size="14" fill="#fff" font-weight="700">LPB</text>
                    <line x1="14" y1="32" x2="46" y2="32" stroke="#e74c3c" stroke-width="1"/>
                    <text x="30" y="44" text-anchor="middle" font-family="Georgia,serif" font-size="7" fill="rgba(255,255,255,0.3)" letter-spacing="2">WAVRE</text>
                </svg>
                <div>
                    <h1 class="officiel-title" style="color:<?= e($t['txt']) ?>">Jogging<br><em>LETPARBALLES</em></h1>
                    <p class="officiel-sub" style="color:<?= e($t['sub']) ?>">IFOSUP · Wavre · 2026</p>
                </div>
            </div>

        <?php endif; ?>
    </header>

    <?php if ($preview === 'rocky'): ?>
        <div class="rocky-ticker"><span>
            ACCÈS RESTREINT &nbsp;·&nbsp; IDENTIFIEZ-VOUS &nbsp;·&nbsp;
            BONNE CHANCE &nbsp;·&nbsp; OLAF ON SAIT QUE C'EST TOI &nbsp;·&nbsp;
            ACCÈS RESTREINT &nbsp;·&nbsp; IDENTIFIEZ-VOUS &nbsp;·&nbsp;
            BONNE CHANCE &nbsp;·&nbsp; OLAF ON SAIT QUE C'EST TOI &nbsp;·&nbsp;
        </span></div>
    <?php elseif ($preview === 'officiel'): ?>
        <div class="officiel-accent-bar"></div>
    <?php endif; ?>

    <div class="login-body">

        <form method="post">
            <label for="username"><?= e($t['ll']) ?></label>
            <input type="text" name="username" id="username"
                   required autofocus autocomplete="username">

            <label for="password"><?= e($t['lp']) ?></label>
            <input type="password" name="password" id="password"
                   required autocomplete="current-password">

            <button type="submit" name="login" class="btn-login">
                <?= e($t['btn']) ?>
            </button>
        </form>

        <?php if ($erreur): ?>
            <div class="erreur"><?= e($erreur) ?></div>
        <?php endif; ?>

        <p class="cartes-label"><?= e($t['sep']) ?></p>

        <?php foreach ($cartes as $c): ?>
            <button class="carte <?= !empty($c['olaf']) ? 'carte-olaf' : '' ?>"
                    onclick="remplir('<?= e($c['id']) ?>','<?= e($c['pw_demo']) ?>','<?= e($c['theme']) ?>')">

                <div class="av" style="background:<?= e($c['avBg']) ?>;color:<?= e($c['avFg']) ?>">
                    <?php if (!empty($c['photo'])): ?>
                        <img src="<?= e($c['photo']) ?>" alt="<?= e($c['nom']) ?>">
                    <?php else: ?>
                        <?= e($c['av']) ?>
                    <?php endif; ?>
                </div>

                <div class="carte-info">
                    <div class="carte-nom">
                        <?= e($c['nom']) ?>
                        <span class="badge badge-<?= e($c['role']) ?>"><?= e($c['role']) ?></span>
                    </div>
                    <div class="carte-desc"><?= e($c['desc']) ?></div>
                </div>

                <div class="carte-creds">
                    <div class="cred"><?= e($c['id']) ?></div>
                    <div class="cred cred-pw"><?= e($c['pw_demo']) ?></div>
                </div>

            </button>
        <?php endforeach; ?>

    </div>

    <footer class="login-footer"><?= e($t['foot']) ?></footer>

</div>

<script>
// Remplit le formulaire + met à jour ?theme= sans rechargement
// La couleur du header changera au prochain submit PHP
function remplir(id, pw, theme) {
    document.getElementById('username').value = id;
    document.getElementById('password').value = pw;
    const u = new URL(window.location);
    u.searchParams.set('theme', theme);
    window.history.replaceState({}, '', u);
}
</script>

</body>
</html>