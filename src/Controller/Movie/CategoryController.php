<?php

declare(strict_types=1);

namespace App\Controller\Movie;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category/{id}', name: 'movie_category')]
    public function category(
        string $id,
        CategoryRepository $categoryRepository,
    ): Response {
        $categories = $categoryRepository->findAll();
        $category = $categoryRepository->find($id);

        return $this->render('movie/category.html.twig', [
            'categories' => $categories,
            'category' => $category,
        ]);
    }

    #[Route('/category', name: 'movie_category_list')]
    public function categoryList(
        CategoryRepository $categoryRepository,
    ): Response {
        $categories = $categoryRepository->findAll();

        return $this->render('movie/lists.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/discover', name: 'movie_discover')]
    public function discover(
        CategoryRepository $categoryRepository,
    ): Response {
        $categories = $categoryRepository->findAll();

        return $this->render('movie/discover.html.twig', [
            'categories' => $categories,
        ]);
    }
}
