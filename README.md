# Jogging LETPARBALLES

Site PHP multi-thème pour le Jogging de l'IFOSUP — Wavre.  
Projet scolaire — Cours 5XDEV-1 — IFOSUP Wavre — Examen oral 15 avril 2026.

**Production** → [letparballes.free.nf](https://letparballes.free.nf)

---

## Stack

- PHP vanilla — zéro framework
- PDO / MySQL
- CSS custom (design tokens + thèmes)
- HTML sémantique

## Architecture

```
index.php        → Front controller
login.php        → Authentification
config/          → BDD, utilisateurs, contenu éditorial, logger
pages/           → Accueil, News, Résultats, Contact, Admin
actions/         → Traitements POST (PRG pattern)
assets/css/      → Tokens → Base → Thèmes
```

## Thèmes

| Thème | Utilisateur | Style |
|-------|-------------|-------|
| officiel | Bruno Zieuvair | Sobre, institutionnel — navy / rouge |
| story | Olaf Herme | Chaleureux, auto-dérision — noir / rouge, Courier New |
| rocky | Gilles Letparballes | Coach ultra engagé — noir / jaune, Arial Black |

## Sécurité

- XSS : `e()` = `htmlspecialchars()` sur toute variable affichée
- Injection SQL : PDO préparé sur toutes les requêtes avec variable
- Credentials : fichier PHP hors BDD, exclu du repo (`.gitignore`)
- Double auth guard sur tous les fichiers `actions/`

## Installation locale

1. Cloner le repo dans le dossier web (ex: Laragon `www/`)
2. Créer `config/bdd.php` à partir de `config/bdd.example.php`
3. Créer `config/users.php` à partir de `config/users.example.php`
4. Importer `jogging_letparballes2.sql` dans MySQL
5. Ouvrir `http://localhost/jogging-letparballes2`
