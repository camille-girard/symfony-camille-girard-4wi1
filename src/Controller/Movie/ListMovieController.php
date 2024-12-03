<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Repository\CategoryRepository;
use App\Repository\PlaylistRepository;
use App\Repository\PlaylistSubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ListMovieController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/movie', name: 'movie_lists')]
    public function index(
        PlaylistSubscriptionRepository $playlistSubscriptionRepository,
        PlaylistRepository $playlistRepository,
        CategoryRepository $categoryRepository,
        Request $request
    ): Response {
        $myPlaylists = $playlistRepository->findAll();
        $subscribedPlaylists = $playlistSubscriptionRepository->findAll();
        $categories = $categoryRepository->findAll();

        $selectedPlaylistId = $request->query->get('playlist');
        $selectedPlaylist = $selectedPlaylistId
            ? $playlistRepository->find($selectedPlaylistId)
            : null;

        return $this->render('movie/lists.html.twig', [
            'myPlaylists' => $myPlaylists,
            'subscribedPlaylists' => $subscribedPlaylists,
            'selectedPlaylist' => $selectedPlaylist,
            'categories' => $categories,
        ]);
    }
}
