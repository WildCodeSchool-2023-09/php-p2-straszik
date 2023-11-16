<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\ForgotPasswordManager;

class ForgotPasswordController extends AbstractController
{
    public function index(): string
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map("trim", $_POST);
            $email = ($data["email"]);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["formatEmail"] = "Format email non reconnu";
            }

            if (empty($data['email'])) {
                $errors["email"] = "Le mail est obligatoire";
            }

            if (empty($data['password'])) {
                $errors["password"] = "Le password est obligatoire";
            }

            if ($data['confirmPassword'] !== ($data['password'])) {
                $errors["confirmPassword"] = "Le mot de passe ne correspond pas";
            }

            if (empty($errors)) {
                $forgotPassManager = new ForgotPasswordManager();

                if (!empty($forgotPassManager->verifyEmail($email))) {
                    $forgotPassManager->forgotPassword($email, $data["password"]);
                    header("Location: /login");
                } else {
                    $errors["verifEmail"] = "le mail n'existe pas, veuillez créer un compte";
                }
            }
        }
        return $this->twig->render('ForgotPassword/forgotPassword.html.twig', ['errors' => $errors]);
    }
}
