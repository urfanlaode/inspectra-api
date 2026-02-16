# Inspectra API

This is the API for Inspectra, a tool for inspecting and analyzing data.

## Prerequisites
- PHP ^8.2

## Quickstart (local)
1. Clone and enter the project
   - git clone

2. Install PHP dependencies
```bash
composer install
```

3. Environment
```bash
cp .env.example .env
php artisan key:generate
# update DB credentials in .env
```

4. Run migrations
```bash
php artisan migrate
```

5. Serve locally
```bash
php artisan serve
# Open: http://127.0.0.1:8000/api/v1
```

## Development notes

- DDD tooling
  - Lunarstorm (`lunarstorm/laravel-ddd`) is used to scaffold domain artifacts. Run the installer once:
```bash
php artisan ddd:install --no-interaction
php artisan ddd:config wizard --no-interaction
```

## API conventions

- Versioned routes: `/api/v1/...`
- Standard JSON success shape:
```json
{
  "ok": true,
  "timestamp": "2026-02-16T12:00:00Z",
  "message": "Users retrieved",
  "data": [ ... ],
  "meta": { "page": 1, "limit": 15, "next": 2, "prev": null }
}
```
- Standard JSON error shape:
```json
{
  "ok": false,
  "timestamp": "2026-02-16T12:00:00Z",
  "message": "Validation failed",
  "errors": { "email": ["The email field is required."] },
  "error_code": "validation_error"
}
```

## Author
- Urfan — https://github.com/urfanlaode

License
- MIT
