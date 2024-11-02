<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Language;
use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category = [
            'Action',
            'Adventure',
            'Comedy',
            'Crime',
            'Drama',
            'Fantasy',
            'Historical',
            'Horror',
            'Mystery',
            'Political',
            'Romance',
            'Science Fiction',
            'Thriller',
            'Western',
        ];

        foreach ($category as $key => $value) {
            $category = new Category();
            $category->setName($value);
            $category->setLabel(strtolower($value));
            $manager->persist($category);
        }

        $language = [
            'English',
            'French',
            'German',
            'Italian',
            'Japanese',
            'Korean',
            'Spanish',
        ];


        $movie = new Movie();
        $movie->setTitle('Avatar');
        $movie->setShortDescription('A paraplegic marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.');


        $manager->flush();
    }
}
