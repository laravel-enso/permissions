# Comments Manager
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/4ec2d18588a64875aa432c9a827a1849)](https://www.codacy.com/app/laravel-enso/PermissionManager?utm_source=github.com&utm_medium=referral&utm_content=laravel-enso/PermissionManager&utm_campaign=badger)
[![StyleCI](https://styleci.io/repos/94779938/shield?branch=master)](https://styleci.io/repos/94779938)
[![Total Downloads](https://poser.pugx.org/laravel-enso/permissionmanager/downloads)](https://packagist.org/packages/laravel-enso/permissionmanager)
[![Latest Stable Version](https://poser.pugx.org/laravel-enso/permissionmanager/version)](https://packagist.org/packages/laravel-enso/permissionmanager)

Permission Manager dependency for [Laravel Enso](https://github.com/laravel-enso/Enso)

### Details

- permissions are managed based on the user role
- allows creating, updating and deleting of permissions for each route
- permits the one step creation of permissions for a resource type of route
- has the `access-route` policy which can be used to check if the a user is authorized on a given route
- comes with the `VerifyRouteAccess` middleware that checks against unauthorized access 

### Notes

The [Laravel Enso Core](https://github.com/laravel-enso/Core) package comes with this package included.

### Contributions

are welcome