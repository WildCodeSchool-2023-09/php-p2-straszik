<?php

namespace App\Controller;

use App\Model\ConcertManager;

class ConcertController extends AbstractController
{
    public function index(): string
    {
        $concertManager = new ConcertManager();
        $concerts = $concertManager->selectAllConcerts();
        return $this->twig->render('Concert/concert.html.twig', ['concerts' => $concerts]);
    }
}
