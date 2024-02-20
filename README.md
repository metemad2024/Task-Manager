## About Project

This is a simple Laravel project for a task-manager. the project backend is designed and developed in Laravel and the frontend is based on Bootstrap 5.


## Initialization

After downloading the source code, create a new database in mysql and then config .env file in the root directory of project.

You should run the below command to install all packages from composer.json:

composer install

this command installs all packages and makes an autoload.php file in /vendor.

Then, run migrations to init the database tables. run this command in cli:

php artisan migrate

this command creates all tables in the database.

Also run the command:
php artisan passport:install and check that there is the following array in /config/auth.php :

'api' => [

	'driver' => 'passport',

	'provider' => 'users',
 
]



## Project structure

The backend is composed of a controller in /app/Http/Controllers/Api/ApiController.php and there exist all APIs in it for communicating with frontend.
The frontend is developed by jQuery, HTML, CSS and Bootstrap 5 as well.
You can see the SPA source code of project in /resources/views/front/dashboard.blade.php

## User types

There are two type of users: Admin user and simple user

In user table there is a boolean field isAdmin that determines the type of user:
True for admin False for simple.

you can make a user record with isAdmin=1 and start to use the frontend and login with the user and manage users and their tasks.

Admin users are able to manage users and tasks. But simple users only can manage their own tasks.

## Security

### Rate Limiting

To protect project from bots and DoS attacks we used a Rate-Limiter in the project:
/app/Providers/RouteServiceProvider.php

protected function configureRateLimiting()

{

	RateLimiter::for('api', function (Request $request) {
 
		return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
  
	});
 
}


The default is 60 requests per minute. You can change it as you want.

### XSS

All input fields to APIs are protected against XSS attack. 

## API in POSTMAN
In order to test APIs you can import json files in Postman folder into Postman tool.
All APIs have a postman test request and you can use them easily.

Files:
/Postman/Task APIs.postman_collection.json
/Postman/User APIs.postman_collection.json



## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
