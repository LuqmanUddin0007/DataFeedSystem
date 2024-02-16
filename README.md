# Project Name
DataFeed System

## Description

DataFeed System processes a local XML file placed in root directory (`./public/feed.xml`) and pushes the data to a chosen database (MySQL). It provides flexibility by allowing the configuration of different data storage options. Error logging is implemented to track any issues encountered during processing. The application includes unit tests to ensure reliability and maintainability.

## Installation

1. Clone the repository:

2. Navigate to the project directory:

3. Install dependencies using Composer run the command mentioned: ```composer install``` 

4. Ensure that the .env file is properly configured with your database connection details, including the database driver, host port, database name, username, and password.



### 5. Run the following necessary database migrations commands:

1. install dependencies
```bash
php bin/console doctrine:database:create
```
```bash
php bin/console make:migration
```
```bash
php bin/console doctrine:migrations:migrate
```
 
## Usage

1. To import the XML file and execute the application, run the mention command in the console: "php bin/console app:xml-import"

2. The command will import the XML file and will save in database.