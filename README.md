
# Company portfolio
> This is a template readme to this project i'll update it gradually | :stuck_out_tongue_winking_eye: |

## Installing / Getting started

> [ First working with laradock ](https://laradock.io/)  

Let’s see how easy it is to setup our demo stack PHP, NGINX, MySQL, Redis and Composer:

1. Clone Laradock inside your PHP project

           git clone https://github.com/Laradock/laradock.git 

2. Enter the laradock folder and rename env-example to .env.

         cp env-example .env
3. Run your containers:

         docker-compose up -d apache2 mysql phpmyadmin redis workspace 
4. Open your project’s .env file and set the following:

            DB_HOST=mysql
            REDIS_HOST=redis
            QUEUE_HOST=beanstalkd
5. Open your browser and visit localhost: http://localhost.

    That's it! enjoy :)


in .env in laradock edit it 


         APP_CODE_PATH_HOST  => pointing to your project if use this structure 
            * laradock
            * project-1
            * project-2
 ```
 APP_CODE_PATH_HOST=../BackEnd
 APP_CODE_PATH_CONTAINER=/var/www/BackEnd/public
 APACHE_DOCUMENT_ROOT=/var/www/BackEnd/public/public


 ```

## Laraval Voyager Admin 

```
    $ cd <your laradock folder>

    $ docker-compose exec workspace bash

    $ cd <your project>

```


    installion:
            composer require tcg/voyager 


    if you prefer installing it with the dummy data run the following command:
                php artisan voyager:install --with-dummy


## Developing

### Built With

The current technologies used by the starter kit are as follows:

| Type | Selected Technology | Reasoning |
| ---- | ------------------- | --------- |
| Transpiler | [TypeScript](https://www.typescriptlang.org/) | Static types make for code that is less buggy and easier to reason about.  A basic TypeScript cheatsheet can be found [here](https://www.sitepen.com/blog/2013/12/31/typescript-cheat-sheet/) and more extensive documentation [here](https://www.typescriptlang.org/docs/tutorial.html) and [here](https://www.sitepen.com/blog/2013/12/31/definitive-guide-to-typescript/) |
| View Library | [React](https://facebook.github.io/react/) | Component-based views that encourage single-directional data flow |
| Client-side State Management | [MobX](https://github.com/mobxjs/mobx) | Simpler than Redux and requires less boilerplate |
| Backend Server | [Laravel](https://laravel.com/docs/5.5) | Well documented and widely supported web framework |
| API Protocol | REST | A familiar paradigm to most developers |
| Data Mapping Framework | [Eloquent ORM](https://laravel.com/docs/5.5/eloquent) | Included with Laravel |
| Database Migrations | [Laravel Migrations](https://laravel.com/docs/5.5/migrations) | Provided by Laravel, so no additional dependencies |
| Data Store | [PostgreSQL](https://www.postgresql.org/) | Open source, rock solid, industry standard |
| Package Manager | [npm](https://www.npmjs.com/) / [composer](https://getcomposer.org/) | The battle-tested choices for node/php development |
| Containerization | [Docker](https://www.docker.com/) | Containers make deployment easy |
| Testing Framework | [Jest](https://facebook.github.io/jest/)  / [PHPUnit](https://phpunit.de/) | Complete testing package with an intuitive syntax |
| Linter | [tslint](https://github.com/palantir/tslint) | Keeps your TypeScript code consistent |
| NUXT JS | [tslint](https://github.com/nuxt/nuxt.js) |The Intuitive Vue Framework |
| voyager | [tslint](https://github.com/the-control-group/voyager) |The Missing Laravel Admin |

### Prerequisites

- Docker

### Setting up Dev

#### APIS 
```shell
    Routes Needed 

        Route::get('module/{module_name}','ApiController@index');

        Route::get('module/{module_name}/{id}','ApiController@getById');

```
Example : 
    http://localhost/api/module/teams
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "foush",
            "image": "teams/August2020/w3SaYCPnm4ovtZCXVkmB.jpeg",
            "job_title": "BackEnd Developer",
            "LinkedIn": "https://www.linkedin.com/in/ahmed-fouad-162091134/",
            "facebook": "https://www.facebook.com/foush60",
            "created_at": "2020-08-05T11:56:26.000000Z",
            "updated_at": "2020-08-05T11:56:26.000000Z"
        }
    ],
    "first_page_url": "http://localhost/api/module/teams?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost/api/module/teams?page=1",
    "next_page_url": null,
    "path": "http://localhost/api/module/teams",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}

```

Example 2:
    http://localhost/api/module/teams/1
```json
{
    "id": 1,
    "name": "foush",
    "image": "teams/August2020/w3SaYCPnm4ovtZCXVkmB.jpeg",
    "job_title": "BackEnd Developer",
    "LinkedIn": "https://www.linkedin.com/in/ahmed-fouad-162091134/",
    "facebook": "https://www.facebook.com/foush60",
    "created_at": "2020-08-05T11:56:26.000000Z",
    "updated_at": "2020-08-05T11:56:26.000000Z"
}
```

### Controllers 

ApiController:


```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $module_name;
    protected   $model;
    //
    public function index($module_name){
        try{
            $this->setModuleName($module_name);
            $check =$this->initModel();
            if($check === false){
                return response()->json("you can not access this module");
            }
            $data = $this->model->paginate(10);
            return \response()->json($data);
        }catch(\Exception $e){
            dd($e);
        }
    }


    public function getById($module_name,$id){
        try{
            $this->setModuleName($module_name);
            $check = $this->initModel();
            if($check === false){
                return response()->json("you can not access this module");
            }
            $data = $this->model->find($id);
            if($data){
                return \response()->json($data);
            }
            return \response()->json();

        }catch(\Exception $e){
            dd($e);
        }
    }

    protected function setModuleName($module_name){
        $this->module_name = $module_name;
    }
    protected function initModel(){
        // I want to make sure about somethings like module 
        /**
         * lowercase
         * singler
         * camelcase And first char is Capital 
         */ 
        $module = \Str::lower($this->module_name);
        $module = \Str::singular($module);
        $module =   \Str::camel($module);
        $module =   \Str::ucfirst($module);
        if(\in_array($module,$this->expectModules())){
            return false;
        }
        $nameSpace  =   'App\\' . $module;
        // Make object of the Model 
        $this->model = new $nameSpace;
        // dd($module);
    }
    protected function expectModules()
    {
        return ['Contact'];
    }
}

```





### Building

Build client side code:

```shell
cd client/ && npm run build
```

### Deploying / Publishing

Update your `.env` files to indicate a production build, like `NODE_ENV=production` and `APP_ENV=production`. 

```shell
docker-compose -f docker-compose-prod.yml up
```

Will build the client code, spin up the server in a docker instance with `http://localhost:4000/` pointing to the client's index.html and built js/css.

Next, you should generate a new application key for the production environment:

```shell
docker exec -it server php server/artisan key:generate
```

And run the database migrations:

```shell
docker exec -it server php server/artisan migrate
```

To eek out best performance, should also run `php server/artisan config:cache` and `php server/artisan route:cache`, and make sure `APP_DEBUG` is false.

## Configuration

See the .env.example files in client and server directories.

## Tests

Client and Server code each have their own tests, using Jest.

```shell
npm test
```

and 

```shell
cd server && ./vendor/bin/phpunit
```

## Artisan

Laravel has a CLI tool called [Artisan](https://laravel.com/docs/5.5/artisan). To use it:

```shell
docker exec -it server php server/artisan YOUR_COMMAND
```

Do `list` to see available commands.

### How to make a new API endpoint

- Make Model and DB Migration:

```
php artisan make:model Todo -m
```

-  Make Controller:

```
php artisan make:controller TodoController --resource --model=Todo
```

-  Add Routes

```
Route::apiResource('todos', 'TodoController');
```

-  Add Authorization Policies:

```
php artisan make:policy TodoPolicy --model=Todo
```

Register policy in `AuthServiceProvider`:

```
Todo::class => TodoPolicy::class,
```


## Style guide

TBD

## Api Reference

TBD

## Database

Using postgres v9.6. For local development, database runs in docker container. `server/database` contains init script, migrations, and seeds.

You can connect to the database with your favorite client at `localhost:5432`!

#### Run migrations:

```shell
php artisan migrate
```

#### Run seeds:

```shell
php artisan db:seed
```

#### Create new seeds:

```shell
php artisan make:seeder TodosTableSeeder
```

Add it to `DatabaseSeeder.php`:

```
$this->call(TodosTableSeeder::class);
```

## Licensing

[MIT License](LICENSE.md)