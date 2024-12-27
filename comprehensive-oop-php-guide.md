# Complete Guide to Object-Oriented Programming (OOP) in PHP

## Table of Contents

1. [Introduction to OOP](#introduction-to-oop)
2. [Classes and Objects](#classes-and-objects)
3. [Properties and Methods](#properties-and-methods)
4. [Constructor and Destructor](#constructor-and-destructor)
5. [Inheritance](#inheritance)
6. [Encapsulation](#encapsulation)
7. [Polymorphism](#polymorphism)
8. [Abstraction](#abstraction)
9. [Interfaces](#interfaces)
10. [Traits](#traits)
11. [Static Methods and Properties](#static-methods-and-properties)
12. [Magic Methods](#magic-methods)
13. [Namespaces](#namespaces)
14. [Real-World Examples](#real-world-examples)
15. [Best Practices](#best-practices)

## Introduction to OOP

Object-Oriented Programming (OOP) is a programming paradigm that organizes code into objects that contain both data and code. Think of objects as containers that hold both:
- Data (properties)
- Functions that work with that data (methods)

### Why Use OOP?

1. **Organization**: Code is organized into logical groups
2. **Reusability**: Write once, use many times
3. **Maintenance**: Easier to maintain and modify
4. **Scalability**: Easier to add new features
5. **Security**: Better control over data access

## Classes and Objects

### What is a Class?

A class is a blueprint for creating objects. Think of it as a template that defines what properties and methods an object will have.

```php
class Car {
    // Properties
    public $brand;
    public $color;
    public $year;
    
    // Methods
    public function startEngine() {
        return "The {$this->brand} engine is starting...";
    }
    
    public function drive() {
        return "The {$this->color} {$this->brand} is driving...";
    }
}
```

### Creating Objects

Objects are instances of a class. You can create multiple objects from the same class:

```php
// Create first car
$car1 = new Car();
$car1->brand = "Toyota";
$car1->color = "Red";
$car1->year = 2020;

// Create second car
$car2 = new Car();
$car2->brand = "Honda";
$car2->color = "Blue";
$car2->year = 2021;

// Using the objects
echo $car1->drive(); // Output: The Red Toyota is driving...
echo $car2->drive(); // Output: The Blue Honda is driving...
```

## Properties and Methods

### Property Types and Access Modifiers
## Encapsulation with Getters and Setters

Encapsulation is a fundamental concept in OOP that restricts access to certain properties and methods of an object. By using **getters** and **setters**, you can control how properties are accessed and modified, which helps maintain the integrity of the data.

### Example

```php
class User {
    private $username; // Private property
    private $email;    // Private property

    // Setter for username
    public function setUsername($username) {
        if (strlen($username) >= 3) {
            $this->username = $username; // Set username if valid
        } else {
            throw new Exception("Username must be at least 3 characters.");
        }
    }

    // Getter for username
    public function getUsername() {
        return $this->username; // Return the username
    }

    // Setter for email
    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email; // Set email if valid
        } else {
            throw new Exception("Invalid email format.");
        }
    }

    // Getter for email
    public function getEmail() {
        return $this->email; // Return the email
    }
}

// Usage
try {
    $user = new User();
    $user->setUsername("Alice"); // Set username
    $user->setEmail("alice@example.com"); // Set email

    echo $user->getUsername(); // Output: Alice
    echo $user->getEmail();    // Output: alice@example.com
} catch (Exception $e) {
    echo $e->getMessage(); // Handle exceptions
}

####Example
class BankAccount {
    // Different access modifiers
    public $accountNumber;      // Accessible from anywhere
    private $balance;           // Only accessible within this class
    protected $accountType;     // Accessible within this class and child classes
    
    // Property type declarations (PHP 7.4+)
    public string $ownerName;
    public float $interestRate;
    private bool $isActive = true;
    
    // Constant property
    const MINIMUM_BALANCE = 100;
}
```

### Method Types

```php
class SimpleClass {
    private $secret = "I am private";

    public function revealSecret() {
        return $this->secret;
    }
}

// Example usage
$obj = new SimpleClass();

// This will cause an error because $secret is private
// echo $obj->secret; // Fatal error

echo $obj->revealSecret(); // Outputs: I am private
```

## Constructor and Destructor

### Constructor Examples

```php
class Person {
    private string $name;
    private int $age;
    
    // Basic constructor
    public function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }
}

// Constructor promotion (PHP 8.0+)
class Person {
    public function __construct(
        private string $name,
        private int $age
    ) {}
}

// Constructor with default values
class Configuration {
    private string $host;
    private int $port;
    
    public function __construct(
        string $host = 'localhost',
        int $port = 3306
    ) {
        $this->host = $host;
        $this->port = $port;
    }
}

class Person {
    private $name;

    public function __construct($name) {
        $this->name = $name; // Initialize name
    }

    public function __destruct() {
        echo "{$this->name} is being destroyed."; // Cleanup message
    }
}

// Usage
$person = new Person("John");
// When $person goes out of scope, the destructor is called.
```
```php
# PHP Magic Methods: `__get` and `__set`

The `__get` and `__set` magic methods in PHP allow you to define custom behavior when accessing or setting inaccessible or non-existent properties of an object. 


## **1. The `__get` Magic Method**

The `__get` method is triggered when you attempt to **read** an inaccessible or non-existent property.
its retrieve the value pf the key that ahs seted in the bugunning
### **Syntax**

public function __get($property) {
    // Custom logic for retrieving the value of $property
}
```

### Practical Constructor Usage

```php
class Database {
    private $connection;
    private $host;
    private $username;
    private $password;
    private $database;
    
    public function __construct(
        string $host,
        string $username,
        string $password,
        string $database
    ) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        
        $this->connect();
    }
    
    private function connect() {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );
    }
    
    public function __destruct() {
        $this->connection->close();
    }
}

// Usage
$db = new Database('localhost', 'user', 'password', 'mydb');
```

## Inheritance

### Basic Inheritance

```php
class Animal {
    public function speak() {
        return "Animal speaks.";
    }
}

class Dog extends Animal {
    public function speak() {
        return "Dog barks.";
    }
}

// Usage
$dog = new Dog();
echo $dog->speak(); // Output: Dog barks.
```

### Multi-level Inheritance

```php
class ElectricCar extends Car {
    private int $batteryCapacity;
    
    public function __construct(
        string $brand,
        string $model,
        int $year,
        int $doors,
        int $batteryCapacity
    ) {
        parent::__construct($brand, $model, $year, $doors);
        $this->batteryCapacity = $batteryCapacity;
    }
    
    public function getInfo(): string {
        return parent::getInfo() . 
               " with {$this->batteryCapacity}kWh battery";
    }
}

$tesla = new ElectricCar("Tesla", "Model 3", 2023, 4, 75);
echo $tesla->getInfo(); 
// Output: 2023 Tesla Model 3 with 4 doors with 75kWh battery
```

## Encapsulation

### Property Encapsulation

```php
class User {
    private string $username;
    private string $email;

    // Constructor to initialize properties
    public function __construct(string $username, string $email) {
        $this->username = $username;
        $this->email = $email;
    }

    // Getter for username
    public function getUsername(): string {
        return $this->username;
    }

    // Setter for username
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    // Getter for email
    public function getEmail(): string {
        return $this->email;
    }

    // Setter for email
    public function setEmail(string $email): void {
        $this->email = $email;
    }
}

// Usage
$user = new User("john_doe", "john@example.com");
echo $user->getUsername(); // Output: john_doe

// Modifying properties through setter
$user->setUsername("jane_doe");
echo $user->getUsername(); // Output: jane_doe
```

## Polymorphism

### Method Overriding

```php

class Animal {
    public function speak(): string {
        return "Animal makes a sound.";
    }
}

class Dog extends Animal {
    public function speak(): string {
        return "Dog barks.";
    }
}

class Cat extends Animal {
    public function speak(): string {
        return "Cat meows.";
    }
}

// Usage
$animal = new Animal();
echo $animal->speak(); // Output: Animal makes a sound.

$dog = new Dog();
echo $dog->speak(); // Output: Dog barks.

$cat = new Cat();
echo $cat->speak(); // Output: Cat meows.

//advanced example
interface PaymentMethod {
    public function processPayment(float $amount): bool;
    public function getPaymentDetails(): array;
}

class CreditCard implements PaymentMethod {
    private string $cardNumber;
    private string $expiryDate;
    
    public function __construct(string $cardNumber, string $expiryDate) {
        $this->cardNumber = $cardNumber;
        $this->expiryDate = $expiryDate;
    }
    
    public function processPayment(float $amount): bool {
        // Credit card processing logic
        return true;
    }
    
    public function getPaymentDetails(): array {
        return [
            'type' => 'Credit Card',
            'last4' => substr($this->cardNumber, -4),
            'expiry' => $this->expiryDate
        ];
    }
}

class PayPal implements PaymentMethod {
    private string $email;
    
    public function __construct(string $email) {
        $this->email = $email;
    }
    
    public function processPayment(float $amount): bool {
        // PayPal processing logic
        return true;
    }
    
    public function getPaymentDetails(): array {
        return [
            'type' => 'PayPal',
            'email' => $this->email
        ];
    }
}

// Usage
function processOrder(PaymentMethod $payment, float $amount) {
    if ($payment->processPayment($amount)) {
        $details = $payment->getPaymentDetails();
        echo "Payment processed using " . $details['type'];
    }
}

$creditCard = new CreditCard("1234567890123456", "12/24");
$paypal = new PayPal("user@example.com");

processOrder($creditCard, 100.00);
processOrder($paypal, 50.00);
```

## Abstraction

### Abstract Classes and Methods

```php
abstract class Animal {
    abstract public function makeSound(): string;
}

class Dog extends Animal {
    public function makeSound(): string {
        return "Bark";
    }
}

class Cat extends Animal {
    public function makeSound(): string {
        return "Meow";
    }
}

// Usage
$dog = new Dog();
echo $dog->makeSound(); // Output: Bark

$cat = new Cat();
echo $cat->makeSound(); // Output: Meow
```

## Interfaces

An **interface** in PHP defines a contract for classes that implement it. It specifies the methods a class must implement without providing the actual implementation details. This allows different classes to implement the same interface in their own way, promoting consistency and flexibility in your code.

### Why Use Interfaces?

1. **Consistency**: Interfaces ensure that different classes adhere to a specific structure, making it easier to work with them interchangeably.
2. **Decoupling**: By programming against interfaces rather than concrete classes, you reduce dependencies in your code, making it easier to change implementations without affecting code that uses them.
3. **Multiple Inheritance**: PHP does not support multiple inheritance with classes, but a class can implement multiple interfaces, allowing for greater flexibility in design.

### Example

```php
interface PaymentMethod {
    public function pay($amount); // Method to process payments
}

class PayPal implements PaymentMethod {
    public function pay($amount) {
        return "Paid $amount using PayPal."; // PayPal payment implementation
    }
}

// Usage
$payment = new PayPal();
echo $payment->pay(100); // Output: Paid 100 using PayPal.
```


## Traits

### Using Traits for Code Reuse

```php
trait Logger {
    public function log(string $message) {
        echo "[LOG] $message\n";
    }
}

class User {
    use Logger;

    public function create(string $name) {
        $this->log("User $name created.");
    }
}

// Usage
$user = new User();
$user->create("Alice"); // Output: [LOG] User Alice created.
```

## Static Methods and Properties

### Static Usage Examples

```php
class Math {
    public static $pi = 3.14159;

    public static function add( $a, $b){
        return $a + $b;
    }

    public static function multiply($a, $b) {
        return $a * $b;
    }
}

// Usage
echo Math::$pi; // Output: 3.14159
echo Math::add(5, 3); // Output: 8
echo Math::multiply(4, 2); // Output: 8
```
# Complete Guide to Object-Oriented Programming in PHP

## Core OOP Concepts Deep Dive

### Access Modifiers in Detail

```php
class BankAccount {
    public $accountNumber;      // Accessible everywhere
    private $balance;           // Only within this class
    protected $accountType;     // This class and child classes
    
    public function __construct($initialBalance) {
        $this->setBalance($initialBalance);
    }
    
    private function setBalance($amount) {
        if ($amount >= 0) {
            $this->balance = $amount;
        }
    }
    
    protected function getAccountType() {
        return $this->accountType;
    }
}

class SavingsAccount extends BankAccount {
    // Can access $accountType (protected)
    // Cannot access $balance (private)
    public function displayAccountType() {
        echo $this->getAccountType(); // Works - protected method
    }
}
```

### Namespaces and Autoloading

#### Directory Structure
#### Description:
This article explains how to use namespaces in PHP to keep your code organized and prevent name conflicts. It shows how to structure your project with folders and how to define and use namespaces. It also covers how to use Composer to automatically load classes, making it easier to manage your code.
```
project/
├── composer.json
├── src/
│   ├── Banking/
│   │   ├── Account.php
│   │   └── Transaction.php
│   └── User/
│       ├── Authentication.php
│       └── Profile.php
```

#### Namespace Definition (Account.php)
```php
namespace Banking;

class Account {
    private $accountNumber;
    
    public function __construct($accountNumber) {
        $this->accountNumber = $accountNumber;
    }
}
```

#### Using Namespaces
```php
// Using individual classes
use Banking\Account;
use User\Authentication;

// Using multiple classes from same namespace
use Banking\{Account, Transaction};

// Using with alias to make it understand for others
use Banking\Account as BankAccount;
```

#### Composer Autoloading (composer.json)
```json
{
    "autoload": {
        "psr-4": {
            "Banking\\": "src/Banking/",
            "User\\": "src/User/"
        }
    }
}
```


### Simple Example of Static

#### Description:
Static properties and methods in PHP are used to define behavior or data that belongs to the class itself rather than to any instance. This means you can access them without needing to create objects of that class.

#### Example:

```php
class MathUtility {
    public static $pi = 3.14;

    public static function calculateCircleArea($radius) {
        return self::$pi * $radius * $radius; // Using the static property
    }
}

// Accessing the static property
echo MathUtility::$pi; // Output: 3.14

// Calling the static method
echo MathUtility::calculateCircleArea(5); // Output: 78.5
```
### Final Classes and Methods

```php
final class Configuration {
    private $settings = [];
    
    public function setSetting($key, $value) {
        $this->settings[$key] = $value;
    }
}

class BaseController {
    final public function render($view, $data = []) {
        // Cannot be overridden in child classes
        // Render logic here
    }
}
```


### Type Hinting and Return Types

```php
class TypeHintExample {
    private array $items = [];
    
    public function addItem(string $name, int $quantity): void {
        $this->items[$name] = $quantity;
    }
    
    public function getItem(string $name): ?int {
        return $this->items[$name] ?? null;
    }
    
    public function calculateTotal(): float {
        return array_sum($this->items);
    }
}
```

### Object Cloning

```php
class DeepCopy {
    public $property;
    
    public function __clone() {
        // Perform deep copy of properties
        if (is_object($this->property)) {
            $this->property = clone $this->property;
        }
    }
}
```

# Gestion des Erreurs et Exceptions(throw, try & catch, exception)
## 1. Throw

Le mot-clé `throw` est utilisé pour lancer (ou "jeter") une exception. Lorsqu'une exception est lancée, l'exécution normale du programme s'arrête et l'exception est capturée dans un bloc `catch`.

### Exemple :

```php
function divide($a, $b) {
    if ($b == 0) {
        throw new Exception("Erreur : Division par zéro.");
    }
    return $a / $b;
}

```
## 2. Try-Catch

Le bloc `try` permet de définir une portion de code qui pourrait générer une exception. Si une exception est lancée dans le bloc `try`, elle sera capturée par le bloc `catch`. Le bloc `catch` permet de traiter l'exception et d'afficher un message d'erreur.

### Exemple :

```php
try {
    echo divide(10, 0);
} catch (Exception $e) {
    echo "Message d'erreur : " . $e->getMessage();
}
```
# SOLID Principles in PHP

SOLID is an acronym that represents five design principles for writing clean, maintainable, and scalable code. These principles help developers create more flexible and easier-to-maintain software.

## 1. **Single Responsibility Principle (SRP)**

**Description:**
A class should have only one reason to change, meaning it should have only one responsibility. This helps to keep your classes focused and prevents them from becoming too complex.

**Example:**

```php
<?php

// Before applying SRP
class User {
    public function save() {
        // Save user to database
    }

    public function sendEmail() {
        // Send user email
    }
}

// After applying SRP
class User {
    public function save() {
        // Save user to database
    }
}

class EmailService {
    public function sendEmail($user) {
        // Send user email
    }
}
?>
```
## 2. **Open/Closed Principle (OCP)**
```php

<?php

// Before applying OCP
class Rectangle {
    public $width;
    public $height;
}

class AreaCalculator {
    public function calculate($shape) {
        if ($shape instanceof Rectangle) {
            return $shape->width * $shape->height;
        }
        // add more conditions for different shapes
    }
}

// After applying OCP
interface Shape {
    public function area();
}

class Rectangle implements Shape {
    public $width;
    public $height;
    public function area() {
        return $this->width * $this->height;
    }
}

class AreaCalculator {
    public function calculate(Shape $shape) {
        return $shape->area();
    }
}
?>
```

