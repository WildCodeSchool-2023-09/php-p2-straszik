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
        $data = array_map('htmlentities', $data);
        $asideManager = new AsideManager();
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $errors = $asideManager->verifNewsletter($data);

            if (empty($errors)) {
                $asideManager->insert($data['email']);
                $validateInscription = true;
            }
        }

        return $this->twig->render('Home/index.html.twig', ["errors" => $errors,
        "validateInscription" => $validateInscription]);
    }
}
