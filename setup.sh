#!/bin/bash

# Copy environment file
cp .env.example .env

# Install dependencies
composer install
npm install

# Generate application key
php artisan key:generate

# Create database file
touch database/database.sqlite

# Run migrations and seeders
php artisan migrate:fresh --seed

# Build assets
npm run build

echo "Setup completed! You can now run the application with:"
echo "php artisan serve" 