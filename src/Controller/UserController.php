<?php

namespace App\Controller;

use App\Controller\AbstractController;
use App\Model\UserManager;

class UserController extends AbstractController
{
    public function login()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['email'])) {
                $errors['email'] = 'Veuillez saisir votre email !';
            }

            if (empty($_POST['password'])) {
                $errors['password'] = 'Veuillez saisir votre mot de passe !';
            }

            if (!$errors) {
                $userManager = new UserManager();
                $userData = $userManager->userLogin($_POST);

                if ($userData) {
                    $_SESSION['isLogin'] = true;
                    $_SESSION['user_id'] = $userData['id'];
                    $_SESSION['status'] = $userData['status'];
                    header('location: /');
                } else {
                    $errors['login'] = 'Mail ou Mot de passe incorrect !';
                }
            }
        }

        $errorsbool = !empty($errors);
        return $this->twig->render(
            'admin/connection.html.twig',
            ['errors' => $errors, 'errorsbool' => $errorsbool]
        );
    }
}
