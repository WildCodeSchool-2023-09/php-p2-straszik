<?php

namespace App\Controller;

use App\Model\ConcertManager;

class ConcertController extends AbstractController
{
    public function index(): string
    {
        $concertManager = new ConcertManager();
        $location = $concertManager->selectAllConcert();
        return $this->twig->render('concert/concert.html.twig', ['location' => $location]);
    }

    public function indexAdmin(): string
    {
        $concertManager = new ConcertManager();

        $location = $concertManager->selectAllConcert();
        return $this->twig->render('Admin/ConcertAdmin/index.html.twig', ['location' => $location]);
    }
}
