# sample-hexagonal-laravel
A simple sample for a CRUD on a currency. Done with Laravel and an hexagonal architecture aproach. This implies:

- Using service classes for the CRUD operations
- Injecting there the repository interface (and thus using the repository pattern).
- Implementing the repo (we'll still use the defaults Laravel ORM pattern, Active Record)
- Unit, Integration and Acceptance tests. Can be overkill for this sample, but helps giving a general idea.
- Structuring the code into 3 layers: Application, Domain and Infrastructure

Steps to reproduce:
- Clone project
- Run `composer install`
- Create an empty database and adjust your .env
- Run `php artisan migrate`
- Run `php artisan test`
