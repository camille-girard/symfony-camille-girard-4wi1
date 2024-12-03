<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    #[Route('/media/{id}', name: 'media_detail')]
    public function detail(int $id): Response
    {
        $movie = $this->movieRepository->find($id);

        if (!$movie) {
            throw $this->createNotFoundException('The media does not exist');
        }

        return $this->render('movie/detail.html.twig', [
            'movie' => $movie,
        ]);
    }
}
