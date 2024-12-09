<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $popularMovies = $this->mediaRepository->findPopular();

        return $this->render('index.html.twig', [
            'popularMovies' => $popularMovies,
        ]);
    }
}
