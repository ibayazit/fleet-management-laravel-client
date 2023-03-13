## Fleet Management Client

#### Installation & Serve
```bash
composer install

# Copy .env.example to .env and change FLEET_SERVICE_URL
cp .env.example .env
php artisan key:generate

# Generate Swagger
php artisan l5-swagger:generate

# Serve
php artisan serve
```

[Fleet Management App](https://github.com/ibayazit/fleet-management)