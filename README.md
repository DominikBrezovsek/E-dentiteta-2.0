# E-dentiteta
Development of multifunctional application for e-identity
## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Creation of database](#creation-of-database)

## Installation
To initialize the project use:
1. composer install

## Usage
To run the project use:
1. php artisan migrate (optional if there are any changes to database structure)
2. php db:seed -class:NameOfSeeder (to seed database)
3. php storage:link (to link storage to project)
4. php artisan serve

## Creation of database
Please create your local database with the following information (so we can use the same .env file which will be uploaded to the server too):
1. username:
2. password:
3. db_name:
