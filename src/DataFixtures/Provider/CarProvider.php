<?php

namespace App\DataFixtures\Provider;

class CarProvider
{
    //Table of 50 cars available for the Fixtures
    private $car= [
        "Abarth",
        "Acura",
        "Alfa Romeo",
        "Aston Martin",
        "Audi",
        "Bentley",
        "BMW",
        "Buick.sd",
        "Porsche",
        "Tesla",
        "Kia",
        "Peugeot",
        "Honda",
        "Jaguar", 
        "Mazda",
        "Volvo",
        "Toyota",
        "Ford",
        "Mercedes-Benz",
        "Renault",
        "Kia"
];



    private $categories= [
        "SUV",
        "Sportback",
        "Full Electric",
    ];

        /**
     * Return a random car
     */
    public function getRandomCarName()
    {
        return $this->car[array_rand($this->car)];
    }

    /**
     * Return a random category
     */
    public function getRandomCategoriesName()
    {
        return $this->categories[array_rand($this->categories)];
    }
}