<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Provider\CarProvider;
use Faker;

use App\Entity\Car;
use App\Entity\Category;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
    //Instantiation of the car entity and completion of the information via the faker
    $carProvider= new CarProvider();
    $faker = Faker\Factory::create('fr_FR');
    $carsList = [];
    for ($i=1; $i<50; $i++) {
        $car= new Car();
        $car->setName($carProvider->getRandomCarName());
        $car->setNbreSeats($faker->numberBetween(5, 7));
        $car->setNbreDoors($faker->numberBetween(3, 5));
        $car->setCost(sprintf($faker->randomFloat(2, 1500, 3000)));
        $carsList[] = $car;
        $manager->persist($car);
    }
    //Instantiation of the category entity and completion of the information via the faker
    $categoriesList = [];
    for ($j=1; $j<4; $j++) {
        $category= new Category();
        $category->setName($carProvider->getRandomCategoriesName());
        $categoriesList[] = $category;
        $manager->persist($category);
    }

    // Relation between Car and Category
    foreach ($carsList as $key => $car) {
        $nbMaxCategory = mt_rand(1, 4);
        for ($n=0; $n<=$nbMaxCategory; $n++) {
            $car->setCategory($categoriesList[ mt_rand(1, count($categoriesList) - 1
            ) ]);
            $manager->persist($car);
        }
    }


    $manager->flush();
        }
}

