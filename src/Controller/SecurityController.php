<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;


class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function forgotPassword(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        if ($request->isMethod('POST')) {
            $email = $request->get('_email');

            // Rechercher l'utilisateur par email
            $user = $entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

            if (!$user) {
                $this->addFlash('error', 'Aucun utilisateur trouvé avec cette adresse email.');
            } else {
                // Générer un token de réinitialisation UUID
                $resetToken = Uuid::v4()->toRfc4122();
                $user->setResetToken($resetToken);

                // Sauvegarder le token en base de données
                $entityManager->persist($user);
                $entityManager->flush();

                // Envoyer l'email de réinitialisation
                $email = (new TemplatedEmail())
                    ->from('noreply@streemi.com')
                    ->to($user->getEmail())
                    ->subject('Réinitialisation de votre mot de passe')
                    ->htmlTemplate('email/reset.html.twig')
                    ->context([
                        'resetToken' => $resetToken,
                        'userEmail' => $user->getEmail(),
                    ]);

                $mailer->send($email);

                $this->addFlash('success', 'Un email de réinitialisation vous a été envoyé.');
            }

            return $this->redirectToRoute('app_forgot_password');
        }

        return $this->render('auth/forgot.html.twig');
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/reset-password/{token}', name: 'app_reset_password')]
    public function resetPassword(string $token, Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['resetToken' => $token]);

        if (!$user) {
            $this->addFlash('error', 'Token invalide ou expiré.');
            return $this->redirectToRoute('app_forgot_password');
        }

        // Traitez le formulaire de réinitialisation ici (à implémenter selon vos besoins)

        return $this->render('auth/reset_password.html.twig', [
            'token' => $token,
        ]);
    }
}
