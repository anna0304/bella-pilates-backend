# Bella Pilates Backend API

Backend API for Bella Pilates built with Laravel.

## Features

* Authentication with Laravel Sanctum
* Role-based access (admin / user)
* Classes management
* Schedules management
* Reservations system
* Recorded classes
* Favorites system
* Plans management
* Payments management
* Contact messages
* Business settings

## Tech Stack

* Laravel
* Sanctum Authentication
* MySQL
* REST API
* Postman

## API Modules

### Public

* Login
* Classes
* Schedules
* Recorded classes
* Settings
* Contact messages

### User

* My reservations
* Favorites
* Change password

### Admin

* Users management
* Classes CRUD
* Schedules CRUD
* Reservations management
* Recorded classes CRUD
* Plans management
* Payments management
* Messages management
* Settings management

## Installation

```bash
git clone https://github.com/anna0304/bella-pilates-backend.git
cd bella-pilates-backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Status

Backend completed and ready for frontend integration.
