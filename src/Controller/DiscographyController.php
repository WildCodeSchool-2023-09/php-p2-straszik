<?php

namespace App\Controller;

use App\Model\DiscographyManager;

class DiscographyController extends AbstractController
{
    public function index(): string
    {
        $discographyManager = new DiscographyManager();
        $albums = $discographyManager->selectAllAlbum();
        $songs = $discographyManager->selectAllSongs();
        return $this->twig->render('discography/discography.html.twig', ['albums' => $albums, 'songs' => $songs]);
    }
}
