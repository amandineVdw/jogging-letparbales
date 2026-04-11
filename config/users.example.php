<?php
// ============================================================
// CONFIG/USERS.PHP — Cast complet
// ============================================================
// SÉCURITÉ : dans .gitignore — ne jamais commiter.
// En prod : password_hash() + password_verify().
//
// RÔLES :
//   admin        → CRUD complet (articles + classement)
//   organisateur → classement uniquement (pas les articles)
//   participant  → lecture seule
//
// THÈMES :
//   officiel → sobre, institutionnel
//   story    → narratives, Olaf Herme
//   rocky    → coaching, Gilles Letparballes
//

// ============================================================

$users = [

    'gilles' => [
        'password' => password_hash('CHANGER_MOI', PASSWORD_BCRYPT),
        'theme'    => 'rocky',
        'role'     => 'admin',
        'nom'      => 'Gilles Letparballes',
    ],

    'olaf' => [
        'password' => password_hash('CHANGER_MOI', PASSWORD_BCRYPT),
        'theme'    => 'story',
        'role'     => 'admin',
        'nom'      => 'Olaf Herme',
    ],

    'bruno' => [
        'password' => password_hash('CHANGER_MOI', PASSWORD_BCRYPT),
        'theme'    => 'officiel',
        'role'     => 'organisateur',
        'nom'      => 'Bruno Zieuvair',
    ],

];
