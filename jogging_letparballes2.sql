-- ============================================================
-- JOGGING_LETPARBALLES.SQL
-- ============================================================
-- Base de données complète — prête à importer via phpMyAdmin.
-- Inclut la structure ET les données initiales.
--
-- TABLES :
--   articles → contenu éditorial par thème
--   coureurs → classement de la course
--
-- IMPORT : phpMyAdmin → Importer → sélectionner ce fichier
-- ============================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8mb4;

-- ============================================================
-- CRÉATION DE LA BASE
-- ============================================================

CREATE DATABASE IF NOT EXISTS `jogging_letparballes2`
    DEFAULT CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `jogging_letparballes2`;

-- ============================================================
-- TABLE : articles
-- ============================================================
-- Contenu éditorial filtré par thème.
-- Chaque thème (officiel / story / rocky) a ses propres articles.
-- La colonne `theme` est une whitelist applicative —
-- les valeurs valides sont définies dans config/contenu.php.
-- ============================================================

DROP TABLE IF EXISTS `articles`;

CREATE TABLE `articles` (
    `id`       INT          NOT NULL AUTO_INCREMENT,
    `titre`    VARCHAR(255) NOT NULL,
    `contenu`  TEXT         NOT NULL,
    `theme`    VARCHAR(20)  NOT NULL DEFAULT 'officiel',
    `cree_le`  TIMESTAMP    NULL     DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- DONNÉES : articles
-- ============================================================

INSERT INTO `articles` (`titre`, `contenu`, `theme`) VALUES

-- Thème officiel
('Ouverture des inscriptions pour l\'édition 2026',
'Les inscriptions pour le Jogging de l\'IFOSUP 2026 sont désormais ouvertes. Vous pouvez vous inscrire en ligne ou via l\'administration. Les inscriptions anticipées facilitent l\'organisation et garantissent votre dossard.',
'officiel'),

('Date et lieu du départ',
'L\'édition 2026 du jogging se tiendra le dimanche 18 mai, avec un départ prévu à 10h00 devant le bâtiment principal de l\'IFOSUP. Nous vous invitons à arriver au minimum 30 minutes à l\'avance afin de retirer votre dossard et de vous échauffer.',
'officiel'),

('Nouveaux parcours 5 km et 10 km',
'Cette année, deux distances sont proposées : un circuit de 5 km accessible à tous et un parcours de 10 km pour les plus aguerri·e·s. Les tracés seront prochainement disponibles sur le site, avec une carte détaillée et le profil du dénivelé.',
'officiel'),

('Retrait des dossards : informations pratiques',
'Les dossards pourront être retirés la veille de la course, de 17h00 à 19h00, ainsi que le jour même à partir de 8h30. Merci de vous munir de votre confirmation d\'inscription (imprimée ou sur smartphone) pour accélérer le retrait.',
'officiel'),

('Échauffement collectif encadré',
'Un échauffement collectif sera proposé 15 minutes avant le départ, animé par un·e coach sportif·ve. Il est fortement recommandé d\'y participer pour limiter les risques de blessure et commencer la course dans de bonnes conditions.',
'officiel'),

('Ravitaillements sur le parcours',
'Des points de ravitaillement en eau seront disponibles à mi-parcours ainsi qu\'à l\'arrivée. Nous invitons les participant·e·s à s\'hydrater régulièrement et à adapter leur effort en fonction de leur condition physique.',
'officiel'),

('Résultats et classements',
'Les résultats complets (classements par catégorie et temps individuels) seront publiés sur le site dans les 24 heures suivant la course. Un lien vers la recherche par nom ou numéro de dossard sera disponible sur la page "Résultats".',
'officiel'),

('Album photos et retour en images',
'Un album photos de l\'événement sera mis en ligne quelques jours après le jogging. Vous pourrez y retrouver les moments forts, l\'ambiance sur le parcours et les arrivées. Les liens vers les galeries seront annoncés dans la section "Actualités".',
'officiel'),

-- THEME ROCKY - GILLES LETPARBALLES, LE FONDATEUR ---------------------------------------------------------
-- 1. Ouverture des inscriptions
('Ordre de mission 2026 : j\'ouvre la porte de l\'élite du dimanche.',
'Je lance officiellement l\'édition 2026 du Jogging de l\'IFOSUP. On y est ! Si tu cliques sur "Je participe", tu ne t\'inscris pas à une promenade, non non non. Tu entres dans mon équipe. Et dans mon équipe, je pars du principe que tout le monde a un monstre sous le t-shirt. Oui, même toi qui te dis "je suis nul en sport". Faux ! Tu ne le vois pas encore, mais moi si. Paf. Je prends des profils canapé-Netflix-tartines au choco et j\'en fais des gens qui passent une ligne d\'arrivée la tête haute. C\'est ça, mon boulot. Et je le prends très au sérieux.',
'rocky'),

-- 2. Date et lieu du départ
('Dimanche 18 mai, 10h00 : rassemblement des pépites devant l\'IFOSUP.',
'Le 18 mai à 10h00, je veux une chose : une ligne de départ pleine de potentiel. Que tu viennes pour 5 ou 10 km, que tu aies couru hier ou il y a cinq ans, à partir du moment où tu te pointes devant l\'IFOSUP, je te classe dans la catégorie "coureur". Point. Arrive vers 9h30, récupère ton dossard, regarde autour de toi : tu verras des têtes qui doutent. Moi, je vois des surprises qui se préparent. Mon job, c\'est de vous le répéter dans le micro jusqu\'à ce que vous y croyiez vous aussi. Tac.',
'rocky'),

-- 3. Parcours 5 km / 10 km
('5 km ou 10 km : choisis ton terrain de jeu, pas ta punition.',
'Cette année, je te propose deux distances. 5 km pour te chauffer, 10 km pour te prouver un truc à toi-même. Le parcours ? Des rues que tu connais, des champs que tu regardes d\'habitude par la fenêtre de la voiture, quelques virages où je hurlerai ton prénom comme si tu menais un marathon télévisé. Tu crois que c\'est "juste un jogging de quartier" ? Erreur. C\'est ton laboratoire. C\'est là qu\'on transforme "je ne suis pas fait pour ça" en "attends, j\'ai réussi ça, en fait". Boum.',
'rocky'),

-- 4. Retrait des dossards
('Retrait des dossards : viens chercher ton numéro, moi je vois déjà le potentiel derrière.',
'La veille de la course, de 17h00 à 19h00, et le jour J dès 8h30, je t\'attends pour le retrait des dossards. Tu arrives avec ta confirmation d\'inscription, ton manteau et ton track record sportif plus ou moins vide. Moi, je te tends ton numéro comme si je te confiais un maillot officiel. Parce que pour moi, c\'est exactement ça. Quand tu l\'accroches avec les petites aiguilles tordues (oui, celles qui piquent les doigts, paf !), tu passes d\'observateur à acteur. Tu n\'es plus "quelqu\'un qui vient voir". Tu es "quelqu\'un qu\'on viendra voir arriver".',
'rocky'),

-- 5. Échauffement collectif
('Échauffement collectif : on réveille la machine, même si elle grince.',
'Quinze minutes avant le départ : rassemblement. Musique. Coach. Mouvement. Tu vas râler, je le sais. "On ne peut pas juste partir ?" Non. On va monter les genoux, rouler les épaules, réveiller chaque muscle qui pensait être à la retraite anticipée. Moi, je serai là, à vous regarder grimacer, sourire, souffler. Et à chaque fois que j\'en verrai un qui lâche un "pfiou", je me dirai : parfait, ça travaille. L\'échauffement, ce n\'est pas pour faire joli sur les photos. C\'est pour que ton corps comprenne que dans quelques minutes, on appuie sur START. Hop.',
'rocky'),

-- 6. Ravitaillements
('Ravitaillement : carburant minimum, confiance maximum.',
'À mi-parcours, et à l\'arrivée, tu trouveras un point d\'eau. Ce n\'est pas un spa, c\'est une station-service émotionnelle. Tu prends ton gobelet, tu bois, tu respires. De l\'extérieur, ça a l\'air banal. Moi, je sais que c\'est souvent là que ça se joue : certains regardent la route, posent le gobelet, repartent. D\'autres hésitent. Je ne juge pas. Je regarde juste les yeux. Ceux qui repartent, même doucement, même en mode "ouf", je les classe direct dans ma catégorie préférée : les têtus magnifiques.',
'rocky'),

-- 7. Les supporters
('Les supporters : tu ne cours pas seul, même si tu as l\'impression d\'être tout seul dans ta tête.',
'Sur le bord de la route, il y aura du monde : famille, voisins, gens qui passaient par là et qui restent juste pour voir "comment ça finit". Ils verront tes jambes, ta vitesse, ta sueur. Moi, je verrai autre chose : ta petite fierté qui commence à se pointer quand tu entends ton prénom. BOUM, ça, c\'est mon moment préféré. Quand tu lèves à peine la main, que tu fais un micro-sourire, alors qu\'à l\'intérieur c\'est le chantier… là, je sais que tu es en train de devenir accro à cette sensation.',
'rocky'),

-- 8. Résultats
('Résultats : des chiffres pour le site, des déclics pour toi.',
'Les résultats, je les publierai proprement : temps, classement, catégories. Tu pourras tout analyser, tout comparer, tout décortiquer. Mais je te le dis franchement : les chiffres, c\'est pour les tableaux. Ce qui m\'intéresse vraiment, c\'est le moment où tu regarderas ton temps et que tu lâcheras un "ah ouais… quand même". Même si tu es dernier de ta catégorie, même si tu as marché, même si tu as cru abandonner à la moitié : tu auras une ligne, avec ton nom, ton temps, ta preuve. Et ça, personne ne peut te l\'enlever. Tac.',
'rocky'),

-- 9. Album photos
('Album photos : on garde tout, surtout ce qui n\'est pas instagrammable.',
'Après la course, on mettra les photos en ligne. Il y aura les belles : départ, sourire, ciel dramatique, bravo. Et puis il y aura les vraies : grimaces, mains sur les genoux, t-shirts collés, regards dans le vide. Je ne filtre pas ça. Je ne veux pas d\'un jogging carte postale. Je veux un jogging honnête. Quand tu te verras en mode "pas glamour du tout", rappelle-toi : ce jour-là, tu étais en train de faire quelque chose que beaucoup d\'autres n\'ont même pas osé tenter. Et ça, ça vaut tous les filtres du monde. Paf.',
'rocky'),

-- 10. Accueil — mode Rocky
('Accueil — mode Rocky : tu as largement plus en toi que ce que tu crois. Moi, j\'en suis sûr.',
'Si tu lis ces lignes, c\'est que tu hésites encore un peu. Normal. Ton cerveau est programmé pour économiser l\'énergie, pas pour s\'inscrire à des joggings étranges organisés par un gars en gilet fluo qui parle trop fort. Mais écoute-moi bien : tu as largement plus en toi que ce que tu crois. Mon rôle, ce n\'est pas d\'être objectif. Mon rôle, c\'est de voir le potentiel là où toi tu vois juste un "bof". Alors voilà le deal : tu viens, tu mets un dossard, tu te laisses embarquer dans l\'ambiance… et on verra bien qui avait raison. Spoiler : souvent, c\'est moi. Boum.',
'rocky'),

-- THEME NEWTONE - OLAF HERME, LE DERNIER DE LA CLASSE -----------------------------------------

-- 1
('Je suis arrivé dernier. VDM, mais j\'ai quand même une médaille.',
'Je m\'appelle Olaf Herme. Si tu ouvres le classement du jogging, tu me trouveras tout en bas. Dernier. Vraiment dernier. Quand je suis passé sous l\'arche, il restait plus de chaises en plastique que de public. Gilles a crié mon prénom dans le micro comme si j\'étais le héros du jour, Bruno a applaudi, et moi j\'ai réalisé que ma médaille avait la même tête que celle du premier. La seule différence, c\'est le temps qu\'il a fallu pour l\'obtenir. VDM, mais ça reste une médaille.',
'story'),

-- 2
('Mon échauffement ressemblait plus à un test de coordination qu\'à du sport.',
'Je m\'appelle Olaf Herme, et je pensais que l\'échauffement, ce serait deux petits étirements tranquilles. Haha. Non. Gilles a pris le micro, a mis la musique, et d\'un coup on s\'est tous retrouvés à sauter sur place comme dans un cours de danse pour gens pas prêts. "ET ON MONTE LES GENOUX !" qu\'il criait. Les autres suivaient plus ou moins. Moi, j\'essayais déjà de ne pas perdre l\'équilibre ni assommer mon voisin avec mon coude. À un moment, j\'ai réussi à faire un mouvement du bras et de la jambe opposée dans le mauvais sens. Gilles m\'a encouragé quand même, comme si j\'étais en train de préparer un championnat. Coordination : 0. Motivation : +10. VDM, mais ça m\'a fait rire.',
'story'),

-- 3
('Le moment où la poussette m\'a doublé. Oui, une poussette.',
'Je savais que je n\'étais pas rapide. Mais je pensais au moins être plus rapide qu\'un humain qui pousse un autre humain assis. Faux. À mi-parcours, j\'ai entendu un petit "ding ding" derrière moi. J\'ai imaginé un vélo. C\'était une poussette. Parent concentré, enfant en bonnet avec biscuit, ambiance balade du dimanche. Ils m\'ont dépassé proprement. Gilles, au loin, a crié "ALLEZ OLAF, SUPER !". Moi, je venais d\'échouer à battre quelqu\'un qui ne sait pas encore marcher. VDM, mais j\'ai continué. Par fierté. Et parce que je n\'allais pas abandonner derrière un bébé.',
'story'),

-- 4
('J\'ai voulu accélérer pour la photo. Mon corps n\'était pas au courant.',
'Sur le parcours, il y avait un photographe. Je l\'ai vu de loin, accroupi, appareil prêt, air sérieux. Je me suis dit : "Ok Olaf, c\'est ton moment. On relève la tête, on allonge la foulée, on fait croire qu\'on gère." J\'ai essayé d\'accélérer. Résultat : une foulée approximative, un visage coincé entre le sourire et la panique, et une respiration de vieux radiateur. La photo sera sûrement floue, mais on y verra clairement une chose : j\'avais essayé. VDM, mais au moins, j\'aurai une preuve que j\'ai tenté le coup.',
'story'),

-- 5
('Au ravitaillement, j\'ai bu comme si c\'était un test de QI. Raté.',
'Au point d\'eau, un bénévole m\'a tendu un gobelet comme si j\'avais traversé un désert. J\'ai pris le verre, j\'ai essayé de boire en courant, comme je vois faire les vrais coureurs à la télé. Résultat : 30 % dans la bouche, 70 % sur moi. J\'ai failli m\'étouffer, j\'ai remercié en toussant, et j\'ai continué en dégoulinant d\'eau tiède. Le bénévole m\'a lancé un "bravo" sincère, alors que je venais de prouver que même boire de l\'eau peut être une compétence. VDM, mais au moins j\'étais hydraté.',
'story'),

-- 6
('Les supporters ont crié mon prénom. Moi, je n\'arrivais même plus à dire merci.',
'À un virage, un petit groupe avait une pancarte avec "ALLEZ OLAF" écrit en gros. Pour moi. Moi, Olaf, 17ème sur 17. Ils tapaient dans leurs mains, ils faisaient plus de bruit que mon souffle. J\'ai voulu dire "merci", mais ce qui est sorti ressemblait plutôt à un mélange de grognement et de souffle de baleine. J\'ai levé la main en espérant que ça compte comme interaction sociale. VDM, mais ça m\'a donné assez d\'ego pour survivre aux 500 mètres suivants.',
'story'),

-- 7
('Ma montre a vibré. C\'était juste pour me dire que je marchais trop lentement.',
'J\'avais mis ma montre connectée pour "suivre ma performance". Mauvaise idée. Au bout d\'un moment, elle a vibré. J\'ai cru que c\'était un lap en plus, un truc important. Non. C\'était une notification discrète qui disait que mon rythme ressemblait plus à une marche rapide hésitante qu\'à une course. L\'objet qui est censé m\'aider a décidé de me juger. VDM, mais j\'ai continué, juste pour prouver à une montre que je pouvais aller au bout.',
'story'),

-- 8
('À l\'arrivée, j\'ai sprinté. Enfin, j\'ai cru.',
'Quand j\'ai vu l\'arche d\'arrivée, j\'ai décidé de "sprinter". Dans ma tête, c\'était Hollywood : musique épique, ralenti, foule en délire. Dans la réalité, j\'ai juste augmenté ma vitesse de deux centimètres par minute. Gilles a crié "OLAF ACCÉLÈRE !", le public a applaudi, et moi j\'ai donné tout ce qu\'il restait, c\'est-à-dire pas grand-chose. Sur les photos, on verra sûrement juste un type un peu plus rouge sur les cinq derniers mètres. VDM, mais j\'ai vraiment tout donné.',
'story'),

-- 9
('Après la course, j\'ai descendu les escaliers comme si j\'avais 120 ans.',
'Le lendemain, j\'ai découvert un nouveau sport : descendre les escaliers. Chaque marche était une négociation entre mes cuisses et la gravité. J\'ai fait ce truc où tu t\'accroches à la rampe comme si elle allait te raconter une blague pour te distraire de la douleur. Mes voisins m\'ont demandé "alors, c\'était sympa, le jogging ?" J\'ai répondu "oui, super", en descendant marche par marche comme un meuble ancien. VDM, mais une VDM dont j\'étais bizarrement fier.',
'story'),

-- 10
('Je me suis juré de ne plus jamais m\'inscrire. Puis j\'ai regardé la médaille.',
'Le soir, je me suis affalé sur le canapé, la médaille posée sur la table. J\'ai annoncé très sérieusement : "Plus jamais." Mon corps a voté pour. Mais mon regard est resté bloqué sur le petit bout de métal. C\'était ridicule et important à la fois. Ridicule, parce que tout le monde en a une. Important, parce qu\'il y a mon nom dans le classement. Dernier, oui. Mais dans la liste quand même. Et là, j’ai senti une phrase dangereuse arriver dans ma tête : "L\'an prochain, je ferai mieux." VDM. Je sais déjà que je vais me réinscrire.',
'story');

-- ============================================================
-- TABLE : coureurs
-- ============================================================
-- Classement de la course, trié par temps ASC côté PHP.
-- `sexe` = CHAR(1) — valeurs F ou M uniquement (whitelist PHP).
-- `temps` = TIME — format HH:MM:SS, compatible MySQL et PHP.
-- Tous les noms sont en majuscules (strtoupper() côté PHP).
-- ============================================================

DROP TABLE IF EXISTS `coureurs`;

CREATE TABLE `coureurs` (
    `id`      INT          NOT NULL AUTO_INCREMENT,
    `nom`     VARCHAR(100) NOT NULL,
    `prenom`  VARCHAR(100) NOT NULL,
    `sexe`    CHAR(1)      NOT NULL,
    `temps`   TIME         NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================================
-- DONNÉES : coureurs
-- ============================================================
-- Noms = jeux de mots phonétiques belges.
-- Prénom + Nom = phrase complète quand prononcé.
-- Ex : "Douglas ALAVANILLESIOUPLAIT"
--    = deux glaces à la vanille s'il vous plaît
-- ============================================================

INSERT INTO `coureurs` (`nom`, `prenom`, `sexe`, `temps`) VALUES
('ZIEUVAIR',             'Bruno',   'M', '00:14:08'),  -- Brune aux yeux verts
('ALAVANILLESIOUPLAIT',  'Douglas', 'M', '00:14:17'),  -- Deux glaces à la vanille s'il vous plaît
('UJOUR',                'Fred',    'M', '00:14:23'),  -- Frais du jour
('MENSOIF',              'Gérard',  'M', '00:14:42'),  -- J\'ai rarement soif
('DRÉSSAMÈRE',           'Ivan',    'M', '00:15:19'),  -- Il vendrait sa mère
('UMUL',                 'Jacques', 'M', '00:15:24'),  -- J\'accumule
('HONNETE',              'Camille', 'F', '00:15:25'),  -- Camionnette
('AVULEUR',              'Edith',   'F', '00:15:27'),  -- Hé, dit t'as vu l'heure?
('AVRANTE',              'Hélène',  'F', '00:15:41'),  -- Elle est à vendre
('ORDINE',               'Kid',     'M', '00:15:59'),  -- Kid ordinaire
('TROUILLE',             'Lassie',  'F', '00:16:05'),  -- La citrouille
('HONNETE',              'Marie',   'F', '00:16:19'),  -- Marionnette
('RIENDEMOI',            'Nathan',  'M', '00:16:34'),  -- N\'attend rien de moi
('OTINE',                'Nick',    'M', '00:16:43'),  -- Nicotine
('HERME',                'Olaf',    'M', '00:17:06');  -- Oh la ferme

-- ============================================================
-- AUTO_INCREMENT
-- ============================================================

ALTER TABLE `articles` MODIFY `id` INT NOT NULL AUTO_INCREMENT;
ALTER TABLE `coureurs` MODIFY `id` INT NOT NULL AUTO_INCREMENT;