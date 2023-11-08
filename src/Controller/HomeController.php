<?php

namespace App\Controller;

use App\Model\Component\AsideManager;

class HomeController extends AbstractController
{
    /**
     * Display home page
     */
    public function index(): string
    {
        $errors = [];
        $validateInscription = false;
        $data = array_map('trim', $_POST);

        $asideManager = new AsideManager();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $errors = $this->verifNewsletter($data);

            if (empty($errors)) {
                $asideManager->insert($data['email']);
                $validateInscription = true;
            }
        }

        return $this->twig->render('Home/index.html.twig', ["errors" => $errors,
        "validateInscription" => $validateInscription]);
    }

    public function verifNewsletter(array $verif): array
    {
        $errors = [];

        if (empty($verif["email"])) {
            $errors[] = "Veuillez remplir le champ !";
        }

        if (!filter_var($verif["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Le mail n'est pas valide !";
        }

        return $errors;
    }
}
