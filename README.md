# Demo Amazing Talker

## Before
* `OS` : Windows
* `Host`: localhost
* `Server`: Apache 2.4.46
* `DataBase(Connection)`: 10.4.14-MariaDB
  - DB_PORT: 3306
  - DB_DATABASE: exam
  - DB_USERNAME: exam_amazing
  - DB_PASSWORD: Gv1aeay7LT5uhisf
* `Language`: PHP 
  - Version: 7.2.34
  - PHP Extension: mysqli, curl, mbstring
* `Framework`: Laravel 7.3


## After
* `Test Command` 
  - (Change your path in root)
  - php artisan test

* `Process of checking languages`
  - (In browser) Connect to url, http://localhost/languages 

* `Process of creating language`
  - Do the previous step
  - Click Button, Create.
  - Input slug of language, there is no same slug in database.

* `Processing of checking tutors`
  - (In browser) Connect to url, http://localhost/tutors

* `Process of creating language`
  - Do the previous step
  - Click Button, Create.
  - Input slug, name, headline, introduction, trial_price, normal_price, languages of tutor, there is no same slug in database.

* `Check api in browser`
  - (In browser) Connect to api url (HTTP method, GET), http://localhost/api/tutors/{language.slug} 
  - (In browser) Connect to api url (HTTP method, GET), http://localhost/api/tutor/{tutors.slug} 
