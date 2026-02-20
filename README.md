# Inspectra API

A RESTful API for managing inspection workflows — from reference data setup to creating, updating, and reviewing inspections with item lots and charges.

Built with **Laravel 12**, following **Domain-Driven Design (DDD)** principles.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| PHP | ^8.2 |
| Architecture | Domain-Driven Design (DDD) via `lunarstorm/laravel-ddd` |
| Data Objects | `spatie/laravel-data` |
| Excel Import | `maatwebsite/excel` |
| Database | PostgreSQL |

---

## Prerequisites

- PHP ^8.2
- Composer
- PostgreSQL

---

## Quickstart (Local)

### 1. Clone and enter the project
```bash
git clone https://github.com/urfanlaode/inspectra-api
cd inspectra-api
```

### 2. Install dependencies
```bash
composer install
npm install
```

### 3. Environment setup
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inspectra_db
DB_USERNAME=root
DB_PASSWORD=password
```

### 4. Run migrations
```bash
php artisan migrate
```

### 5. Serve locally
```bash
php artisan serve
# API available at: http://127.0.0.1:8000/api/v1
```

### One-liner setup (via Composer script)
```bash
composer setup
```

---

## Development

Start all services (server, queue, logs, Vite) concurrently:

```bash
composer dev
```

This starts:
- `php artisan serve` — Laravel dev server
- `php artisan queue:listen` — Queue worker

---

## Running Tests 

(WIP)

---

## Project Structure

The project follows a DDD-inspired layout with domain logic separated from the HTTP layer:

```
inspectra-api/
├── app/
│   ├── Http/
│   │   └── Responses/       # ApiResponse helper
│   ├── Modules/             # HTTP layer
│   │   ├── Inspection/
│   │   └── Reference/
│   └── Providers/
├── src/
│   └── Domain/              # Core domain
│       ├── Inspection/      # Models, Services, Repositories, Data, Enums
│       ├── Reference/       # Models, Services, Repositories, Imports, Jobs
│       ├── Shared/          # Shared enums and data objects
├── routes/
│   ├── api.php
│   └── v1/
│       ├── inspection.php
│       └── reference.php
└── database/
    └── migrations/
```

---

## Domain Overview


#### Inspection Status Flow
```
NEW
 |
DRAFT
 |
READY_FOR_REVIEW
 |
COMPLETED (TBC)
```

Inspections with status `draft` or `new` are editable.

---

## API Reference

All endpoints are prefixed with `/api/v1/`.

### Reference Endpoints

`GET /api/v1/reference/dropdowns` - Get all dropdown reference data (service types, scope of works, etc.)
`GET /api/v1/reference/lots` - Get all lots
`GET /api/v1/reference/items` - Get all items
`POST /api/v1/reference/imports` - Bulk import reference data from Excel

### Inspection Endpoints

`GET /api/v1/inspections` - List all inspections (with lots)
`GET /api/v1/inspections/{id}` - Get a single inspection with lots
`POST /api/v1/inspections` - Create a new inspection
`PUT /api/v1/inspections/{id}` - Update an existing inspection

---

## API Conventions

### Success Response

```json
{
  "ok": true,
  "timestamp": "2026-02-16T12:00:00Z",
  "message": "Inspections retrieved successfully",
  "data": [ ... ],
  "meta": {
    "page": 1,
    "limit": 15,
    "next": 2,
    "prev": null
  }
}
```

### Error Response

```json
{
  "ok": false,
  "timestamp": "2026-02-16T12:00:00Z",
  "message": "Validation failed",
  "errors": {
    "email": ["The email field is required."]
  },
  "error_code": "validation_error"
}
```

## Bulk Import (Excel)

Reference data can be bulk-imported via the `POST /api/v1/reference/imports` endpoint. An example Excel template is available at `storage/app/private/imports/reference.xlsx`.

The import is processed asynchronously via a queued job (`ImportJob`). Make sure the queue worker is running:

```bash
php artisan queue:listen
```

---

## DDD Tooling (Lunarstorm)

This project uses `lunarstorm/laravel-ddd` to scaffold domain artifacts. Run the installer once after first cloning:

```bash
php artisan ddd:install --no-interaction
php artisan ddd:config wizard --no-interaction
```

To generate a new domain model or service:

```bash
php artisan ddd:model YourDomain YourModel
php artisan ddd:service YourDomain YourService
```

---

## Author

**Urfan** — [@urfanlaode](https://github.com/urfanlaode)

---

## License

MIT
