<?php

declare(strict_types=1);

namespace App\Controller\Other;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class UploadController extends AbstractController
{
    #[Route('/upload', name: 'upload')]
    public function index(): Response
    {
        return $this->render('other/upload.html.twig');
    }
}
