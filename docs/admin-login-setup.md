# Admin Login Systeem Setup

## Overzicht

Het admin login systeem is geïmplementeerd met verbeterde beveiliging, logging en gebruikerservaring. Hier zijn de belangrijkste kenmerken:

### Beveiligingsfuncties
- **Role-based toegangscontrole**: Alleen gebruikers met `role = 'admin'` kunnen admin pagina's benaderen
- **Rate limiting**: Admin login pogingen zijn beperkt tot 3 pogingen per 15 minuten
- **Account status controle**: Gedeactiveerde admin accounts kunnen niet inloggen
- **Admin logging**: Alle admin acties worden gelogd voor beveiliging
- **IP tracking**: Admin acties worden gelogd met IP adres

### Verbeteringen
- **Betere middleware**: AdminMiddleware controleert zowel `role` als `user_type`
- **Echte gebruikersgegevens**: AdminDashboard toont echte gebruikersinformatie
- **Comprehensive tests**: Volledige test suite voor admin functionaliteit
- **Admin settings**: Configureerbare admin instellingen

## Setup Instructies

### 1. Database Migratie
```bash
php artisan migrate:fresh
```

### 2. Admin Gebruiker Aanmaken
```bash
php create-admin-user.php
```

Of via de seeder:
```bash
php artisan db:seed --class=AdminSeeder
```

### 3. Admin Settings Aanmaken
```bash
php artisan db:seed --class=AdminSettingsSeeder
```

## Admin Gebruikers

### Standaard Admin Account
- **Email**: admin@example.com
- **Password**: Admin123!@#
- **Role**: admin

### Test Admin Account
- **Email**: zerouali.amine2005@gmail.com
- **Password**: Maissae123/
- **Role**: admin

## Admin Routes

### Beveiligde Admin Routes
Alle admin routes zijn beveiligd met de `admin` middleware:

- `/admin/dashboard` - Admin dashboard
- `/admin/users` - Gebruikersbeheer
- `/admin/companies` - Bedrijvenbeheer
- `/admin/events` - Evenementenbeheer
- `/admin/applications` - Sollicitatiesbeheer
- `/admin/settings` - Admin instellingen
- `/admin/profile` - Admin profiel

### Middleware
```php
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes hier
});
```

## Admin Logging

Alle admin acties worden automatisch gelogd in de `admin_logs` tabel:

### Gelogde Acties
- `admin_login` - Succesvolle admin login
- `admin_logout` - Admin logout
- `admin_access` - Toegang tot admin pagina's
- `unauthorized_access_attempt` - Ongeautoriseerde toegangspogingen

### Log Details
- Admin ID
- Actie type
- Timestamp
- IP adres
- User agent
- URL (voor toegangspogingen)

## Tests

### Admin Login Tests
```bash
php artisan test --filter=AdminLoginTest
```

### Test Cases
- Admin kan inloggen met geldige credentials
- Admin kan niet inloggen met ongeldige credentials
- Gedeactiveerde admin kan niet inloggen
- Niet-admin gebruikers kunnen geen admin dashboard benaderen
- Admin login/logout wordt gelogd

## Beveiligingsaanbevelingen

### 1. Sterke Wachtwoorden
Zorg ervoor dat admin accounts sterke wachtwoorden hebben:
- Minimaal 8 karakters
- Combinatie van hoofdletters, kleine letters, cijfers en symbolen
- Geen voorspelbare patronen

### 2. Twee-Factor Authenticatie
Overweeg het implementeren van 2FA voor admin accounts.

### 3. IP Whitelisting
Overweeg IP whitelisting voor admin toegang in productie.

### 4. Regelmatige Log Reviews
Controleer regelmatig de admin logs op verdachte activiteit.

### 5. Account Monitoring
Monitor admin account activiteit en stel alerts in voor verdachte patronen.

## Troubleshooting

### Admin Kan Niet Inloggen
1. Controleer of het account `is_active = true` heeft
2. Controleer of `role = 'admin'` is ingesteld
3. Controleer of het wachtwoord correct is
4. Controleer rate limiting (max 3 pogingen per 15 minuten)

### Admin Dashboard Niet Toegankelijk
1. Controleer of de gebruiker is ingelogd
2. Controleer of de gebruiker admin rechten heeft
3. Controleer de admin middleware configuratie
4. Controleer de routes configuratie

### Admin Logs Niet Werken
1. Controleer of de `admin_logs` tabel bestaat
2. Controleer of de AdminLog model correct is geconfigureerd
3. Controleer database connectie

## Configuratie

### Admin Settings
Admin instellingen kunnen worden geconfigureerd via de `admin_settings` tabel:

```php
// Instelling ophalen
$siteName = AdminSetting::getValue('site_name', 'Default Site Name');

// Instelling wijzigen
AdminSetting::setValue('maintenance_mode', 'on');
```

### Rate Limiting Aanpassen
Rate limiting kan worden aangepast in `app/Http/Requests/Auth/LoginRequest.php`:

```php
private function isAdminLoginAttempt(): bool
{
    $adminEmails = ['admin@example.com', 'zerouali.amine2005@gmail.com'];
    return in_array($this->email, $adminEmails);
}
```

## Support

Voor vragen of problemen met het admin login systeem, neem contact op met het development team. 