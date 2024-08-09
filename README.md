# Holiday Plans

This API allows users to manage their holiday plans and download them as PDFs.
---

## Requirements

- PHP 8.2^
- Composer 2.7^
- Docker (with start from sail)

## Summary

1. **[Installation](#1-installation)**
2. **[Usage](#2-usage)**
---

## 1. Installation

- **[Local](#local)**
- **[Using Laravel Sail (Docker)](#using-laravel-sail-docker)**
---

### Local

1. Clone this repository.

```bash
git clone https://github.com/VitorNuness/holiday-plans.git holiday-plans
```

2. Access the application folder and install dependencies.

```bash
cd holiday-plans
composer install
```

3. Define environment variables.

```bash
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=holiday_plans
DB_USERNAME=<your_username>
DB_PASSWORD=<your_password>
```

4. Run migrations and generate keys (application and JWT).

```bash
php artisan migrate
php artisan key:generate
php artisan jwt:secret
```

5. Start the local server.

```bash
php artisan serve
```
---

### Using Laravel Sail (Docker)

1. Clone this repository.

```bash
git clone https://github.com/VitorNuness/holiday-plans.git holiday-plans
```

2. Access the application folder and install dependencies.

```bash
cd holiday-plans
composer install
```

3. Define environment variables and generate keys (application ans JWT).

```bash
cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=holiday_plans
DB_USERNAME=<your_username>
DB_PASSWORD=<your_password>

php artisan key:generate
php artisan jwt:secret
```

4. Start the container and run migrations.

```bash
./vendor/bin/sail up
./vendor/bin/sail artisan migrate
```
---

## 2. Usage

This application is a API RESTful to make CRUD operations for user holiday plans.
---

### Authentication Endpoints

1. Register a new user.

- **URI**: /api/auth/register

- **Method**: POST

**Request**
```json
{
    "name": string,
    "email": string,
    "password": date,
    "password_confirmation": string
}
```

**Response**
```json
{
    "token": string
}
```

2. User login.

- **URI**: /api/auth/login

- **Method**: POST

**Request**
```json
{
    "email": string,
    "password": string
}
```

**Response**
```json
{
    "token": string
}
```
---

### Holiday Plans Endpoints

To access this Holiday Plans methods the user has been authenticated and has the plan owner.

The methods is necessary the header has: ```'Authorization': Bearer <token>```.

1. Create a new Holiday Plan.

- **URI**: /api/plans/new

- **Method**: POST

**Request**
```json
{
    "title": string,
    "description": string,
    "date": date,
    "location": string,
    "participants": array
}
```

**Response**
```json
{
    "id": string,
    "title": string,
    "description": string,
    "date": date,
    "location": string,
    "participants": array,
    "user_id": string,
    "created_at": timestamp,
    "updated_at": timestamp
}
```

2. Retrieve all holiday plans paginated.

- **URI**: /api/plans

- **Method**: GET

**Response**
```json
{
    "current_page": int,
    "data": [
        {
        "id": string,
        "title": string,
        "description": string,
        "date": date,
        "location": string,
        "participants": array,
        "user_id": string,
        "created_at": timestamp,
        "updated_at": timestamp
        }
    ],
    "first_page_url": string,
    "from": string,
    "last_page": int,
    "last_page_url": string,
    "links": [
        {
        "url": string,
        "label": string,
        "active": boolean
        },
        {
        "url": string,
        "label": string,
        "active": boolean
        },
        {
        "url": string,
        "label": string,
        "active": boolean
        }
    ],
    "next_page_url": string,
    "path": string,
    "per_page": int,
    "prev_page_url": string,
    "to": string,
    "total": int
}
```

3. Get a specific holiday plan.

- **URI**: /api/plans/{int}

- **Method**: GET

**Response**
```json
{
    "id": string,
    "title": string,
    "description": string,
    "date": date,
    "location": string,
    "participants": array,
    "user_id": string,
    "created_at": timestamp,
    "updated_at": timestamp
}
```

4. Update a specific holiday plan.

- **URI**: /api/plans/{int}/update

- **Method**: PUT

**Request**
```json
{
    "title": string,
    "description": string,
    "date": date,
    "location": string,
    "participants": array
}
```

**Response**
```json
{
    "id": string,
    "title": string,
    "description": string,
    "date": date,
    "location": string,
    "participants": array,
    "user_id": string,
    "created_at": timestamp,
    "updated_at": timestamp
}
```

4. Delete a specific holiday plan.

- **URI**: /api/plans/{int}/delete

- **Method**: DELETE

**Response**
```json
{
    
}
```

5. Download the holiday plan information in PDF format.

- **URI**: /api/plans/{int}/pdf

- **Method**: GET

A file 'holiday_plan.pdf' start download.
