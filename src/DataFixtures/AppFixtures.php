<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use DateTimeImmutable;
use App\Entity\Question;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create('fr_FR');

        
        $users = [];
        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user
            ->setUsername($faker->firstName() . '_' . $faker->lastName())
            ->setAvatar($faker->imageUrl(640, 480, 'person', true))
            ->setEmail($faker->safeEmail())
            ->setPassword($faker->sha256())
            ->setIsSubscribed($faker->boolean())
            ->setRoles(['ROLE_USER']);
                
            $users[] = $user;
            $manager->persist($user);
            $users[] = $user;
        }

        $questions = [];
        for ($i = 0; $i < 10; $i++) // question
        {
            $question = new Question();
            $question
                ->setTitle($faker->words(30, true))
                ->setSendAt(DateTimeImmutable::createFromMutable($faker->dateTime()))
                ->setContent($faker->sentence(30));

            $manager->persist($question);
            $questions[] = $question;
        }
        
        $manager->flush();
    }
}
