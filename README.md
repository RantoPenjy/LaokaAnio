# Laoka-Anio

Laoka Anio is a Symfony 6 project that selects a random Malagasy dish from a database of Malagasy dishes. The project also serves as an API.
It had a simple display made with Bootstrap and use the DataTable to show all dishes and their properties.

## Requirements:
```
- Mysql
- PHP > 8.1
- Node > 20
```

## Installation:

- Clone the repository from Github:
  ```bash
  git clone https://github.com/RantoPenjy/Laoka-Anio
  ```
- Install dependencies:
  ```bash
  composer install
  ```
  and
  ```bash
  npm install
  ```
- Update your .env.local file to setup your own database
  
- Create a database:
  ```bash
  php bin/console doctrine:database:create
  ```
- Run database migrations:
  ```bash
  php bin/console doctrine:migrations:migrate
  ```
- Load fixtures:
  ```bash
  php bin/console doctrine:fixtures:load
  ```
- Install the symfony cli and start the development server:
  ```bash
  symfony server:start
  ```
  or
  ```bash
  symfony serve
  ```

## Usage:

- To select a random Malagasy dish, click on the "Random Dish" button on the homepage.
- To view all Malagasy dishes through API Platform

## Configuration:

- To configure the database connection, edit the .env file.
- To configure the application settings, edit the config/packages/app.yaml file.

## For Developers: 
Who want to check the usage of API through the API Platform:
- Access the API Platform interface through this url
```bash
127.0.0.1:8000/api
```
- Create an user from the user endpoint
- Get JWT in the login check
- Put the generated JWT to the authorization
- Access full feature of the API
- Feel free to customize it like you want

## Contributing:
If you would like to contribute to this project, please fork the repository, make your changes, and submit a pull request.

## Credits:
This project was created by [RantoPenjy](https://github.com/RantoPenjy) and is licensed under the MIT license.
