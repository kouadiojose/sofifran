#!/bin/bash
# =============================================================
# Script de deploiement Sofifran
# A executer sur le serveur apres chaque `git pull` :
#   bash deploy.sh
# =============================================================
set -e

echo "1/5 Dependances (production, sans paquets de dev)..."
composer install --no-dev --optimize-autoloader --no-interaction

echo "2/5 Migrations..."
php artisan migrate --force

echo "3/5 Nettoyage des anciens caches..."
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

echo "4/5 Caches de production (config + routes + vues precompilees)..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "5/5 Lien storage (sans erreur s'il existe deja)..."
php artisan storage:link 2>/dev/null || true

echo ""
echo "Deploiement termine."
echo "Rappel .env production : APP_ENV=production, APP_DEBUG=false, SESSION_SECURE_COOKIE=true"
