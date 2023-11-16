<?php

namespace App\Controller\Component;

use App\Model\Component\NewsletterManager;

class NewsletterController
{
    public function verifFormNewsletter(array $verif): array
    {
        $errors = [];

        if (empty($verif["email"])) {
            $errors["emailNewsletter"] = "Veuillez remplir le champ !";
        }

        if (!filter_var($verif["email"], FILTER_VALIDATE_EMAIL)) {
            $errors["notEmailformatNewsletter"] = "Le mail n'est pas valide !";
        }

        if (!isset($verif['check_newsletter'])) {
            $errors["notcheck"] = "La case n'a pas été coché !";
        }

        return $errors;
    }

    public function addEmailNewletter(string $email): bool
    {

        $newsletterManager = new NewsletterManager();
        $newsletterManager->insert($email);
        $validate = true;
        return $validate;
    }
}
