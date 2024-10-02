<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    #[Route(path: '/movie/category', name: 'movie_category')]
    public function category(): Response
    {
        return $this->render('movie/category.html.twig');
    }

    #[Route(path: '/movie/detail', name: 'movie_detail')]
    public function detail(): Response
    {
        return $this->render('movie/detail.html.twig');
    }

    #[Route(path: '/movie/detail-serie', name: 'movie_detail_serie')]
    public function detailSerie(): Response
    {
        return $this->render('movie/detail_serie.html.twig');
    }

    #[Route(path: '/movie/discover', name: 'movie_discover')]
    public function discover(): Response
    {
        return $this->render('movie/discover.html.twig');
    }

    #[Route(path: '/movie/lists', name: 'movie_lists')]
    public function lists(): Response
    {
        return $this->render('movie/lists.html.twig');
    }
}
