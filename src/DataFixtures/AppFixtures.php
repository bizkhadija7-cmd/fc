<?php

namespace App\DataFixtures;

use App\Entity\Abonnement;
use App\Entity\Cours;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // ABONNEMENTS
        $types = ['Mensuel', 'Annuel', 'VIP', 'Étudiant'];

        for ($i = 0; $i < 10; $i++) {
            $abonnement = new Abonnement();

            $abonnement->setType($types[array_rand($types)]);

            $dateDebut = $faker->dateTimeBetween('-1 month', 'now');
            $dateFin = $faker->dateTimeBetween('now', '+1 year');

            $abonnement->setDateDebut($dateDebut);
            $abonnement->setDateFin($dateFin);

            $abonnement->setPrix($faker->randomFloat(2, 100, 2000));

            $manager->persist($abonnement);
        }

        // COURS
        $coursNames = ['Yoga', 'Crossfit', 'Musculation', 'Cardio', 'Zumba'];

        for ($i = 0; $i < 10; $i++) {
            $cours = new Cours();

            $cours->setNom($coursNames[array_rand($coursNames)]);
            $cours->setDateCours(
                $faker->dateTimeBetween('now', '+2 months')
            );
            $cours->setCoach($faker->name());

            $manager->persist($cours);
        }

        $manager->flush();
    }
}