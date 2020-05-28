<p align="center"><img src="https://i.ibb.co/MpzgQsC/Screenshot-from-2020-05-28-02-26-23.png" width="400"></p>

## Promote API Challenge :star:

Set up and develop an API as specified.

# Table of contents

* [Checklist](https://github.com/nkabz/promote-api/issues/1)
* [API Documentation](
* [Developing](#developing)

# Developing

1. Clone the repository
```
git clone git@github.com:nkabz/promote-api.git
```
2. Setup .env file
```
cp .env.example .env
```
3. Start Docker
```
docker-compose up -d
```
4. Enter docker container (Default user usually is 1000)
```
docker exec -i -t -u {DEFAULTUSER} promote-api_app_1 bash
```
5. Install dependencies
```
composer install
```
6. Now you can execute commands! Generate App Key
```
php artisan key:generate
```
7. Run migrations with seeders
```
php artisan migrate --seed
```
You will have a test user which you can use to authenticate to make requests to guarded routes


```test@test.com:password```


But before you will need to grab the CSRF Token from the application, using the route
```
/sanctum/csrf-cookie
```

Users will be authenticated by the Bearer Token, which will be returned after a successful login


There's more info about this in the API Documentation.
