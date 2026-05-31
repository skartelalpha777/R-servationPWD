<?php

namespace App\DataFixtures;

use App\Entity\Show;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ShowFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // 1. Notre tableau de données avec les informations nécessaires
        $data = [
            [
                'slug' => '',
                'title' => 'Stomp',
                'description' => 'Un mélange d’explosions sonores, de rythme et de mouvement',
                'poster_URL' => 'https://media.out.be/media/x900/q80/p51x57/lib/data/tbl_items/2024/9/162433/visuals/1726474936959.stomp.JPG',
                'duration' => 90,
                'bookable' => true,
            ],
            [
                'slug' => '',
                'title' => 'Guarattelle di Pulcinella',
                'description' => '« Guarattella » est un ancien mot napolitain qui signifie « une situation initialement très simple qui évolue vers une situation très confuse »',
                'poster_URL' => 'https://media.out.be/media/x900/q80/p50x20/lib/data/tbl_items/2026/4/207860/visuals/1776188987104.credit-ph_Virgilio-Ardy.jpg',
                'duration' => 120,
                'bookable' => true,
            ]
        ];

        // 2. On boucle sur notre tableau pour créer les objets Show
        foreach ($data as $record) {
            $show = new Show();
            $show->setSlug($record['slug']);
            $show->setTitle($record['title']);
            $show->setDescription($record['description']);
            $show->setPosterURL($record['poster_URL']);
            $show->setDuration($record['duration']);
            $show->setBookable($record['bookable']);

            $manager->persist($show);
        }

        $manager->flush();
    }
}
