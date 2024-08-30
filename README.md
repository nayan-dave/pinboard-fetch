## Installation

[PHP](https://php.net) 8.1+ and [Composer](https://getcomposer.org) are required.


## Configuration

To get started, you'll need to follow below steps:

```bash
$ composer install
$ npm install
```

Rename the `.env.example` file to `.env`
Create MySQL Database and set name of created database in `.env` as example given below.
DB_DATABASE=keystone_law
set other DB configuration based on your environment setup.

Once DB created and `.env` set up run below command

```bash
$ php artisan migrate
```

## Usage

Download RSS feed from URL and add pinboard data in DB:

```bash
$ php artisan command:fetchPinboard
```

Once data loaded in the DB. You can start your webapplication using below command.
Use two terminal to run both command separately.
```bash
$ php artisan serve
```
above commnad will start the Laravel APP
Open another command tab and go to project directory and run below command
```bash
$ npm run dev
```

Now open web browser and use the url `http://127.0.0.1:8000/` or `http://localhost:8000/`




## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Security

If you discover any security related issues, please email [nayan.dave@gmail.com](nayan.dave@gmail.com) instead of using the issue tracker.
