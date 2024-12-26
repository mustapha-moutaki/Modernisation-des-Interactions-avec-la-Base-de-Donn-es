# Object-Oriented Programming (OOP) in PHP

## Goal of OOP:
Object-Oriented Programming (OOP) allows us to model real-world entities using objects. This approach makes it easier to design and develop software that mimics real-world behavior.

For example, consider a **Car**:
- **Properties**: Characteristics of the car (e.g., color, speed).
- **Methods**: Actions the car can perform (e.g., move, stop).

---

### Example: A Simple Car Class
```php
class Car {
    // Properties (what the car has)
    public $color;
    public $speed;

    // Method (what the car can do)
    public function drive() {
        echo "The car is moving!";
    }
}

// Creating a car object
$myCar = new Car();
$myCar->color = "Red";
$myCar->speed = "100 km/h";

// Using the car's method
$myCar->drive();  // Output: "The car is moving!"
Key Concepts:

A class is like a blueprint that defines properties and methods.
An object is an instance of a class, created using the new keyword.
The -> operator (object operator) is used to access properties and methods.
Benefits of OOP:
1. Reusability:
Classes can be reused to create multiple objects with similar properties and methods.


class Car {
    public $brand;
    public $speed;

    public function move() {
        echo "The car is moving!";
    }
}

// First car object
$car1 = new Car();
$car1->brand = "Toyota";

// Second car object
$car2 = new Car();
$car2->brand = "BMW";

2. Scalability:
New properties or methods can be added to a class without affecting existing objects.


class Car {
    public $color;
    public $speed;
    public $fuelType;  // New property

    public function drive() {
        echo "The car is moving!";
    }
}

$car = new Car();
$car->fuelType = "Gasoline";
3. Maintainability:
Code is modular and easier to update, as everything is divided into properties and methods.

Core OOP Concepts:
1. Encapsulation
Encapsulation controls access to an object's properties and methods using access modifiers (public, private, protected).

Example:

class Person {
    private $name;

    public function setName($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

$person = new Person();
$person->setName("John");
echo $person->getName(); // Output: John
2. Abstraction
Abstraction focuses on what an object does rather than how it does it. Abstract classes and methods define a template for child classes.

Example:

abstract class Animal {
    abstract public function makeSound();

    public function eat() {
        echo "Eating food.";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Woof!";
    }
}

$dog = new Dog();
$dog->makeSound(); // Output: Woof!
$dog->eat();       // Output: Eating food.
3. Inheritance
Inheritance allows a child class to inherit properties and methods from a parent class, promoting code reuse.

Example:
class Vehicle {
    public $brand;

    public function drive() {
        echo "Driving the vehicle!";
    }
}

class Car extends Vehicle {
    public $color;

    public function engine() {
        echo "V8 engine!";
    }
}

$myCar = new Car();
$myCar->brand = "BMW";
$myCar->color = "Red";
$myCar->drive();   // Output: Driving the vehicle!
$myCar->engine();  // Output: V8 engine!
4. Polymorphism
Polymorphism allows methods to behave differently based on the object calling them.

Example:
class Animal {
    public function makeSound() {
        echo "Some sound...";
    }
}

class Cat extends Animal {
    public function makeSound() {
        echo "Meow!";
    }
}

class Dog extends Animal {
    public function makeSound() {
        echo "Woof!";
    }
}

$cat = new Cat();
$cat->makeSound(); // Output: Meow!

$dog = new Dog();
$dog->makeSound(); // Output: Woof!
Special Features in PHP OOP:
Magic Methods:
__construct and __destruct are special methods used to initialize and clean up resources.

Example:

class Database {
    private $connection;

    public function __construct() {
        $this->connection = mysqli_connect("localhost", "user", "password", "database");
        echo "Connection established.";
    }

    public function __destruct() {
        mysqli_close($this->connection);
        echo "Connection closed.";
    }
}

$db = new Database();
// Destructor will automatically close the connection.
Challenges:
1. Create a New Car Class:
Properties: color, speed, brand.
Objects:
Car 1: Red, 100 km/h, Toyota.
Car 2: Blue, 150 km/h, BMW.
Display car information using echo.
2. Add a New Method:
Add a method getCarInfo() to return car details (color, speed, brand).
Use this method to display car information.
Abstract Class vs Interface:
An abstract class may include both abstract and concrete methods.
An interface defines only abstract methods and must be implemented fully by a class.
Example: Abstract Class

abstract class Animal {
    abstract public function makeSound();
}

class Dog extends Animal {
    public function makeSound() {
        echo "Woof!";
    }
}
Example: Interface

interface AnimalInterface {
    public function makeSound();
}

class Cat implements AnimalInterface {
    public function makeSound() {
        echo "Meow!";
    }
}


<?php

class Voiture {
    public $matricule;
    private $couleur;

    public function __construct($matricule, $couleur = "Blue") {
        $this->matricule = $matricule;
        $this->couleur = $couleur;
    }

    public function getDetails() {
        return "Matricule: $this->matricule, Couleur: $this->couleur";
    }
}

$voiture = new Voiture("BMW", "Black");
echo $voiture->getDetails(); // Output: Matricule: BMW, Couleur: Black


1. Simple Example of Overloading
Scenario:
You have a class that represents a person, and you want to add properties like name or age dynamically without defining them beforehand.



class Person {
    private $data = [];

    // Magic method to set undefined properties
    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    // Magic method to get undefined properties
    public function __get($name) {
        return $this->data[$name] ?? "Property does not exist";
    }
}

$person = new Person();

// Add dynamic properties
$person->name = "Ahmed";
$person->age = 25;

// Print the properties
echo "Name: " . $person->name . "<br>"; // Name: Ahmed
echo "Age: " . $person->age . "<br>";  // Age: 25
echo "Nationality: " . $person->nationality . "<br>"; // Property does not exist
2. Simple Example of Overriding
Scenario:
You have a class that represents an animal, and each type of animal makes a different sound.


class Animal {
    public function makeSound() {
        echo "Generic animal sound<br>";
    }
}

class Dog extends Animal {
    // Override the method to make a different sound
    public function makeSound() {
        echo "Dog says: Woof Woof<br>";
    }
}

class Cat extends Animal {
    // Override the method to make a different sound
    public function makeSound() {
        echo "Cat says: Meow<br>";
    }
}

$generalAnimal = new Animal();
$generalAnimal->makeSound(); // Generic animal sound

$dog = new Dog();
$dog->makeSound(); // Dog says: Woof Woof

$cat = new Cat();
$cat->makeSound(); // Cat says: Meow
Key Differences in the Examples:
Overloading: Allows adding dynamic properties without defining them beforehand (e.g., name and age).
Overriding: Changes the default behavior of a method to provide specific functionality (e.g., different animal sounds).
       
            
                  
                        
                               
                                      
                                               
                                                       
                                                                
                                                                          
                                                                                   
                                                                                            
                                                                                                      
                                                                                                                 
                                                                                                                          
                                                                                                                                