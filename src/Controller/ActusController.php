<?php

namespace App\Controller;

use App\Model\ActusManager;

class ActusController extends AbstractController
{
    public function index(): string
    {
        $actusManager = new ActusManager();
        $categories = $actusManager->selectAllCategories();
        $news = $actusManager->selectAllNews();
        return $this->twig->render('Actus/actus.html.twig', ['categories' => $categories, 'news' => $news]);
    }
}
