<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Entity\Movie;
use App\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class MovieController extends AbstractController
{
    #[Route('/media/{id}', name: 'movie_detail')]
    public function detail(Media $media): Response
    {
        return $this->render('movie/detail.html.twig', [
            'media' => $media,
        ]);
    }

    #[Route('/media/detail-serie', name: 'movie_detail_serie')]
    public function detail_serie(): Response
    {
        return $this->render('movie/detail_serie.html.twig');
    }
}
