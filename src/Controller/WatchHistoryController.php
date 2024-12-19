<?php

namespace App\Controller;

use App\Entity\WatchHistory;
use App\Form\WatchHistoryType;
use App\Repository\WatchHistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/watch/history')]
final class WatchHistoryController extends AbstractController
{
    #[Route(name: 'app_watch_history_index', methods: ['GET'])]
    public function index(WatchHistoryRepository $watchHistoryRepository): Response
    {
        return $this->render('watch_history/index.html.twig', [
            'watch_histories' => $watchHistoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_watch_history_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $watchHistory = new WatchHistory();
        $form = $this->createForm(WatchHistoryType::class, $watchHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($watchHistory);
            $entityManager->flush();

            return $this->redirectToRoute('app_watch_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('watch_history/new.html.twig', [
            'watch_history' => $watchHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_watch_history_show', methods: ['GET'])]
    public function show(WatchHistory $watchHistory): Response
    {
        return $this->render('watch_history/show.html.twig', [
            'watch_history' => $watchHistory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_watch_history_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, WatchHistory $watchHistory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(WatchHistoryType::class, $watchHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_watch_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('watch_history/edit.html.twig', [
            'watch_history' => $watchHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_watch_history_delete', methods: ['POST'])]
    public function delete(Request $request, WatchHistory $watchHistory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$watchHistory->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($watchHistory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_watch_history_index', [], Response::HTTP_SEE_OTHER);
    }
}
