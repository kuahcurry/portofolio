# Portfolio — Laravel 13

[![CI](https://github.com/kuahcurry/portofolio/actions/workflows/ci.yml/badge.svg)](https://github.com/kuahcurry/portofolio/actions/workflows/ci.yml)
[![PHP](https://img.shields.io/badge/PHP-8.3-blue?logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13-red?logo=laravel)](https://laravel.com/)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

A personal portfolio application built with **Laravel** and **Tailwind CSS**, featuring a public portfolio page, an admin management console, a versioned **REST API**, and a **system health dashboard**.

## Features

- **Public portfolio** — bio, education, experience, projects, skills, and contact sections with EN/ID localisation (`/`)
- **Admin console** — manage profile, projects, experience, education, skills, and contact messages (`/manage`)
- **REST API v1** — read-only JSON endpoints for all portfolio resources (`/api/v1/...`)
- **Interactive API docs** — Scalar UI with downloadable OpenAPI spec (`/api/docs`, `/api/v1/openapi.json`)
- **System health** — service status dashboard and JSON health endpoint (`/status`, `/status/json`)

## Requirements

- PHP 8.3+
- Composer 2
- Node.js 18+ (for frontend assets)
- SQLite (default) or MySQL/PostgreSQL

## Quick start

```bash
composer setup        # install deps, copy .env, migrate, build assets
php artisan serve     # http://localhost:8000
```

Seeded admin login: `admin@portfolio.local` / `admin12345` (see `database/seeders/PortfolioSeeder.php`).

## API overview

| Method | Endpoint              | Description            |
| ------ | --------------------- | ---------------------- |
| GET    | `/api/v1/profile`     | Public profile         |
| GET    | `/api/v1/projects`    | Project list           |
| GET    | `/api/v1/skills`      | Skill list             |
| GET    | `/api/v1/experiences` | Work experience list   |
| GET    | `/api/v1/education`   | Education history list |

All endpoints are throttled (60 req/min) and support `?lang=en|id` for translated fields.

## Quality gates

This repo ships a GitHub Actions workflow (`.github/workflows/ci.yml`) that runs on every push/PR to `main`:

1. **Pint** — Laravel code style (`composer lint`)
2. **PHPStan + Larastan (Level 5)** — static analysis (`composer analyse`)
3. **PHPUnit** — full test suite (`php artisan test`)

Run all three locally with a single command:

```bash
composer ci
```

Style and analysis configs live in `pint.json` and `phpstan.neon`.
