<?php
// ============================================================
// LOGOUT.PHP — Déconnexion
// ============================================================
// Rôle : détruire la session en cours et renvoyer au login.
// ============================================================

// On doit démarrer la session avant de pouvoir la détruire
session_start();

// session_destroy() supprime toutes les données de session côté serveur
// et invalide le cookie de session du visiteur.
// Après ça, $_SESSION est vide et l'utilisateur n'est plus "connecté".
session_destroy();

// Redirection vers la page de login
header("Location: index.php");
exit();
