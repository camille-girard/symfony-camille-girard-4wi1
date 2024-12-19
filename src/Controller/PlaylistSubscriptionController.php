<?php

namespace App\Controller;

use App\Entity\PlaylistSubscription;
use App\Form\PlaylistSubscriptionType;
use App\Repository\PlaylistSubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/playlist/subscription')]
final class PlaylistSubscriptionController extends AbstractController
{
    #[Route(name: 'app_playlist_subscription_index', methods: ['GET'])]
    public function index(PlaylistSubscriptionRepository $playlistSubscriptionRepository): Response
    {
        return $this->render('playlist_subscription/index.html.twig', [
            'playlist_subscriptions' => $playlistSubscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_playlist_subscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $playlistSubscription = new PlaylistSubscription();
        $form = $this->createForm(PlaylistSubscriptionType::class, $playlistSubscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($playlistSubscription);
            $entityManager->flush();

            return $this->redirectToRoute('app_playlist_subscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('playlist_subscription/new.html.twig', [
            'playlist_subscription' => $playlistSubscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_subscription_show', methods: ['GET'])]
    public function show(PlaylistSubscription $playlistSubscription): Response
    {
        return $this->render('playlist_subscription/show.html.twig', [
            'playlist_subscription' => $playlistSubscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_playlist_subscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PlaylistSubscription $playlistSubscription, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PlaylistSubscriptionType::class, $playlistSubscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_playlist_subscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('playlist_subscription/edit.html.twig', [
            'playlist_subscription' => $playlistSubscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_subscription_delete', methods: ['POST'])]
    public function delete(Request $request, PlaylistSubscription $playlistSubscription, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playlistSubscription->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($playlistSubscription);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_playlist_subscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
