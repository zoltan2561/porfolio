# Papp Zoltan Portfolio

Laravel 12-re átemelt kétnyelvű portfólióoldal, matrixos vizuális stílussal, külön szakmai háttér oldallal, kapcsolatfelvételi űrlappal és egyszerű látogatói statisztikával.

## Fő részek

- `routes/web.php`: home, skills és contact route-ok
- `app/Http/Controllers/PortfolioController.php`: oldaladatok, locale-kezelés, schema/meta
- `app/Http/Controllers/ContactController.php`: kapcsolatfelvételi űrlap validáció és küldés
- `app/Services/VisitorCounter.php`: JSON-alapú napi egyedi látogatószámlálás
- `resources/views/layouts/portfolio.blade.php`: közös layout
- `resources/views/portfolio/*.blade.php`: főoldal és skills oldal
- `config/portfolio.php`: kétnyelvű tartalomforrás
- `public/`: statikus assetek

## Futtatás

### Laravel dev server

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan serve
```

### XAMPP alatt

Az alkalmazás gyökérben kapott egy `.htaccess` átirányítást, ami a Laravel `public` mappába küldi a kéréseket, így helyben XAMPP alatt is egyszerűbben használható.

## Mail beállítás

Az űrlap Laravel Mailt használ. A legfontosabb `.env` kulcsok:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=465
MAIL_SCHEME=smtps
MAIL_USERNAME=your-user
MAIL_PASSWORD=your-password
MAIL_FROM_ADDRESS=no-reply@example.com
MAIL_FROM_NAME="Papp Zoltan Portfolio"
CONTACT_RECIPIENT_ADDRESS="melo@pzoli.com"
CONTACT_RECIPIENT_NAME="Papp Zoltan"
```

Ha a `CONTACT_RECIPIENT_*` nincs beállítva, az oldal a publikus portfóliós e-mail címre próbál küldeni.

## Statisztika

A látogatói statisztika a `storage/app/stats` mappába ír:

- `ip_log.json`
- `counter_daily.json`

Bot user-agenteket kiszűri, és 24 órán belül IP-nként csak egyszer számol.
