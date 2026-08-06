# Déploiement Sofifran sur PlanetHoster (N0C)

Guide pas à pas pour mettre en production le site depuis GitHub.
Durée estimée : 30 à 45 minutes.

---

## 0. Prérequis (une seule fois, dans le panneau N0C)

1. **PHP 8.2 ou 8.3** : panneau N0C → *Langages → PHP* → sélectionner **8.3**
   (Laravel 11 exige PHP >= 8.2 ; le site ne démarrera pas en 7.x).
   Extensions à cocher si absentes : `gd`, `mbstring`, `pdo_mysql`, `fileinfo`, `zip`, `exif`.
2. **Accès SSH** : panneau N0C → *Comptes → SSH* → activer, noter hôte/port/utilisateur.
3. **Base de données** : la base existante reste telle quelle (les nouveautés
   s'appliquent par migrations, sans toucher aux données).

---

## 1. SAUVEGARDE (obligatoire avant tout)

```bash
# En SSH sur le serveur
cd ~
tar -czf sauvegarde_site_$(date +%Y%m%d).tar.gz public_html
```

Et exporter la base via phpMyAdmin (Exporter → SQL) ou :

```bash
mysqldump -u UTILISATEUR_DB -p NOM_DB > ~/sauvegarde_db_$(date +%Y%m%d).sql
```

---

## 2. Récupérer le code

```bash
cd ~
git clone https://github.com/kouadiojose/sofifran.git sofifran
cd sofifran
```

*(si le dépôt est privé : créer un jeton GitHub « fine-grained, read-only » et
l'utiliser comme mot de passe au clone)*

---

## 3. Préserver les téléversements faits depuis l'ancien site

Le dépôt contient toutes les images **compressées**. Mais des fichiers ont pu
être téléversés via l'admin APRÈS la dernière synchronisation (logo, popups,
documents...). On les rapatrie **sans écraser** les versions compressées :

```bash
# Ne copie que les fichiers absents du nouveau site
cp -rn ~/public_html/frontend/assets/images/. ~/sofifran/public/frontend/assets/images/ 2>/dev/null
cp -rn ~/public_html/frontend/assets/docs/.   ~/sofifran/public/frontend/assets/docs/   2>/dev/null
cp -rn ~/public_html/frontend/assets/file_upload_compose/. ~/sofifran/public/frontend/assets/file_upload_compose/ 2>/dev/null
```

*(adapter `~/public_html/...` si l'ancien site est ailleurs — chercher le
dossier qui contient `frontend/assets/images`)*

---

## 4. Configurer le .env de production

```bash
cd ~/sofifran
cp .env.example .env
nano .env
```

Valeurs à renseigner :

```ini
APP_NAME=Sofifran
APP_ENV=production
APP_DEBUG=false
APP_URL=https://sofifran.org
APP_LOCALE=fr

LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=***nom de la base***
DB_USERNAME=***utilisateur***
DB_PASSWORD=***mot de passe***

SESSION_SECURE_COOKIE=true

MAIL_MAILER=smtp
MAIL_HOST=***serveur mail PlanetHoster (ex: mail.sofifran.org)***
MAIL_PORT=465
MAIL_SCHEME=smtps
MAIL_USERNAME=info@sofifran.org
MAIL_PASSWORD=***mot de passe du compte mail***
MAIL_FROM_ADDRESS="info@sofifran.org"
MAIL_FROM_NAME="Sofifran"
```

Puis générer la clé d'application :

```bash
php artisan key:generate --force
```

---

## 5. Déployer

```bash
cd ~/sofifran
bash deploy.sh
```

Le script enchaîne : dépendances Composer (production), **migrations**
(colonne type des publications + reprise des 34 PDF, table visites,
lien des popups, sections À propos, normalisation des bannières),
caches Laravel, variantes WebP, lien storage.

> Si `composer` n'est pas trouvé : `php -r "copy('https://getcomposer.org/installer','c.php');" && php c.php && alias composer="php ~/sofifran/composer.phar"`

---

## 6. Pointer le domaine vers le nouveau site

**Option A (recommandée)** — panneau N0C → *Domaines* → sofifran.org →
modifier le dossier racine vers : `sofifran/public`
→ sécurité maximale (le `.env` et le code sortent de la zone web).

**Option B (comme l'ancien site)** — remplacer le contenu de `public_html`
par celui du projet :

```bash
mv ~/public_html ~/public_html_ancien
mv ~/sofifran ~/public_html
```

puis vérifier que le `.htaccess` racine (fourni) redirige bien vers `public/`.

---

## 7. Vérifications après mise en ligne

- [ ] Accueil : s'affiche, popup, évènements, compteurs réels
- [ ] `https://sofifran.org/admin-sofifran/login` : connexion admin OK
- [ ] **Changer les mots de passe des 3 comptes admin** (l'ancien dump a circulé)
- [ ] Formulaire de contact : envoyer un test → email reçu sur info@sofifran.org
- [ ] Inscription infolettre (pied de page) → apparaît dans Admin → Newsletters
- [ ] Une page galerie : les images se chargent (F12 → onglet Réseau :
      les images doivent répondre en `image/webp` sur Chrome)
- [ ] Admin → Statistiques de visites : les visites s'enregistrent
- [ ] Modifier une bannière dans l'admin → la page publique change

---

## 8. Mises à jour futures

```bash
cd ~/sofifran     # (ou ~/public_html selon l'option choisie)
git pull origin main
bash deploy.sh
```

## En cas de problème

- Page blanche / erreur 500 : consulter `storage/logs/laravel.log`
- Ne JAMAIS mettre `APP_DEBUG=true` en production plus de quelques minutes
- Retour arrière : restaurer la sauvegarde de l'étape 1
