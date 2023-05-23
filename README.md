# Laravel Project to Upload Excel File

## Installation
- Clone repository
```
$ git clone https://github.com/blpraveen/file_upload.git
```
- Run in your terminal
```
$ composer install
$ php artisan key:generate
```
- Setup database connection in .env file
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

- Migrate tables and seed with demo data
```
$ php artisan migrate --seed
```

- Access it on
```
$ php artisan serve
http://localhost:8000/
```

upload the excel file then run the queue

```
$ php artisan queue:work
```

Check in Database the file get uploaded