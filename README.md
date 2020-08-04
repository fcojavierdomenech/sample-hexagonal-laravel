# sample-hexagonal-laravel
A simple sample for a CRUD on a currency. Done with Laravel and an hexagonal architecture aproach. This implies:

- Using service classes for the CRUD operations
- Injecting there the repository interface (and thus using the repository pattern).
- Implementing the repo (we'll still use the defaults Laravel ORM pattern, Active Record)
- Unit, Integration and Acceptance tests. Can be overkill for this sample, but helps giving a general idea.
- Introducing small DDD concepts like Value Objects, we'll use that for the currency field, delegating the validation there.
