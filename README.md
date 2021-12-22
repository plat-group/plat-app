# Plats ecosystem

## Preparation

- PHP 8.x
- MySQL 8.x
- Apache2
- Composer 2.x
- Node 16.13.x
- Npm 8.1.x

## Installation

1. Pull source code from github
Move to project directory

`cd path_of_project`

2. Setting local environment config

`cp .env.example .env`

edit file .env as other project (project name, database connection, logs, etc) and save it

3. Update all dependency

`composer update`

4. Generate key

`php artisan key:generate`

5. Create table of database

`php artisan migrate --seed`

6. Install node module

`npm i`

7. Build frontend (vuejs)

### For development

`npm run dev`

### For Production
`npm run prod`

8. Run laravel build-in server and access to page

`php artisan serve`
