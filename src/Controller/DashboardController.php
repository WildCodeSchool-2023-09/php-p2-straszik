<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\HomeManager;
use App\Model\DiscographyManager;

class DashboardController extends AbstractController
{
    public function index()
    {
        if (!$this->admin) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $homeManager = new HomeManager();
            $discographyManager = new DiscographyManager();
            $categories = $homeManager->selectLast3Categories();
            $news = $homeManager->selectLast3News();
            $albums = $discographyManager->selectAllAlbum();
            $songs = $discographyManager->selectAllSongs();

            return $this->twig->render(
                'Admin/dashboard/index.html.twig',
                ['categories' => $categories, 'news' => $news,
                'albums' => $albums, 'songs' => $songs
                ]
            );
        }
    }
}
