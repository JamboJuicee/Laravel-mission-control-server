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