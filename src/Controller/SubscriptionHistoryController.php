<?php

namespace App\Controller;

use App\Entity\SubscriptionHistory;
use App\Form\SubscriptionHistoryType;
use App\Repository\SubscriptionHistoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/subscription/history')]
final class SubscriptionHistoryController extends AbstractController
{
    #[Route(name: 'app_subscription_history_index', methods: ['GET'])]
    public function index(SubscriptionHistoryRepository $subscriptionHistoryRepository): Response
    {
        return $this->render('subscription_history/index.html.twig', [
            'subscription_histories' => $subscriptionHistoryRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_subscription_history_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $subscriptionHistory = new SubscriptionHistory();
        $form = $this->createForm(SubscriptionHistoryType::class, $subscriptionHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($subscriptionHistory);
            $entityManager->flush();

            return $this->redirectToRoute('app_subscription_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subscription_history/new.html.twig', [
            'subscription_history' => $subscriptionHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_subscription_history_show', methods: ['GET'])]
    public function show(SubscriptionHistory $subscriptionHistory): Response
    {
        return $this->render('subscription_history/show.html.twig', [
            'subscription_history' => $subscriptionHistory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_subscription_history_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SubscriptionHistory $subscriptionHistory, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SubscriptionHistoryType::class, $subscriptionHistory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_subscription_history_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('subscription_history/edit.html.twig', [
            'subscription_history' => $subscriptionHistory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_subscription_history_delete', methods: ['POST'])]
    public function delete(Request $request, SubscriptionHistory $subscriptionHistory, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscriptionHistory->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($subscriptionHistory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_subscription_history_index', [], Response::HTTP_SEE_OTHER);
    }
}
