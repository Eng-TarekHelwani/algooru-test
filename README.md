# Algooru Backend test

For running the project please add the .env file & the .env.docker file

Run

```bash
composer install
```

Note: You might have to run this command in case of errors

```bash
composer install --ignore-platform-req=ext-http
```

then

```bash
php artisan migrate
```

```bash
php artisan serve
```

You might access the mysql database through phpmyadmin http://localhost/phpmyadmin/

Make sure you have mysql installed (I was using XAMPP)

the app will be running on http://localhost:8000

Postman collection is attached for easier testing

## Running the docker

Make sure you have the docker installed and it's running

run

```bash
docker-compose build
```

then

```bash
docker-compose up
```

the app will be running on http://localhost:9000

Note: Please make sure that the port 3306 is not in used

then run

```bash
docker-compose exec edtech php artisan migrate
```

Hope everything gonna work out as expected!

Regards,






