# E-dentiteta
Development of multifunctional application for e-identity
## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Creation of database](#creation-of-database)
- [Rules](#rules)

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
1. username: ````ijw26577_e-identity````
2. password: EIdentity1!
3. db_name: ijw26577_e-identity
4. host: localhost

## Rules
1. <b>DO NOT USE MAIN BRANCH</b>
2. Branch names for features starts with feat/, for bugs bug/ and for development /dev, followed by short description of the feature/bug/development
3. Commit messages should be in english
4. Commit messages should be short and descriptive
5. Always make pull request and request at least one rewiever
6. Always merge into development branch (if you are merging into main branch, please contact all team members)
7. Always delete branch after merging
8. Always make one blank line between methods, different parts of code, etc.
9. Always use camelCase for variables and methods
