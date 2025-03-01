## Requirements
- PHP ^8.2
- Composer ^2.8.5
- Node ^18.0
- NPM ^10
- Laravel ^10.0
- Local server (Laravel Herd, XAMPP, or etc.) `in here i use nginx version 1.24`

## Installations

- Clone the repository.

- Copy `env.example` and rename this to `.env`.

- Run command

```bash
php artisan key:generate
```

- Change part `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` based on your database.

- Run command

```bash
composer install
```

- After finished, install the package of `node_modules` using this command

```bash
npm install
```

- Run the migration and seeder using this command (It will create admin with email: admin@mail.com and password: password)

```bash
php artisan migrate --seed
```
- Run `php artisan serve` (or based on your local serve) and run `npm run dev`

## Running Test

```bash
php artisan test
```
