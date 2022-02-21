1. Introduction: I have used Lumen framework of laravel with MySQL database.
   ##  Requirements: 
        PHP 8
        Laravel Framework Lumen (8.3.4) version
        MySQL - 10.4.22-MariaDB

# Lumen PHP Framework
Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

2. Steps to install the application

        1. Clode the codebase from https://github.com/angadyadav91/mini-arise.git or dowload.
        2. After getting/extracting the codebase; go to the root directory of application.
        3. run command: composer install
        4. It will download all the required package to run application succesfully.
        5. Please replace .env.example file to .env file
        6. I have used datebase named 'mini-aspire', please create a new database in local
          and use the same datebase and credentail in the .env file. 
        7. Now create DB migration; run command PHP artisan migrate to migrate all db table and it's structure.
        8. Run command php artisan db:seed, this is all done from setup end.
        9. Now run the server through command; php -S localhost:8000 -t public in local
        10. We will use collection file to test the created API's


    

