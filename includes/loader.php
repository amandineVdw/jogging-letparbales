<?php
// ============================================================
// INCLUDES/LOADER.PHP — Loader animé par thème
// ============================================================
// Inclus dans index.php via require 'includes/loader.php'.
// $theme est disponible via le scope de index.php.
//
// Chaque thème a :
//   - Sa couleur principale (runner + dots + label)
//   - Sa vitesse d'animation
//   - Son dossard (741 officiel / 17:06 dark / LPB rocky)
//   - Sa police de label
// ============================================================

$loader = [
    'officiel' => [
        'main'    => '#1e2a38',
        'acc'     => '#e74c3c',
        'speed'   => '1.3s',
        'label'   => 'Chargement',
        'font'    => 'system-ui, sans-serif',
        'opacity' => '0.15',
        'bib'     => '741',
        'bibFont' => 'Georgia, serif',
        'bibSize' => '7',
    ],
    'dark' => [
        'main'    => '#e74c3c',
        'acc'     => '#e74c3c',
        'speed'   => '1.6s',
        'label'   => '// chargement',
        'font'    => "'Courier New', monospace",
        'opacity' => '0.2',
        'bib'     => '17:06',
        'bibFont' => "'Courier New', monospace",
        'bibSize' => '6',
    ],
    'rocky' => [
        'main'    => '#f5c400',
        'acc'     => '#f5c400',
        'speed'   => '0.85s',
        'label'   => 'EN ROUTE',
        'font'    => "'Arial Black', Arial, sans-serif",
        'opacity' => '0.3',
        'bib'     => 'LPB',
        'bibFont' => "'Arial Black', Arial, sans-serif",
        'bibSize' => '7',
    ],
];

$l         = $loader[$theme] ?? $loader['officiel'];
$flagColor = $l['acc'];

// Corps SVG du runner selon le thème
// Même structure, couleurs et style adaptés
$runners = [

    'officiel' => '
        <circle cx="24" cy="7" r="6" fill="' . $l['main'] . '"/>
        <path d="M24 13 Q20 15 18 19 L14 30 Q13 32 16 32 L20 32 L18 40 L24 38 L30 40 L28 32 L32 32 Q35 32 34 30 L30 19 Q28 15 24 13Z" fill="' . $l['main'] . '"/>
        <rect x="17" y="19" width="14" height="10" rx="1" fill="white"/>
        <text x="24" y="27" text-anchor="middle"
              font-family="' . $l['bibFont'] . '"
              font-size="' . $l['bibSize'] . '"
              fill="' . $l['main'] . '" font-weight="700">' . $l['bib'] . '</text>
        <path d="M20 32 Q17 39 13 46 Q11 50 14 51 Q17 52 18 48 L22 38" fill="' . $l['main'] . '"/>
        <path d="M28 32 Q31 39 35 46 Q37 50 34 51 Q31 52 30 48 L26 38" fill="' . $l['main'] . '"/>
        <path d="M18 19 Q11 21 8 26 Q6 29 9 30 Q12 31 14 26" fill="' . $l['main'] . '"/>
        <path d="M30 19 Q37 23 40 27 Q42 30 39 31 Q36 30 34 25" fill="' . $l['main'] . '"/>
    ',

    'dark' => '
        <circle cx="24" cy="7" r="5" fill="' . $l['main'] . '" opacity="0.85"/>
        <path d="M24 12 Q21 14 19 18 L15 28 Q14 30 17 30 L21 30 L19 40 L24 38 L29 40 L27 30 L31 30 Q34 30 33 28 L29 18 Q27 14 24 12Z" fill="' . $l['main'] . '" opacity="0.7"/>
        <path d="M21 30 Q18 37 14 44 Q12 48 15 49 Q18 50 19 46 L23 36" fill="' . $l['main'] . '" opacity="0.5"/>
        <path d="M27 30 Q30 37 34 44 Q36 48 33 49 Q30 50 29 46 L25 36" fill="' . $l['main'] . '" opacity="0.5"/>
        <path d="M19 18 Q12 20 9 25 Q7 28 10 29 Q13 30 15 25" fill="' . $l['main'] . '" opacity="0.5"/>
        <path d="M29 18 Q36 22 39 26 Q41 29 38 30 Q35 29 33 24" fill="' . $l['main'] . '" opacity="0.5"/>
        <text x="24" y="52" text-anchor="middle"
              font-family="' . $l['bibFont'] . '"
              font-size="' . $l['bibSize'] . '"
              fill="' . $l['main'] . '" opacity="0.4">' . $l['bib'] . '</text>
    ',

    'rocky' => '
        <circle cx="24" cy="6" r="6.5" fill="' . $l['main'] . '"/>
        <path d="M24 12 Q19 15 17 20 L12 32 Q11 35 15 35 L19 35 L17 44 L24 42 L31 44 L29 35 L33 35 Q37 35 36 32 L31 20 Q29 15 24 12Z" fill="' . $l['main'] . '"/>
        <rect x="16" y="19" width="16" height="11" rx="1" fill="#000"/>
        <text x="24" y="27" text-anchor="middle"
              font-family="' . $l['bibFont'] . '"
              font-size="' . $l['bibSize'] . '"
              fill="' . $l['main'] . '" font-weight="900">' . $l['bib'] . '</text>
        <path d="M19 35 Q15 43 10 50 Q8 54 12 55 Q16 56 17 51 L21 41" fill="' . $l['main'] . '"/>
        <path d="M29 35 Q33 43 38 50 Q40 54 36 55 Q32 56 31 51 L27 41" fill="' . $l['main'] . '"/>
        <path d="M17 20 Q9 23 6 28 Q4 32 8 33 Q12 34 14 28" fill="' . $l['main'] . '"/>
        <path d="M31 20 Q39 25 42 30 Q44 33 40 34 Q36 33 34 27" fill="' . $l['main'] . '"/>
    ',
];

$runnerSvg = $runners[$theme] ?? $runners['officiel'];
?>

<div class="loader-overlay" id="loader" aria-live="polite" aria-label="Chargement en cours">
    <div class="loader-stage">

        <div class="loader-track" style="background:<?= $flagColor ?>;opacity:<?= $l['opacity'] ?>"></div>

        <div class="loader-pole" style="background:<?= $flagColor ?>"></div>
        <svg class="loader-flag" viewBox="0 0 18 12" aria-hidden="true">
            <path d="M0 0 L16 3 L16 10 L0 10 Z" fill="<?= $flagColor ?>"/>
            <rect x="0" y="0" width="2" height="12"
                  fill="<?= $theme === 'rocky' ? '#000' : $l['main'] ?>"/>
        </svg>

        <svg class="loader-runner" width="48" height="58" viewBox="0 0 48 58"
             style="animation-duration:<?= $l['speed'] ?>" aria-hidden="true">
            <?= $runnerSvg ?>
        </svg>

    </div>

    <div class="loader-dots">
        <span style="background:<?= $flagColor ?>"></span>
        <span style="background:<?= $flagColor ?>"></span>
        <span style="background:<?= $flagColor ?>"></span>
    </div>

    <p class="loader-label"
       style="color:<?= $flagColor ?>;font-family:<?= $l['font'] ?>">
        <?= e($l['label']) ?>
    </p>
</div>
