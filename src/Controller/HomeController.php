<?php

namespace App\Controller;

use App\Model\HomeManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $homeManager = new HomeManager();
        $categories = $homeManager->selectLast3Categories();
        $news = $homeManager->selectLast3News();
        return $this->twig->render('Home/index.html.twig', ['categories' => $categories, 'news' => $news]);
    }
}
