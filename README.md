<h1 align="center">
  Laravel to-do list
</h1>

<p align="center">
  :clipboard: to-do list with authentication using Laravel 7 framework applying feature tests.
</p>

<p align="center">
  <a href="https://github.com/dyarleniber/laravel-to-do-list/actions?query=workflow%3ACI">
    <img alt="CI" src="https://github.com/dyarleniber/laravel-to-do-list/workflows/CI/badge.svg">
  </a>
  <a href="https://github.com/dyarleniber/laravel-to-do-list/blob/master/LICENSE">
    <img alt="License" src="https://img.shields.io/github/license/dyarleniber/laravel-to-do-list?label=license">
  </a>
</p>

<p align="center">
  <a href="#gear-configuration">Configuration</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#memo-license">License</a>
</p>

to-do list with authentication using [Laravel framework](https://laravel.com). This application allows you create new users, log in, log out and reset passwords. The entire authentication system was built using the authentication scaffolding provided by the Laravel framework. Each user can create, retrieve, update and delete tasks. A user cannot view or modify other users' tasks.

The PHP/Laravel development environment was set up with [PHP-FPM](https://php-fpm.org), [Nginx](https://www.nginx.com) and [MySQL](https://www.mysql.com) using [Docker](https://www.docker.com) and [Docker Compose](https://docs.docker.com/compose). For more details about the environment, [access this repository](https://github.com/dyarleniber/laravel7-docker).

These are the routes of the application:

Method    | URI
---       | ---
`GET`     | `/`
`GET`     | `/login`
`POST`    | `/login`
`POST`    | `/logout`
`POST`    | `/password/confirm`
`GET`     | `/password/confirm`
`POST`    | `/password/email`
`POST`    | `/password/reset`
`GET`     | `/password/reset`
`GET`     | `/password/reset/{token}`
`POST`    | `/register`
`GET`     | `/register`
`GET`     | `/tasks`
`POST`    | `/tasks`
`GET`     | `/tasks/create`
`GET`     | `/tasks/{id}`
`PUT`     | `/tasks/{id}`
`DELETE`  | `/tasks/{id}`
`POST`    | `/tasks/{id}`
`GET`     | `/tasks/{id}/edit`

For the views, the Blade template engine provided with Laravel was used. No front-end framework was used, just pure HTML5 and CSS3. The assets are compiled through [Laravel Mix](https://github.com/JeffreyWay/laravel-mix), which provides an API for defining Webpack build steps for the application.

The code base is covered by automated tests with [PHPUnit](https://phpunit.de/) and all the methods provided by the Laravel framework.

A CI workflow created on [GitHub Actions](https://github.com/features/actions) is responsible for automatically set up the environment and test the source code. All these jobs are activated by a push or pull request event on master branch.

## :gear: Configuration

To clone and run this application, you’ll need to have [Git](https://git-scm.com), [Docker](https://www.docker.com) and [Docker Compose](https://docs.docker.com/compose) installed on your computer.

From your command line:

```bash
# Clone this repository
$ git clone https://github.com/dyarleniber/laravel-to-do-list.git

# Go into the repository folder
$ cd laravel-to-do-list

# Create a new .env file based on .env.example
$ cp .env.example .env

# Optionally, you can set new database environment variables
# But with the variables within the .env.example file should work

# Build the app image and run the environment in background mode:
$ docker-compose up -d

# Install the application dependencies
# The Composer commmand will be executed in the "app" service container:
$ docker-compose exec app composer install

# Generate a unique application key with the artisan Laravel command-line tool
# This key is used to encrypt user sessions and other sensitive data:
$ docker-compose exec app php artisan key:generate

# Run the migrations
$ docker-compose exec app php artisan migrate

# Now go to your browser and access your server’s domain name or IP address on port 8000
# In case you are running on your local machine, use http://localhost:8000
```

In addition to the PHPUnit command, you may use the test artisan Laravel command-line to run the tests:

```bash
$ docker-compose exec app php artisan test
```

## :memo: License

This project is under the MIT license. See the [LICENSE](https://github.com/dyarleniber/laravel-to-do-list/blob/master/LICENSE) for more information.

---

Made with ♥ by Dyarlen Iber :wave: [Get in touch!](https://dyarleniber.com)
