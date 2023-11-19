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

        if (!isset($verif['check_newsletter']) && isset($verif['registerNewsletter'])) {
            $errors["notcheck"] = "La case n'a pas été coché !";
        }

        return $errors;
    }

    public function verifEmailExisting(string $email): bool
    {

        $newsletterManager = new NewsletterManager();
        $newsletterManager->selectOneByEmail($email) ?  $validate = false :  $validate = true;
        return $validate;
    }

    public function addEmailNewletter(string $email): bool
    {

        $newsletterManager = new NewsletterManager();
        $newsletterManager->insert($email);
        $validate = true;
        return $validate;
    }

    public function unscribeNewsletter()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array_map('trim', $_POST);

            $errors = $this->verifFormNewsletter($data);

            if (empty($errors)) {
                $newsletterManager = new NewsletterManager();
                $emailUser = $newsletterManager->selectOneByEmail($data['email']);

                if ($emailUser) {
                    $newsletterManager->delete($emailUser["id"]);
                    return json_encode(["deleteEmail" => "Votre adresse email à bien 
                    été supprimé de notre newsletter !"]);
                } else {
                    return json_encode(["emailNotExist" => "Votre email n'existe pas dans notre newsletter !"]);
                }
            } else {
                return json_encode(["errors" => $errors]);
            }
        }
    }
}
