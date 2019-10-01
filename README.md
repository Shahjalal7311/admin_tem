# Roles Permissions Laravel (RPL)
A stater kit with Roles and Permissions implementation on Laravel 5.4

### Install
1. To use it just clone the repo and composer install.
2. Set the database connection 
3. Migration 
	php artisan migrate
	php artisan migrate:rollback
4. To test the app run `php artisan db:seed`, our [interactive seeder](http://www.qcode.in/advance-interactive-database-seeding-in-laravel/) will take care of everything.

### Add a new Resource
1. Create desired resource by running 
 ```bash
## Create Comment model with migration and resource controller
php artisan make:model Comment -m -c --resource
```
2. Register route for it.
```php
Route::group( ['middleware' => ['auth']], function() {
    ...
    Route::resource('comments', 'CommentController');
});
```

3. Now implement your controllers methods and use the `Authorizable` trait
```php
use App\Authorizable;

class CommentController extends Controller
{
    use Authorizable;
    ...
```

4. Now add the permissions for this new `Comment` model.
```bash
php artisan auth:permission Comment
```

That's it, you have added new resource controller which have full access control by laravel permissions.
 
 ### auth:permission command
 This command can be user to add or remove permission for a given model
 
 ```bash
## add permission
php artisan auth:permission User
php artisan auth:permission Role
php artisan auth:permission Post
php artisan auth:permission Artical

## remove permissions
php artisan auth:permission User --remove
php artisan auth:permission Role --remove
php artisan auth:permission Post --remove
php artisan auth:permission Artical --remove
```
##If Migration problem rise.run this command
##php artisan cache:clear
##php artisan view:clear
##php artisan route:clear
##php artisan clear-compiled
##php artisan config:cache
