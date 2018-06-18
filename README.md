# SingleManning


How to test the code?

For starters, you will have to clone the code, run composer install, edit the .env file, give it a database, then run the migrations and seed the tables.

The tests I have created to cover the scenarios are in 
/tests/Unit/ScenraiosTest.php

I have carefully explained the first four scenarios you have given me, then the another two I have added.

In order to execute the code and get the single manning hours of each day for the FunHouse shop rota, run the command: 

php artisan singlemanning:calculate

That will show you for each day how many manning minutes there are. 

The test scenarios will explain in detail how many manning minutes there are each day, and why.

The magic happens in the class called SingleManning located in /app/Helpers/SingleManning.php 
I have made an attempt to explain my thought process in there.


