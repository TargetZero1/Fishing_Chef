# Fishing Chef - Steampunk Calendar (Laravel + Tailwind)

This repository now contains a Laravel (11+) style steampunk calendar dashboard built with Tailwind CSS.

## Included implementation

- **Option C (Book Calendar)** with a full monthly grid
- Day labels in the requested format: **M S S R K J S**
- Decorative crest, ornate borders, and parchment-like panel styling
- Dynamic customization through query/form controls:
  - month and year
  - title and descriptive text
  - palette and font style

## Run locally

> Note: this environment blocked GitHub-authenticated Composer package downloads, but these are the expected local steps.

1. Install dependencies:

```bash
composer install
npm install
```

2. Initialize app:

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
```

3. Start development servers:

```bash
composer run dev
```

4. Open:

- `http://127.0.0.1:8000`

## Calendar navigation/customization

- Main dashboard route: `/`
- Change month/year using controls in the dashboard
- Use **Prev/Next** controls to switch months
- Change palette and font from the customization panel
