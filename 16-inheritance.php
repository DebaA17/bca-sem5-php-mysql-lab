<?php
class Animal {
    public function eat() {
        echo 'Animal is eating<br>';
    }
}

class Dog extends Animal {
    public function bark() {
        echo 'Dog is barking';
    }
}

$d = new Dog();
$d->eat();
$d->bark();
?>
