<?php

namespace App\DataFixtures;

use App\Entity\Show;
use App\Entity\Location;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Cocur\Slugify\Slugify;

class ShowFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $data = [
            [
                'slug' => null,
                'title' => 'Stomp',
                'description' => 'Un mélange d’explosions sonores, de rythme et de mouvement',
                'poster_url' => 'https://media.out.be/media/x900/q80/p51x57/lib/data/tbl_items/2024/9/162433/visuals/1726474936959.stomp.JPG',
                'duration' => 90,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Guarattelle di Pulcinella',
                'description' => '« Guarattella » est un ancien mot napolitain qui signifie « une situation initialement très simple qui évolue vers une situation très confuse »',
                'poster_url' => 'https://media.out.be/media/x900/q80/p50x20/lib/data/tbl_items/2026/4/207860/visuals/1776188987104.credit-ph_Virgilio-Ardy.jpg',
                'duration' => 120,
                'location_slug' => 'dexia-art-center',
                'bookable' => true,
            ],
            [
                'slug' => null,
                'title' => 'Ayiti',
                'description' => "Un homme est bloqué à l'aéroport.\n "
                    . 'Questionné par les douaniers, il doit alors justifier son identité, '
                    . 'et surtout prouver qu\'il est haïtien - qu\'est-ce qu\'être haïtien ?',
                'poster_url' => 'https://www.librairie-theatrale.com/cdn/shop/files/p6gw0fhyJheV-u5Kg2RzwBOCiYgQI-FpOfsYzXEwFzclyFdXG7L4QA-cover-large.jpg?v=1759909024',
                'duration' => 140,
                'location_slug' => 'espace-delvaux-la-venerie',
                'bookable' => true,

            ],
            [
                'slug' => null,
                'title' => 'Cible mouvante',
                'description' => "Dans ce « thriller d'anticipation », des adultes semblent alimenter "
                    . "et véhiculer une crainte féroce envers les enfants âgés entre 10 et 12 ans.",
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BZDg3ZjY2OGQtOGY4NC00MGM0LTgyMzktNWIxZmZjMmNmNDZmXkEyXkFqcGc@._V1_QL75_UY281_CR5,0,190,281_.jpg',
                'location_slug' => 'la-samaritaine',
                'duration' => 90,
                'bookable' => true,

            ],
            [
                'slug' => null,
                'title' => 'Ceci n\'est pas un chanteur belge',
                'description' => "Non peut-être ?!\nEntre Magritte (pour le surréalisme comique) "
                    . 'et Maigret (pour le réalisme mélancolique), ce dixième opus semalien propose '
                    . 'quatorze nouvelles chansons mêlées à de petits textes humoristiques et '
                    . 'à quelques fortes images poétiques.',
                'poster_url' => 'https://www.retouralarchipel.net/claudesemal/Icono/Spectacles/Ceci/2012Ceciaffiche.jpg',
                'location_slug' => 'espace-delvaux-la-venerie',
                'duration' => 60,
                'bookable' => false,

            ],
            [
                'slug' => null,
                'title' => 'Manneke… !',
                'description' => 'A tour de rôle, Pierre se joue de ses oncles, '
                    . 'tantes, grands-parents et surtout de sa mère.',
                'poster_url' => 'https://www.spectable.be/image/image/K/souper-spectacle-avec-les-manneken-peas_403170.jpg',
                'location_slug' => 'la-samaritaine',
                'duration' => 100,
                'bookable' => true,

            ]
        ];


        foreach ($data as $record) {
            $slugify = new Slugify();

            $show = new Show();
            $show->setSlug($slugify->slugify($record['title']));
            $show->setTitle($record['title']);
            $show->setDescription($record['description']);
            $show->setPosterUrl($record['poster_url']);
            $show->setDuration($record['duration']);
            $show->setBookable($record['bookable']);

            if ($record['location_slug']) {
                $show->setLocation($this->getReference($record['location_slug'], Location::class));
            }

            $manager->persist($show);

            $this->addReference($show->getSlug(), $show);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            LocationFixtures::class,
        ];
    }
}
