# Bella Pilates Backend API

Backend REST API for **Bella Pilates**, a complete Pilates studio management platform developed with Laravel.

## Overview

This API provides all backend functionality required by the Bella Pilates web application, including authentication, user management, class scheduling, reservations, recorded classes, payments, favorites, contact messages, and administrative tools.

## Features

### Authentication & Security

* Laravel Sanctum authentication
* Token-based API access
* Role-based authorization
* Password management
* Protected admin routes

### User Features

* User authentication
* Profile management
* Password change
* Class reservations
* Reservation cancellation
* Recorded classes access
* Favorites management
* Contact messages

### Admin Features

* User management
* Classes management
* Schedule management
* Reservation management
* Recorded classes management
* Payment management
* Contact messages management
* Business settings management
* Room management

## Technology Stack

* Laravel 12
* PHP 8+
* Laravel Sanctum
* MySQL
* REST API Architecture
* Eloquent ORM

## Main Modules

### Public Endpoints

* Login
* Classes
* Schedules
* Recorded Classes
* Business Settings
* Contact Messages

### User Endpoints

* User Profile
* Change Password
* Reservations
* Favorites

### Admin Endpoints

* Users
* Classes
* Rooms
* Schedules
* Reservations
* Recorded Classes
* Payments
* Messages
* Settings

## Database

Main entities:

* Users
* Classes
* Rooms
* Schedules
* Reservations
* Recorded Classes
* Favorites
* Payments
* Messages
* Settings

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

## Environment Variables

Configure your `.env` file before running the application.

Required configuration:

```env
APP_NAME=BellaPilates
APP_ENV=local

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bella_pilates
DB_USERNAME=root
DB_PASSWORD=
```

## API Base URL

```txt
http://localhost:8000/api
```

## Project Status

Version: 1.0

Current status:

* Authentication completed
* User panel API completed
* Admin panel API completed
* Reservation system completed
* Recorded classes completed
* Favorites system completed
* Contact messages completed
* Payments module completed
* Ready for production improvements and deployment

## Author

Annabella Linares Molina

Developed as a Full Stack Web Application project using Laravel and React.
