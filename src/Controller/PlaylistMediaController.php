<?php

namespace App\Controller;

use App\Entity\PlaylistMedia;
use App\Form\PlaylistMediaType;
use App\Repository\PlaylistMediaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/playlist/media')]
final class PlaylistMediaController extends AbstractController
{
    #[Route(name: 'app_playlist_media_index', methods: ['GET'])]
    public function index(PlaylistMediaRepository $playlistMediaRepository): Response
    {
        return $this->render('playlist_media/index.html.twig', [
            'playlist_media' => $playlistMediaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_playlist_media_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playlistMedia = new PlaylistMedia();
        $form = $this->createForm(PlaylistMediaType::class, $playlistMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlistMedia);
            $entityManager->flush();

            return $this->redirectToRoute('app_playlist_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('playlist_media/new.html.twig', [
            'playlist_media' => $playlistMedia,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_media_show', methods: ['GET'])]
    public function show(PlaylistMedia $playlistMedia): Response
    {
        return $this->render('playlist_media/show.html.twig', [
            'playlist_media' => $playlistMedia,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_playlist_media_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlaylistMedia $playlistMedia, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaylistMediaType::class, $playlistMedia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_playlist_media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('playlist_media/edit.html.twig', [
            'playlist_media' => $playlistMedia,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_media_delete', methods: ['POST'])]
    public function delete(Request $request, PlaylistMedia $playlistMedia, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playlistMedia->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($playlistMedia);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_playlist_media_index', [], Response::HTTP_SEE_OTHER);
    }
}
