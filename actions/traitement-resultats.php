<?php
// ============================================================
// ACTIONS/TRAITEMENT-RESULTATS.PHP
// ============================================================
// Reçoit les POST depuis admin-resultats.php.
// Exécute la requête SQL. Redirige toujours.
// Ne s'affiche jamais directement.
//
// SÉCURITÉ :
//   Double auth guard — ce fichier est accessible par URL directe.
//   PDO préparé sur toutes les requêtes.
//   Whitelist $sexe — seuls 'M' et 'F' acceptés.
//   (int) cast sur $id — bloque toute injection via l'ID.
// ============================================================

session_start();

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'organisateur'])) {
    header('Location: ../index.php');
    exit();
}

require_once __DIR__ . '/../config/bdd.php';
require_once __DIR__ . '/../config/logger.php';

$action = $_POST['action'] ?? '';

if ($action === 'ajouter') {

    $nom    = strtoupper(trim($_POST['nom']    ?? ''));
    $prenom = ucfirst(strtolower(trim($_POST['prenom'] ?? '')));
    $temps  = trim($_POST['temps']  ?? '');
    $sexe   = in_array($_POST['sexe'] ?? '', ['M', 'F']) ? $_POST['sexe'] : '';

    if ($nom !== '' && $prenom !== '' && $temps !== '' && $sexe !== '') {
        try {
            $req = $pdo->prepare('INSERT INTO coureurs (nom, prenom, temps, sexe) VALUES (?, ?, ?, ?)');
            $req->execute([$nom, $prenom, $temps, $sexe]);
            header('Location: ../index.php?page=admin-resultats&msg=ajoute');
        } catch (PDOException $e) {
            lpb_log('ERROR', 'resultats', 'PDO échec INSERT — ' . $e->getMessage());
            header('Location: ../index.php?page=admin-resultats&msg=erreur');
        }
    } else {
        lpb_log('WARN', 'resultats', 'Validation échouée — ajouter, user=' . ($_SESSION['user'] ?? '?'));
        header('Location: ../index.php?page=admin-resultats&msg=erreur');
    }

} elseif ($action === 'modifier') {

    $id     = (int) ($_POST['id']     ?? 0);
    $nom    = strtoupper(trim($_POST['nom']      ?? ''));
    $prenom = ucfirst(strtolower(trim($_POST['prenom']   ?? '')));
    $temps  = trim($_POST['temps']    ?? '');
    $sexe   = in_array($_POST['sexe'] ?? '', ['M', 'F']) ? $_POST['sexe'] : '';

    if ($id > 0 && $nom !== '' && $prenom !== '' && $temps !== '' && $sexe !== '') {
        try {
            $req = $pdo->prepare('UPDATE coureurs SET nom = ?, prenom = ?, temps = ?, sexe = ? WHERE id = ?');
            $req->execute([$nom, $prenom, $temps, $sexe, $id]);
            header('Location: ../index.php?page=admin-resultats&msg=modifie');
        } catch (PDOException $e) {
            lpb_log('ERROR', 'resultats', 'PDO échec UPDATE id=' . $id . ' — ' . $e->getMessage());
            header('Location: ../index.php?page=admin-resultats&msg=erreur');
        }
    } else {
        lpb_log('WARN', 'resultats', 'Validation échouée — modifier id=' . $id . ', user=' . ($_SESSION['user'] ?? '?'));
        header('Location: ../index.php?page=admin-resultats&msg=erreur');
    }

} elseif ($action === 'supprimer') {

    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0) {
        try {
            $req = $pdo->prepare('DELETE FROM coureurs WHERE id = ?');
            $req->execute([$id]);
            header('Location: ../index.php?page=admin-resultats&msg=supprime');
        } catch (PDOException $e) {
            lpb_log('ERROR', 'resultats', 'PDO échec DELETE id=' . $id . ' — ' . $e->getMessage());
            header('Location: ../index.php?page=admin-resultats&msg=erreur');
        }
    } else {
        header('Location: ../index.php?page=admin-resultats');
    }

} else {
    header('Location: ../index.php?page=admin-resultats');
}

exit();
