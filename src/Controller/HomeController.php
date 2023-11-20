<?php

namespace App\Controller;

use App\Controller\Component\NewsletterController;
use App\Model\HomeManager;

class HomeController extends AbstractController
{
    public function index(): string
    {
        $homeManager = new HomeManager();
        $categories = $homeManager->selectLast3Categories();
        $news = $homeManager->selectLast3News();

        $errors = [];
        $validateInscription = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            if (isset($_POST["registerNewsletter"])) {
                $newsletterController = new NewsletterController();
                $errors = $newsletterController->verifFormNewsletter($data);



                if (empty($errors)) {
                    if ($newsletterController->verifEmailExisting($data['email'])) {
                        $validateInscription = $newsletterController->addEmailNewletter($data['email']);
                    } else {
                        $errors[] = "L'adresse email est déjà enregistrer dans notre newsletter !";
                    }
                }
            }
        }

        return $this->twig->render('Home/index.html.twig', ['categories' => $categories, 'news' => $news
        , "errors" => $errors,
        "validateInscription" => $validateInscription]);
    }
}
