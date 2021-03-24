<?php

namespace App\DataFixtures;

use App\Entity\Wish;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //La locale n'est pas obligatoire
        $faker = \Faker\Factory::create("fr_FR");

        //éxécute le code 200 fois pour remplir la BDD et tester le code
        for ($i = 0; $i < 200; $i++) {

            //crée un wish vide
            $wish = new Wish();

            //hydrate le wish
            $wish->setTitle($faker->sentence);
            $wish->setDescription($faker->text);
            $wish->setAuthor($faker->userName);
            $wish->setIsPublished($faker->boolean(90));
            $wish->setDateCreated($faker->dateTimeBetween('- 2 years'));
            $wish-> setLikes($faker->numberBetween(0,5000));

            //demande à doctrine de sauvegarder ce wish
            $manager->persist($wish);

            //éxécute la requête sql
            $manager->flush();
        }
    }
}
