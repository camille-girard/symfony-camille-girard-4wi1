<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\MediaRepository;

class HomeController extends AbstractController
{
    #[Route(path: '/', name: 'home')]
    public function home(MediaRepository $mediaRepository): Response
    {
        $popularMovies = $mediaRepository->findPopular();

        return $this->render('index.html.twig', [
            'popularMovies' => $popularMovies,
        ]);
    }
}
