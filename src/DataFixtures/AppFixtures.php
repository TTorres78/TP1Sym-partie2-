<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Faker\Factory;
use App\Entity\Image;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

      

        for($i = 1; $i <= 30; $i++) {
            $articles = new Articles();


            $libelle = $faker->sentence();
            $image = $faker->imageUrl(1000,350);
            $description = $faker->paragraph(2);
            
            


            $articles->setLibelle($libelle)

            ->setImage($image)
            ->setDescription($description)
            ->setPrix(mt_rand(40,200));

            $manager->persist($articles);
        }

        $manager->flush();
    }
}
