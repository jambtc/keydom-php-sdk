# keydom-php-sdk

PHP SDK for communicating with the KEYDOM REST API

```php
// Initialize AuthService 
$authService = new \Keydom\AuthService('https://keydom.example.com');

// Authenticate Channel In access
$authService->authenticate('username', 'password');

// Insert new user
$usersController = new \Keydom\Controllers\UsersController($authService);

$jsonBody = [
    "lastName" => "Doe",
    "firstName" => "Jhon",
    "registrationNumber" => "123",
    "address" => "95 Whitemarsh Street, Santa Clara, CA 95050",
    "phone" => "2025550196",
    "mobile" => "202-555-0196",
    "email" => "john.doe@email.com",
    "documentNumber" => "AG66677CJ"
];

$user = $usersController->create($jsonBody);
```
