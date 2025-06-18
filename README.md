# Arbor Education: Technical Task
The application has 2 parts:
* Report Builder: build reports based on the data stored in the database.
* API Webservice: populate the database with data from a json file provided.

## Database Design
The database is structured as shown in the image below, illustrating the tables and their relationships used to store the data.

![screenshot](./readme_db_design.png)

I added foreign keys to the `Messages` table to establish relationships with other entities. This ensures data consistency and referential integrity within the database.

Each table contains an `id` field that serves as the Primary Key and is used to establish Foreign Key relationships. Additionally, the tables include a secondary ID field, which is a string type. This field stores IDs from the source file but does not function as a key, although they are defined as `unique`.

## Software Architecture
The application is develop using `Laravel 12` as PHP framework and a MySQL database.

### `.env` file
The configuration file `.env` is the root directory. It contains database configuration:
* `DB_CONNECTION=mysql`
* `DB_HOST=127.0.0.1`
* `DB_PORT=3306`
* `DB_DATABASE=arbor_education`
* `DB_USERNAME=root`
* `DB_PASSWORD=`

and some variables such as these:
* `SMS_DATA_FILENAME="sms_data.json"`

* `MESSAGE_TYPE_SENT="SENT"`
* `MESSAGE_TYPE_DELIVERED="DELIVERED"`
* `MESSAGE_TYPE_FAILED="FAILED"`
* `MESSAGE_TYPE_REJECTED="REJECTED"`

### Controllers
The Controllers of the application are allocated under folder `./app/Http/Controllers/`:
* `IngestController.php` for the API Webservice.
* `ReportController.php` for the Report Builder.

### Models
The Models are used for mapping the database tables and they are allocated under folder `./app/Models/`:
* `Message.php`
* `Provider.php`
* `Recipient.php`
* `Sender.php`
* `Status.php`
* `Student.php`

#### Migrations and Seeders
Migrations, under folder `./database/migrations/` are used to create the tables in the database. Also, a Seeder under folder `./database/seeders/` will populate table `Statutes` with the 4 valid values (SENT|DELIVERED|FAILED|REJECTED) provided in the requirements of the task, just after creating the tables.

### Classes and Interfaces
There are some Classes which implement Interfaces to build a software architecture based on abstraction, adhering to the Dependency Inversion principle.

Classes under folder `./app/Classes/`:
* `MessageFindableOrCreateable.php`
* `MessagesCounter.php`
* `MessagesList.php`
* `MessagesRater.php`
* `ProviderFindableOrCreateable.php`
* `RecipientFindableOrCreateable.php`
* `SenderFindableOrCreateable.php`
* `StatusFindable.php`
* `StudentFindableOrCreateable.php`

Interfaces under folder `./app/Interfaces/`:
* `CountableInterface.php`
* `FindableInterface.php`
* `FindableOrCreateableInterface.php`
* `ListableInterface.php`
* `RateableInterface.php`

### Views
The Views to display the reports are allocated under folder `./resources/views/`:
* `report_all.blade.php` for report with all the messages.
* `report_by_recipient.blade.php` for report with messages grouped by recipient.

## API Webservice


## Report Builder


## Installation


## 