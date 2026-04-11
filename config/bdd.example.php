<?php
// ============================================================
// CONNEXION À LA BASE DE DONNÉES — FICHIER EXEMPLE
// Copier ce fichier en "bdd.php" et remplir les valeurs.
// bdd.php est dans .gitignore — ne jamais le commiter.
// ============================================================

$host_actuel = $_SERVER['HTTP_HOST'] ?? 'localhost';

if (str_contains($host_actuel, 'free.nf') || str_contains($host_actuel, 'infinityfree')) {
    // === PRODUCTION (InfinityFree) ===
    $host   = 'sql***.infinityfree.com';  // hostname MySQL InfinityFree
    $dbname = 'if0_XXXXXXX_letparballes2'; // nom de la base de données
    $user   = 'if0_XXXXXXX';             // username MySQL
    $pass   = 'VOTRE_MOT_DE_PASSE';      // mot de passe MySQL
} else {
    // === LOCAL (Laragon) ===
    $host   = 'localhost';
    $dbname = 'jogging_letparballes2';
    $user   = 'root';
    $pass   = '';
}
$port = '3306';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
