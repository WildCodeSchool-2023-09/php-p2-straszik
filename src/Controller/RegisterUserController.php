<?php

namespace App\Controller;

use App\Model\RegisterUserManager;

class RegisterUserController extends AbstractController
{
    public function index(): string
    {
        $errors = [];
        $errorsEmail = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array_map('trim', $_POST);
            $errors = $this->verifForm($data);
            if (empty($errors['email'])) {
                $errorsEmail = $this->verifEmail($data['email']);
            }

            if (empty($errors) && empty($errorsEmail)) {
                $registerUserManager = new RegisterUserManager();
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                $registerUserManager->insertNewUser($data);
            }
        }

        return $this->twig->render("Users/register_user.html.twig", ["errors" => $errors,
        "errorsEmail" => $errorsEmail]);
    }

    public function verifForm(array $data): array
    {
        $errors = [];

        foreach ($data as $key => $champ) {
            if (empty($champ)) {
                $errors[$key] = "Le champs est vide";
            }
        }

        return $errors;
    }

    public function verifEmail(string $email): array
    {
        $errorsEmail = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorsEmail["failFormatEmail"] = "L'email n'est pas au bon format";
        }

        $registerUserManager = new RegisterUserManager();
        if (!empty($registerUserManager->selectOneByEmail($email))) {
            $errorsEmail["existEmail"] = "L'email est déjà présente dans la base de données";
        }

        return $errorsEmail;
    }
}
