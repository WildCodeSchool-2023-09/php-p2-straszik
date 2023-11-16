<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\GoodiesManager;

class GoodiesController extends AbstractController
{
    public function index(): string
    {

        $errors = [];
        $validateInscription = false;

        $goodiesManager = new GoodiesManager();
        $goodies = $goodiesManager->selectAllGoodies();

        return $this->twig->render("Goodies/goodies.html.twig", ["errors" => $errors,
        "validateInscription" => $validateInscription, "goodies" => $goodies]);
    }
}
