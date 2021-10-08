# Twogether birthday cake calculator

Composer based project, no framework
Language: PHP (min v7.3)
Libraries:
```
"require": {
  "php": "^7.3",
  "ext-curl": "*",
  "ext-json": "*",
  "league/climate": "^3.7"
},
"require-dev": {
  "phpunit/phpunit": "^9.3"
  "phpunit/php-code-coverage": "^9.1"
},
```

Code owner: Zoltan Nagy <nzolthu@gmail.com> 

### Acceptance Criteria:
- See in provided pdf documents.

- Can be run in demo container, docker-compose.yml provided. 

### Start:

- user@host$ docker-compose -up [-d]
- user@host$ docker exec -ti app-lin bash
- root@app-twg$ cd /var/www/app/
- root@app-twg$ composer install (composer 2.*)
- root@app-twg$ php app.php (demo)
- root@app-twg$ php vendor/bin/phpunit --group [unit|ready]
__________________________________________________________________________________________
root@app-twg:/var/www/app# php vendor/bin/phpunit --group ready
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.4.3 with PCOV 1.0.6
Configuration: /home/nzolt/Desktop/Code/twogether/phpunit.xml
Random Seed:   1633682349
Warning:       Incorrect filter configuration, code coverage will not be processed

..........                                                        10 / 10 (100%)

Time: 00:00.069, Memory: 8.00 MB

OK (10 tests, 10 assertions)
__________________________________________________________________________________________

### The code:

Covers the EXAMPLES:
• Dave’s date of birth is 25th June 1986. He gets a small cake on Monday 28 th June 2021.
• Rob’s date of birth is 4th July 1950. He gets Monday off and a small cake on Tuesday 6 th July 2021.
• Sam’s birthday is Monday 12th July and Kate’s is Tuesday 13th July. They share a large cake on
Wednesday 14th July.
• Alex, Jen and Pete have birthdays on the 19th, 20th and 21st of July. Alex and Jen share a large
cake on Wednesday 21st, Pete gets a small cake on Friday 23rd.

### TODO:

- Add more tests.
- Configure code coverage reporting.

##---------------------------------------------

