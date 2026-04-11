<?php
// ============================================================
// CONFIG/CONTENU.PHP — Source de vérité éditoriale
// ============================================================
// Un tableau par thème. Chaque page utilise $t['clé'].
// Ajouter un texte = une ligne ici, jamais dans les pages.
//
// THÈMES ACTIFS : officiel | story | rocky
//
// INNOJP :
//   Existe. Complet. Fonctionnel.
//   Non attribué à aucun utilisateur.
//   C'est voulu.
// ============================================================


// ============================================================
// THÈMES VALIDES — source de vérité unique
// Utilisée dans admin-news.php (select) ET traitement-news.php (whitelist)
// Ajouter un thème = une ligne ici uniquement
// ============================================================
$themes_valides = ['officiel', 'story', 'rocky'];


$textes = [


    // ────────────────────────────────────────────────────────
    // OFFICIEL — Bruno Zieuvair, président de l'IFOSUP, organisateur du jogging, et probablement le plus rapide de tous les participants.
    // — sobre, neutre, professionnel, bienveillant, un peu guindé.
    // — style écrit, un peu formel, avec des tournures classiques (mais pas trop lourdes), structurer, informer, rassurer.
    // ────────────────────────────────────────────────────────
    'officiel' => [
        'nav_accueil'        => 'Accueil',
        'nav_news'           => 'News',
        'nav_resultats'      => 'Résultats',
        'nav_contact'        => 'Contact',
        'nav_admin_coureurs' => 'Admin Résultats',
        'nav_admin_articles' => 'Admin News',


        // Accueil
        'accueil_hero'  => 'assets/images/hero-accueil/hero-image-officiel.png',
        'accueil_titre' => 'Jogging de l\'IFOSUP - Édition 2026',
        'accueil_intro' => 'Wavre - Un événement sportif, convivial et accessible à toutes et tous.',
        'accueil_p1'    => 'Le Jogging de l\'IFOSUP rassemble chaque année des coureuses et des coureurs de tous niveaux autour d\'un parcours de 5 km et de 10 km au départ de l\'IFOSUP.',
        'accueil_p2'    => 'Nous mettons l\'accent sur une organisation claire, un encadrement sécurisé et une ambiance chaleureuse pour que chacun puisse participer dans les meilleures conditions.',
        'accueil_p3'    => 'Sur ce site, vous trouverez toutes les informations pratiques : inscriptions, horaires, parcours, ravitaillements, résultats et albums photos.',
        'accueil_sign'  => 'Que vous veniez pour la performance, pour le plaisir ou pour soutenir vos proches, vous êtes les bienvenus.',


        // News
        'news_image' => 'assets/images/news/news-officiel-image.png',
        'news_titre' => 'News',
        'news_intro' => 'Toutes les actualités du Jogging de l\'IFOSUP.',
        'news_vide'  => 'Aucune news pour le moment.',


        // Résultats
        'res_image' => 'assets/images/resultats/resultat-image-2.png',
        'res_titre' => 'Résultats de la course',
        'res_intro' => 'Wavre - 10 km - samedi 11 avril 2026 - Classement complet des participants, triés par temps.',
        'res_vide'  => 'Aucun résultat enregistré pour le moment.',
        'res_note'  => '', // Pas de note Olaf — sobre oblige


        // Contact
        'contact_image' => 'assets/images/contact/contact-image-gilles.png',
        'contact_titre' => 'Contact',
        'contact_intro' => 'Pour toute question relative au Jogging de l\'IFOSUP (inscriptions, parcours, horaires, résultats, bénévolat), n\'hésitez pas à nous contacter.',
        'contact_note'  => 'Nous sommes là pour vous aider et vous fournir toutes les informations nécessaires.',
    ],


    // ────────────────────────────────────────────────────────
    // STORY — Olaf Herme (participant le plus lent mais narrateur principal de l'intérieur)
    // — ton chaleureux, auto-dérision, lucide, tendre.
    // — style oral, simple (VDM légère, gaffes, contrastes).
    // ────────────────────────────────────────────────────────
    'story' => [
        // Navigation
        'nav_accueil'        => 'Accueil',
        'nav_news'           => 'News',
        'nav_resultats'      => 'Résultats',
        'nav_contact'        => 'Contact',
        'nav_admin_coureurs' => 'Admin Résultats',
        'nav_admin_articles' => 'Admin News',


        // Accueil
        'accueil_hero'  => 'assets/images/hero-accueil/hero-image-story.png',
        'accueil_titre' => 'Jogging de l\'IFOSUP - Le peloton de tête du fond de la course.',
        'accueil_intro' => 'Moi, c\'est Olaf. Je cours lentement, j\'observe beaucoup, et j\'écris pour raconter le jogging vu d\'en bas du tableau.',
        'accueil_p1'    => 'J\'ai le droit d\'écrire ici parce que je fais partie de l\'équipe du site, et que j\'étais sur la ligne de départ — tout au fond. Je ne gère pas les classements, je les complète… par le bas. Comme personne ne raconte jamais ce qu\'on vit derrière, c\'est devenu mon job.',
        'accueil_p2'    => 'Je ne suis pas un athlète. Mon défi, c\'est simplement de tenir jusqu\'au bout et de mettre des mots sur ce que ça fait d\'être de ceux qu\'on encourage par leur prénom à 200 m de l\'arrivée, quand on n\'a plus de jambes. J\'ai fini dernier, oui, mais entier, et c\'est déjà une victoire.',
        'accueil_p3'    => 'De là où je cours, on voit tout : les échauffements hésitants, les gobelets qu\'on rate, la poussette qui te double en montée, les supporters qui te donnent envie d\'y croire encore. Ce site a la voix de Bruno (officielle) et celle de Gilles (coach motivé). Ici, c\'est la mienne : celle du coureur ordinaire, un peu à la traîne, mais heureux d\'être dans la course.',
        'accueil_sign'  => 'Si tu veux comprendre ce que c\'est que de courir sans chrono flatteur, sans podium, mais avec le cœur, tu es au bon endroit. Bienvenue dans le peloton de tête du fond de la course.',


        // News
        'news_image' => 'assets/images/news/news-story-image.png',
        'news_titre' => 'News.',
        'news_intro' => 'Les vrais héros ont des courbatures et parfois des photos floues. Ici, on essaie de suivre tout ça.',
        'news_vide'  => 'Aucune news pour l\'instant. Soit tout le monde récupère, soit c\'est moi qui suis en retard pour écrire.',


        // Résultats
        'res_image' => 'assets/images/resultats/resultat-image-3.png',
        'res_titre' => 'Résultats.',
        'res_intro' => 'Derrière chaque chrono, il y a un souffle court, une petite panique au ravito et une fierté au bout de la ligne. Ici, tu verras les chiffres… moi, je vois surtout les histoires.',
        'res_vide'  => 'Aucun résultat affiché pour le moment. Soit la course n\'a pas encore eu lieu, soit on vérifie encore les chronos (et je ne suis pas le plus rapide pour ça).',
        'res_note'  => 'HERME Olaf. 00:17:06. Oui, c\'est moi : dernier sur la feuille, mais debout à l\'arrivée, et franchement, je le prends comme une victoire.',


        // Contact
        'contact_image' => 'assets/images/contact/contact-image-gilles.png',
        'contact_titre' => 'Contact.',
        'contact_intro' => 'Une question, un doute, une envie de raconter ta course ou ta non-course ? Tu peux écrire, il y a vraiment quelqu\'un derrière l\'écran.',
        'contact_note'  => 'Les messages arrivent directement chez Gilles Letparballes, le coach du jogging. Moi, Olaf, je lui ai juste piqué cette page pour t\'encourager à écrire. Promis, ton mail ne finira pas au fond du peloton.',
    ],


    // ────────────────────────────────────────────────────────
    // ROCKY — Gilles LETPARBALLES - mode coach/rocky.
    // Organisateur, speaker et coach autoproclamé du Jogging de l’IFOSUP.
    // — ton motivant, enthousiaste, un peu décalé, avec une pointe d’humour.
    // — style oral, direct, avec des phrases courtes et percutantes, des métaphores sportives, des encouragements, des exclamations.
    // ────────────────────────────────────────────────────────
    'rocky' => [
        // Navigation
        'nav_accueil'        => 'QG',
        'nav_news'           => 'Briefings',
        'nav_resultats'      => 'Classement',
        'nav_contact'        => 'Commandant',
        'nav_admin_coureurs' => 'Modifier le classement',
        'nav_admin_articles' => 'Publier un briefing',


        // Accueil
        'accueil_hero'  => 'assets/images/hero-accueil/hero-image-rocky.png',
        'accueil_titre' => 'Jogging de l\'IFOSUP. Ici, on révèle les pépites du dimanche.',
        'accueil_intro' => 'Tu crois que tu n\'es pas fait pour courir ? Laisse-moi te prouver le contraire.',
        'accueil_p1'    => 'Je suis Gilles LETPARBALLES, organisateur, speaker en gilet fluo et coach autoproclamé de ce joyeux chaos chronométré.',
        'accueil_p2'    => 'Pour moi, chaque personne qui enfile un dossard a un monstre gentil sous le t-shirt : un potentiel que tu ne vois pas encore, mais que moi, je repère dès que tu arrives sur le parking.',
        'accueil_p3'    => 'Ici, on ne juge pas les performances, on célèbre l\'effort. Que tu sois un sprinteur du dimanche ou un marathonien du dimanche, tu as ta place ici.
Le Jogging de l\'IFOSUP, ce n\'est pas “juste un petit jogging de quartier”. C\'est l\'endroit où tu découvres que tu peux te lever un dimanche, courir plus loin que ta boîte aux lettres, et passer une ligne d\'arrivée en te disant : “Ah ouais… je l\'ai vraiment fait.”',
        'accueil_sign'  => 'Clique sur “Je participe”, viens chercher ton dossard, et laisse-moi hurler ton prénom comme si tu jouais la finale. Boum.',


        // News
        'news_image' => 'assets/images/news/news-rocky-image.png',
        'news_titre' => 'Briefings.',
        'news_intro' => 'Ce que tu dois savoir. Lis. Retiens. Exécute.',
        'news_vide'  => 'Aucun briefing. Mission suspendue. Reviens demain.',


        // Résultats
        'res_image' => 'assets/images/resultats/resultat-image-1.png',
        'res_titre' => 'Classement.',
        'res_intro' => 'Les temps. Les noms. Le verdict. Sans appel.',
        'res_vide'  => 'Aucun résultat. Soit personne n\'a fini, soit personne ne l\'admet.',
        'res_note'  => 'HERME Olaf — 00:17:06. Dernier. Il s\'est quand même levé un dimanche matin pour souffrir devant des inconnus. Respect.',


        // Contact
        'contact_image' => 'assets/images/contact/contact-image-gilles.png',
        'contact_titre' => 'Commandant Gilles Letparballes.',
        'contact_intro' => 'Tu as une question, un doute sur ta préparation ou juste besoin qu\'on te remette les idées dans le bon sens ? Tu m\'écris. Je réponds. Même après un jogging. Surtout après un jogging : c\'est là que je suis le plus bavard sur ta foulée.',
        'contact_note'  => 'Oui, je m\'appelle Gilles LETPARBALLES. Je vis très bien avec ça. Toi, vis très bien avec ton dossard : envoie ton message, et on fera quelque chose de ton potentiel. Paf.',
    ],


];