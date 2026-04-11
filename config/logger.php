<?php
// ============================================================
// CONFIG/LOGGER.PHP — Journal de debug applicatif
// ============================================================
// Usage : lpb_log('ERROR', 'news', 'PDO échec INSERT — ' . $e->getMessage())
//
// Niveaux : INFO  — événement normal (connexion réussie)
//           WARN  — anomalie non bloquante (validation ko, champ vide)
//           ERROR — erreur bloquante (PDOException, état session corrompu)
//
// Origine : fichier appelant + numéro de ligne, ajoutés automatiquement
//           via debug_backtrace() — pas besoin de les passer manuellement.
//
// Sortie  : logs/app.log (ignoré par .gitignore — ne commit jamais)
// Format  : [2026-04-11 14:32:01] [ERROR] [news] PDO échec INSERT — ... — traitement-news.php:38
// ============================================================

function lpb_log(string $niveau, string $contexte, string $message): void {
    // Remonte d'un niveau dans la pile pour obtenir le fichier appelant + la ligne exacte
    $trace   = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
    $origine = basename($trace['file']) . ':' . $trace['line'];

    $ligne = sprintf(
        "[%s] [%-5s] [%s] %s — %s\n",
        date('Y-m-d H:i:s'),
        strtoupper($niveau),
        $contexte,
        $message,
        $origine
    );
    $fichier = dirname(__DIR__) . '/logs/app.log';
    file_put_contents($fichier, $ligne, FILE_APPEND | LOCK_EX);
}
