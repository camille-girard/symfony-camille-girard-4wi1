<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Episode;
use App\Entity\Language;
use App\Entity\Movie;
use App\Entity\Season;
use App\Entity\Serie;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->setCategory($manager);
        $this->setLanguage($manager);
        $this->setMovie($manager);
        $this->setUsers($manager);
    }

    public function setCategory(ObjectManager $manager): void
    {
        $categories = [
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

        foreach ($categories as $value) {
            $category = new Category();
            $category->setNom($value);
            $category->setLabel(strtolower($value));
            $category->setIcon('https://img.icons8.com/ios/452/movie.png');
            $manager->persist($category);

        }

        $manager->flush();
    }

    public function setLanguage(ObjectManager $manager): void
    {
        $languages = [
            'English' => 'en',
            'French' => 'fr',
            'Spanish' => 'es',
            'German' => 'de',
            'Italian' => 'it',
            'Portuguese' => 'pt',
            'Dutch' => 'nl',
            'Russian' => 'ru',
            'Japanese' => 'ja',
            'Chinese' => 'zh',
            'Korean' => 'ko',
            'Arabic' => 'ar',
            'Hindi' => 'hi',
            'Turkish' => 'tr',
        ];

        foreach ($languages as $key => $value) {
            $language = new Language();
            $language->setNom($key);
            $language->setCode($value);
            $manager->persist($language);
        }

        $manager->flush();
    }

    public function setMovie(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movie->setTitle('Avatar');
        $movie->setLongDescription(
            'A paraplegic marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.'
        );
        $movie->setShortDescription(
            'A paraplegic marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.'
        );
        $movie->setReleaseDate(new \DateTimeImmutable('2009-12-18'));
        $movie->setCoverImage('https://fr.web.img4.acsta.net/pictures/22/08/25/09/04/2146702.jpg');
        $manager->persist($movie);

        $manager->flush();
    }

    public function setUsers(ObjectManager $manager): void
    {
        // Création d'un utilisateur simple
        $user = new User();
        $user->setEmail('user@example.com');
        $user->setUsername('user');
        $hashedPassword = $this->passwordHasher->hashPassword($user, 'password123');
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        // Création d'un administrateur
        $admin = new User();
        $admin->setEmail('cgirard24@myges.fr');
        $admin->setUsername('admin');
        $hashedPassword = $this->passwordHasher->hashPassword($admin, 'password!');
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin);

        $manager->flush();
    }
}
