# E-dentiteta
Development of multifunctional application for e-identity
## Table of Contents
- [Installation](#installation)
- [Usage](#usage)
- [Creation of database](#creation-of-database)
- [Rules](#rules)

## Installation
### Prerequsites: 
- PHP installed localy and added to the PATH
- SQL database engine(MariaDB works just fine)
- Composer

To initialize the project use:
1. composer install

## Usage
To run the project use:
1. php artisan migrate (optional if there are any changes to database structure)
2. php db:seed -> since we will be using the default seeder to run all migrations as it saves quite a lot of time when deploying
3. php storage:link (to link storage to project) -> this might not be neccesary depending on the config of code
4. php artisan serve

## Creation of database
Please create your local database with the following information (so we can use the same .env file which will be uploaded to the server too):
1. username: `ijw26577_eidentity`
2. password: `EIdentity1`
3. db_name: `ijw26577_eidentity`
4. host: `localhost`

For MacOS users, such as myself, I recomend using [Homebrew](https://brew.sh/) to install MariaDB as noted in their [official documentation](https://mariadb.com/kb/en/installing-mariadb-on-macos-using-homebrew/)
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
10. Please keep your code neat and commented.
11. Avoid magic functions
12. Handle the errors

## Stats of our programming time
- zanurban: <a href="https://wakatime.com/badge/user/357a7788-d233-45e0-bd9c-f6990b124cba/project/207587a4-3e6c-47f5-be1b-d68e11540812"><img src="https://wakatime.com/badge/user/357a7788-d233-45e0-bd9c-f6990b124cba/project/207587a4-3e6c-47f5-be1b-d68e11540812.svg?style=for-the-badge" alt="wakatime"></a>
- dominikbrezovsek: <a href="https://wakatime.com/badge/github/Project-Matura/E-dentiteta"><img src="https://wakatime.com/badge/github/Project-Matura/E-dentiteta.svg?style=for-the-badge" alt="wakatime"></a>
