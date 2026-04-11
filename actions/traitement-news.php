<?php
// ============================================================
// ACTIONS/TRAITEMENT-NEWS.PHP
// ============================================================
// Reçoit les POST depuis admin-news.php.
// Exécute la requête SQL. Redirige toujours.
// Ne s'affiche jamais directement.
//
// SÉCURITÉ :
//   Double auth guard — ce fichier est accessible par URL directe.
//   PDO préparé sur toutes les requêtes.
//   Whitelist $theme depuis $themes_valides (config/contenu.php).
//   (int) cast sur $id — bloque toute injection via l'ID.
// ============================================================

session_start();

if (!isset($_SESSION['user']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

require_once __DIR__ . '/../config/bdd.php';
require_once __DIR__ . '/../config/contenu.php'; // charge $themes_valides
require_once __DIR__ . '/../config/logger.php';

$action = $_POST['action'] ?? '';

if ($action === 'ajouter') {

    $titre   = trim($_POST['titre']   ?? '');
    $contenu = trim($_POST['contenu'] ?? '');
    $theme   = in_array($_POST['theme'] ?? '', $themes_valides)
               ? $_POST['theme']
               : 'officiel';

    if ($titre !== '' && $contenu !== '') {
        try {
            $req = $pdo->prepare('INSERT INTO articles (titre, contenu, theme) VALUES (?, ?, ?)');
            $req->execute([$titre, $contenu, $theme]);
            header('Location: ../index.php?page=admin-news&msg=ajoute');
        } catch (PDOException $e) {
            lpb_log('ERROR', 'news', 'PDO échec INSERT — ' . $e->getMessage());
            header('Location: ../index.php?page=admin-news&msg=erreur');
        }
    } else {
        lpb_log('WARN', 'news', 'Validation échouée — ajouter, user=' . ($_SESSION['user'] ?? '?'));
        header('Location: ../index.php?page=admin-news&msg=erreur');
    }

} elseif ($action === 'modifier') {

    $id      = (int) ($_POST['id']      ?? 0);
    $titre   = trim($_POST['titre']     ?? '');
    $contenu = trim($_POST['contenu']   ?? '');
    $theme   = in_array($_POST['theme'] ?? '', $themes_valides)
               ? $_POST['theme']
               : 'officiel';

    if ($id > 0 && $titre !== '' && $contenu !== '') {
        try {
            $req = $pdo->prepare('UPDATE articles SET titre = ?, contenu = ?, theme = ? WHERE id = ?');
            $req->execute([$titre, $contenu, $theme, $id]);
            header('Location: ../index.php?page=admin-news&msg=modifie');
        } catch (PDOException $e) {
            lpb_log('ERROR', 'news', 'PDO échec UPDATE id=' . $id . ' — ' . $e->getMessage());
            header('Location: ../index.php?page=admin-news&msg=erreur');
        }
    } else {
        lpb_log('WARN', 'news', 'Validation échouée — modifier id=' . $id . ', user=' . ($_SESSION['user'] ?? '?'));
        header('Location: ../index.php?page=admin-news&msg=erreur');
    }

} elseif ($action === 'supprimer') {

    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        try {
            $req = $pdo->prepare('DELETE FROM articles WHERE id = ?');
            $req->execute([$id]);
            header('Location: ../index.php?page=admin-news&msg=supprime');
        } catch (PDOException $e) {
            lpb_log('ERROR', 'news', 'PDO échec DELETE id=' . $id . ' — ' . $e->getMessage());
            header('Location: ../index.php?page=admin-news&msg=erreur');
        }
    } else {
        header('Location: ../index.php?page=admin-news');
    }

} else {
    header('Location: ../index.php?page=admin-news');
}

exit();