
# Company portfolio
![N](https://i.imgur.com/CxkVdcv.png)


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
| Backend Server | [Laravel](https://laravel.com/docs/5.5) | Well documented and widely supported web framework |
| API Protocol | REST | A familiar paradigm to most developers |
| Data Mapping Framework | [Eloquent ORM](https://laravel.com/docs/5.5/eloquent) | Included with Laravel |
| Database Migrations | [Laravel Migrations](https://laravel.com/docs/5.5/migrations) | Provided by Laravel, so no additional dependencies |
| Containerization | [Docker](https://www.docker.com/) | Containers make deployment easy |
| Testing Framework | [Jest](https://facebook.github.io/jest/)  / [PHPUnit](https://phpunit.de/) | Complete testing package with an intuitive syntax |
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

### FrontEnd Dev

```shell
cd FrontEnd/ && yarn dev
```

### Deploying / Publishing

Update your `.env` files to indicate a production build, like `NODE_ENV=production` and `APP_ENV=production`. 



## Configuration

See the .env.dev files in FrontEnd and BackEnd directories.

## Tests
Tests will Here soon | :stuck_out_tongue_winking_eye: |
Client and Server code each have their own tests, using Jest.


