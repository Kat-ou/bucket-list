<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Reaction;
use App\Entity\Wish;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //La locale n'est pas obligatoire
        $faker = \Faker\Factory::create("fr_FR");

        //crée les catégories en dur
        $category = new Category();
        $category->setName('Travel & Adventure');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Sport');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Entertainment');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Human Relations');
        $manager->persist($category);

        $category = new Category();
        $category->setName('Others');
        $manager->persist($category);

        //éxécute la requete sql
        $manager->flush();


        // récupérer le tableau des catégories depuis la bdd
        $categories = $manager->getRepository(Category::class)->findAll();
        //éxécute le code 50 fois pour remplir la BDD et tester le code
        for ($i = 0; $i < 50; $i++) {

            //crée un wish vide
            $wish = new Wish();

            //hydrate le wish
            $wish->setTitle($faker->sentence);
            $wish->setDescription($faker->text);
            $wish->setAuthor($faker->userName);
            $wish->setIsPublished($faker->boolean(90));
            $wish->setDateCreated($faker->dateTimeBetween('- 2 years'));
            $wish->setLikes($faker->numberBetween(0, 5000));
            $wish->setCategory($faker->randomElement($categories));

            //demande à doctrine de sauvegarder ce wish
            $manager->persist($wish);

        }

        //éxécute la requête sql
        $manager->flush();

        // récupérer le tableau des wishes
        $wishes = $manager->getRepository(Wish::class)->findAll();

        for ($i = 0; $i < 100; $i++) {
            //crée un wish vide
            $reaction = new Reaction();
            $wish = $faker->randomElement($wishes);

            $reaction->setUsername($faker->userName);
            $reaction->setMessage($faker->realText());
            $reaction->setDateCreated($faker->dateTimeBetween($wish->getDateCreated()));
            $reaction->setWish($wish);

            //demande à doctrine de sauvegarder ce wish
            $manager->persist($reaction);

        }
        //éxécute la requête sql
        $manager->flush();


    }
}
