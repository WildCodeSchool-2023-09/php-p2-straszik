<?php

namespace App\Controller;

use App\Model\BilletterieManager;

class BilletterieController extends AbstractController
{
    public function index(): string
    {
        $billetterieManager = new BilletterieManager();
        $billetterie = $billetterieManager->selectAllTicket();
        return $this->twig->render('Billetterie/billetterie.html.twig', ['billetterie' => $billetterie]);
    }
}
