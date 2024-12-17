<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route(path: '/', name: 'home')]

    public function home(): Response
    {
        return $this->render(view: 'index.html.twig');
    }
}
