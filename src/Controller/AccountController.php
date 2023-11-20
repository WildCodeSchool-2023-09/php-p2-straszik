<?php

namespace App\Controller;

use App\Model\AccountManager;

class AccountController extends AbstractController
{
    public function index(): string
    {
        $accountManager = new AccountManager();
        $users = $accountManager->selectAllUsers();
        return $this->twig->render('Users/account/index.html.twig', ['users' => $users]);
    }

    public function indexAdmin(): string
    {
        $accountManager = new AccountManager();
        $users = $accountManager->selectAllUsers();
        return $this->twig->render('Users/Account/userAdmin.html.twig', ['users' => $users]);
    }

    public function edit()
    {
        if (!isset($_SESSION['user_id'])) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $errors = [];
            $errorsEmail = [];
            $accountManager = new AccountManager();
            $idUser = $_SESSION["user_id"];

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if (isset($_POST['updateUser'])) {
                    $data = array_map('trim', $_POST);
                    $errors = $this->verifForm($data);

                    if (empty($errors['email'])) {
                        $errorsEmail = $this->verifEmail($data['email'], $idUser);
                    }

                    if (empty($errors) && empty($errorsEmail)) {
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        $data['id'] = $idUser;
                        $accountManager->update($data);
                        header('Location: /profil');
                    }
                }
                if (isset($_POST['deleteUser'])) {
                    $accountManager->delete((int)$idUser);
                    header('Location: /login');
                }
            }
            $users = $accountManager->selectOneById($idUser);
            return $this->twig->render('Users/Account/index.html.twig', ["errors" => $errors,
            "errorsEmail" => $errorsEmail, 'user' => $users]);
        }
    }

    public function verifForm(array $data): array
    {
        $errors = [];

        foreach ($data as $key => $champ) {
            if (empty($champ) && $key !== 'updateUser' && $key !== 'deleteUser') {
                $errors[$key] = "Le champs est vide";
            }
        }
        return $errors;
    }

    public function verifEmail(string $email, int $id): array
    {
        $errorsEmail = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorsEmail["failFormatEmail"] = "L'email n'est pas au bon format";
        }

        $accountManager = new AccountManager();
        if (empty($accountManager->selectOneById($id))) {
            $errorsEmail["notEmail"] = "Veuillez saisir votre adresse email";
        }
        return $errorsEmail;
    }
}
