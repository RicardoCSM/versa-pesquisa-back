# Versa Pesquisa Back

Versa Pesquisa Back is the backend REST API for the Versa Pesquisa application, designed to handle the submission and response of surveys. This backend was developed as part of Sprint 8 during my internship.

----------

# Getting started

## Installation

Versa Pesquisa Back is developed using Yii 2.0, a PHP framework for web applications, and utilizes Docker for easy deployment.

### Prerequisites

- Docker
- Docker Compose

### Cloning the repository

```shell
git clone git@github.com:RicardoCSM/versa-pesquisa-back.git
cd versa-pesquisa-back
```

### Environment setup

Create a copy of the .env.example file and name it .env. Fill in the necessary environment variables:

```shell
MYSQL_ROOT_PASSWORD=your_root_password
MYSQL_HOST=db
MYSQL_DATABASE=your_database_name
MYSQL_USER=your_database_user
MYSQL_PASSWORD=your_database_password
```

### Build and run the Docker containers:

```shell
docker-compose up -d
```

### Install Composer dependencies:

```shell
docker-compose exec php composer install
```

### Run migrations:

```shell
docker-compose exec php php yii migrate
```

The API should now be accessible at [http://localhost:8000](http://localhost:8000).

## Folders

- `config/web` - Contains route definitions with all API endpoints
- `models` - General models
- `models/query` - Models ActiveQuery
- `migrations` - Database migrations
- `module/api` - API module
- - `models` - Models specific to the API module
- - `controllers` - Controllers specific to the API module
- - `resources` - Resources specific to the API module

## Docker Compose

The application utilizes Docker for easy deployment. The docker-compose.yml file is configured with the necessary services:

- `php` - PHP service with Yii 2.0 and Apache
- `db` - MariaDB service for the database
- `phpmyadmin` - PhpMyAdmin for database administration, you can access PhpMyAdmin at [http://localhost:8080](http://localhost:8080) with the credentials specified in the .env file.
