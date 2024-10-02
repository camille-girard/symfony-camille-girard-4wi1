<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin', name: 'admin_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/admin.html.twig');
    }

    #[Route(path: '/admin/add-films', name: 'admin_add_films')]
    public function addFilms(): Response
    {
        return $this->render('admin/admin_add_films.html.twig');
    }

    #[Route(path: '/admin/films', name: 'admin_films')]
    public function films(): Response
    {
        return $this->render('admin/admin_films.html.twig');
    }

    #[Route(path: '/admin/users', name: 'admin_users')]
    public function users(): Response
    {
        return $this->render('admin/admin_users.html.twig');
    }
}
