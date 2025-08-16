# Laravel mission control server devlog + small guides


## Creating the migrations.

There is a tweak with Laravel which is worth paying attention to it, as fixing the problems that it might arise could potentially take some time.

In our case we have 3 tables: *astronauts*, **destinations** and *missions*. The crucial part here is the destinations, as this table should have timestamp smaller than the *missions* table, so that it's migration will be executed before the migration for the table *missions*, this is needed as table *missions* relies on the *destination_id* from **destinations** table, hence this table should be created before *missions*, or otherwise it will be corrupted.

## Seeding database

In order to seed database we may use SQLtools in VScode or DataGrip.
I choose the second option for this projects.

1. Open your projects in DataGrip.
2. Navigate to the leftmost pane, named `Database Explorer`
3. Add new Data Source (SQLite) by clicking on **+** button
4. Choose No authentication for the database
5. Copy the *Absolute* path to the database.
6. Add `jdbc:sqlite:` + `<absolute_path>` in the URL textbox.
7. Goto schemes and check the checkbox in front of the *main*
8. Hit `Ok` and goto console.
9. Populate the destinations table with insert statements, You should be ok with this configuration

## Model creation
1. Create model Astronaut: `herd php artisan make:model Astronaut`
2. Create model Destination: `herd php artisan make:model Destination`
3. Create models Mission: `herd php artisan make:model Mission`

- Now import `use Illuminate\Database\Eloquent\Concerns\HasUuids;` and `use Illuminate\Database\Eloquent\Factories\HasFactory;` where needed, also don't forget to define **$fillable** for *Mission*.

## Seeder creation
- To seed astronauts we will use Factory + Faker
1. Create factory: `herd php artisan make:factory AstronautsFactory`
2. Creating the seeder `herd php artisan make:seeder AstronautSeeder`

3. Now it's time to seed the astronauts: `herd php artisan db:seed --class=AstronautSeeder`

## Creating controllers
- Add the controllers to manipulate with the server: `herd php artisan make:controller MissionController`

## Api
- install api: `herd php artisan install:api`
- Add appropriate routues: 2 get and 1 post.

## Validation for the POST method
1. Create middleware: `herd php artisan make:middleware ValidateToken`
2. Add api token to the .env file: `API_TOKEN ="THE-UNIVERSE"`

# Time to test it!
1. For the first 2 routes you should be able to test them by just running empty get request
2. For the last method, open **Authorization** header and select *Bearer Token*, insert `THE-UNIVERSE`
- Also don't forget about making body for the request

## Mailing
- `php artisan make:mail MissionReport`
1. Change .env file and add mailing parameters
```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525 (On howest 587)
MAIL_USERNAME=sandbox_test_uname
MAIL_PASSWORD=sandbox_test_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=mission-control@howest.be
MAIL_FROM_NAME="Mission Control"
```
2. Add mission-report blade: `herd php artisan make:view mission-report`