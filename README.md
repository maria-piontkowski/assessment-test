## Assessment Test - Backend

This task aims to assess the candidates' knowledge and go through some areas of features of the framework that we use in our projects. 
Test implementation is free as long as the essential objectives are met.
 
The proposed exercise is to create a simple API interface, with a CRUD for an object model with the characteristics below:
  
  
#### Features

- Authentication Login with password
 	
- Book Registry | `GET`, `POST`, `PUT` and `DELETE`
 
- Store Registry | `GET`, `POST`, `PUT` and `DELETE`
 
- Book and Store Relationship

___
 
#### Fields

The fields of each entity:
 
##### Book
 - Name | required
 - ISBN | only numbers
 - Value | decimal
 
##### Store
 -	Name | required
 -	Address
 -	Active | boolean
 
##### Book Store 
- Relationship with multiple books to multiple stores
___

### Getting Start

1. Configure your environment according to [Laravel Documentation](https://laravel.com/docs/11.x/configuration) if necessary.
2. Set your database credentials in the `.env` file.
3. Run `php artisan migrate` to generate the database.
4. Run `php artisan app:create-user {name} {email} {password}` to create a user.

____

### Authentication

1. This application uses [Laravel Sanctum](https://laravel.com/docs/11.x/configuration) authentication system.
2. Use `api/login` endpoint with `email` and `password` to login and receive a token.
3. Use the received token to authenticate the api requests.
3. Use `api/logout` to log out.   

____

### Api Resources
This application uses REST architecture.

##### Books
Use `/api/books` as the endpoint to perform CRUD actions.

##### Stores
Use `/api/stores` as the endpoint to perform CRUD actions.

##### Books Stores Relationship
Use `/api/book-store/{book}/{store}` as the endpoint to add (`POST` method) or remove (`DELETE` method) a relation.

___

### Tests

1. This application uses [Pest](https://pestphp.com/) testing framework.
2. Run `php artisan test` if you want to execute the unit tests.
3. This application has unit tests for:
    * Login and logout. 
    * Authenticated and unauthenticated requests.
    * All CRUD methods.
    * Book Store relationship.

