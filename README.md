# Applicant Management API

A simple REST API for managing job applicants, built with Laravel and SQLite.

This project was developed as part of the **Backend Engineer Mini Project – Sekolah Karir Batch 2**.

## Features

- Create a new applicant
- Retrieve all applicants
- Update an applicant's recruitment stage
- Validate applicant input
- Prevent duplicate email addresses
- Handle requests for nonexistent applicants
- Automated API testing

## Tech Stack

- PHP 8.4
- Laravel 13
- SQLite
- PHPUnit

## Project Structure

```text
app/
├── Http/
│   ├── Controllers/
│   │   └── ApplicantController.php
│   └── Requests/
│       ├── StoreApplicantRequest.php
│       └── UpdateApplicantStageRequest.php
└── Models/
    └── Applicant.php

database/
└── migrations/

routes/
└── api.php

tests/
└── Feature/
    └── ApplicantApiTest.php
```

## Requirements

- PHP 8.3 or newer
- Composer
- SQLite

## Installation

Clone the repository:

```bash
git clone <YOUR_REPOSITORY_URL>
cd UntaraEkaSaputra_BackEndEngineer_SKBatch2
```

Install dependencies:

```bash
composer install
```

Create the environment file:

```bash
cp .env.example .env
php artisan key:generate
```

Configure SQLite in `.env`:

```env
DB_CONNECTION=sqlite
```

Create the SQLite database:

```bash
touch database/database.sqlite
```

Ensure `DB_DATABASE` in `.env` points to the SQLite database file, or remove that setting to use Laravel's default `database/database.sqlite` path.

Run migrations:

```bash
php artisan migrate
```

Start the development server:

```bash
php artisan serve
```

The API will be available at:

```text
http://127.0.0.1:8000
```

## API Endpoints

| Method | Endpoint                     | Description             |
| ------ | ---------------------------- | ----------------------- |
| POST   | `/api/applicants`            | Create an applicant     |
| GET    | `/api/applicants`            | Retrieve all applicants |
| PATCH  | `/api/applicants/{id}/stage` | Update applicant stage  |

See [API Documentation](docs/API.md) for request examples, response formats, and validation rules.

## Applicant Stages

Available recruitment stages:

- `applied`
- `screening`
- `interview`
- `offered`
- `hired`
- `rejected`

The default stage for newly created applicants is `applied`.

## Running Tests

Run the automated test suite:

```bash
php artisan test
```

The feature tests cover applicant creation, listing, stage updates, input validation, duplicate email prevention, and not-found handling.

## AI Usage

AI tools were used as development assistance for project planning, implementation guidance, code review, debugging, and documentation.

All implementation and testing decisions were reviewed and verified by the developer.

See [AI Usage Notes](AI_USAGE.md) for more details.

## Author

**Untara Eka Saputra**

Backend Engineer Mini Project – Sekolah Karir Batch 2
