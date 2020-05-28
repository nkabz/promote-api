<p align="center"><img src="https://i.ibb.co/MpzgQsC/Screenshot-from-2020-05-28-02-26-23.png" width="400"></p>

## Promote API Challenge :star:

Set up and develop an API as specified.

# Table of contents

* [Checklist](https://github.com/nkabz/promote-api/issues/1)
* [API Documentation](https://documenter.getpostman.com/view/11411942/SztD4SkP?version=latest) 
* [Setup](#setup)
* [Requirements](#requirements)
# Setup

1. Clone the repository

```sh
git clone git@github.com:nkabz/promote-api.git
```

2. Setup .env file

```sh
cp .env.example .env
```

3. Start Docker

```sh
docker-compose up -d
```

4. Enter docker container (Default user usually is 1000)

```sh
docker exec -i -t -u {DEFAULTUSER} promote-api_app_1 bash
```

5. Install dependencies

```sh
composer install
```

6. Now you can execute commands! Generate App Key

```sh
php artisan key:generate
```

7. Run migrations with seeders

```sh
php artisan migrate --seed
```

You will have a test user which you can use to authenticate to make requests to guarded routes

```sh
test@test.com:password
```

But before you will need to grab the CSRF Token from the application, using the route

```sh
/sanctum/csrf-cookie
```

There's more info about this in the API Documentation.


Users will be authenticated by the Bearer Token, which will be returned after a successful login, then you can send requests with header ```Authorization: Bearer $token``` to access guarded routes.

# Postman Collection

You can download the Postman Collection [here](https://github.com/nkabz/promote-api/files/4696560/Promote-API.postman_collection.zip) or in the API Documentation

# Requirements


Please don't forget to setup [Mailtrap](https://mailtrap.io/) as the system uses Notifications

In .env
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=YOURUSERNAME
MAIL_PASSWORD=YOURPASSWORD
```
