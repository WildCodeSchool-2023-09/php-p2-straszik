<?php

namespace App\Controller;

use App\Model\GoodiesManager;
use App\Controller\AbstractController;
use App\Controller\Component\NewsletterController;

class GoodiesController extends AbstractController
{
    public function index(): string
    {

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

            $goodiesManager = new GoodiesManager();
            $goodies = $goodiesManager->selectAllGoodies();

            return $this->twig->render("Goodies/goodies.html.twig", ["errors" => $errors,
            "validateInscription" => $validateInscription, "goodies" => $goodies]);
    }

    public function indexAdmin(): string
    {
        $goodiesManager = new GoodiesManager();
        $goodies = $goodiesManager->selectAllGoodies('id', "DESC");
        return $this->twig->render(
            "Admin/GoodiesAdmin/admin_goodies.html.twig",
            ["goodies" => $goodies]
        );
    }

    public function edit(int $id): string
    {
        $goodieManager = new GoodiesManager();
        $goodie = $goodieManager->selectOneById($id);
        $errors = [];
        $errorsFile = [];
        $uploadDir = './../public/assets/images/goodies/';

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array_map('trim', $_POST);
            $fileName = $_FILES['image']['name'];

            $errors = $this->verifForm($data);

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            $errorsFile = $this->verifImageGoodie($_FILES['image']);

            if (empty($errorsFile) && empty($errors)) {
                $goodiesManager = new GoodiesManager();
                $data["picture"] = $fileName;
                $data["id"] = $id;

                move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $fileName);
                $goodiesManager->update($data);
                header("Location: /admin/GoodiesAdmin");
            }
        }

        return $this->twig->render(
            "Admin/GoodiesAdmin/admin_goodies_edit.html.twig",
            ["goodie" => $goodie, "errors" => $errors, "errorsFile" => $errorsFile]
        );
    }

    public function add(): string
    {
        $errors = [];
        $errorsFile = [];
        $uploadDir = './../public/assets/images/goodies/';

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $data = array_map('trim', $_POST);
            $fileName = $_FILES['image']['name'];

            $errors = $this->verifForm($data);

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            $errorsFile = $this->verifImageGoodie($_FILES['image']);

            if (empty($errorsFile) && empty($errors)) {
                $goodiesManager = new GoodiesManager();
                $data["picture"] = $fileName;

                move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $fileName);
                $goodiesManager->insert($data);
                header("Location: /admin/GoodiesAdmin");
            }
        }

        return $this->twig->render(
            "Admin/GoodiesAdmin/admin_goodies_add.html.twig",
            ["errors" => $errors, "errorsFile" => $errorsFile]
        );
    }

    public function delete(int $id)
    {
        $goodiesManager = new GoodiesManager();
        $goodiesManager->delete($id);
        header('Location: /admin/GoodiesAdmin');
    }

    public function verifImageGoodie(array $file): array
    {
        $errors = [];
        $authorizedExtension = ["jpg", "jpeg", "png", "webp"];
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $maxFileSize = 2000000;

        if ($file["error"] === 1 || (filesize($file["tmp_name"]) > $maxFileSize)) {
            $errors["error"] = "Votre fichier doit faire moins de 2 Mo";
        }

        if ($file['error'] === 4) {
            $errors["vide"] = 'Veuillez choisir un fichier à un envoyer !';
        }

        if (!in_array($extension, $authorizedExtension)) {
            $errors["extension"] = "L'extension du fichier ne correspond pas avec l'extension demandé";
        }

            return $errors;
    }

    public function verifForm(array $data): array
    {
            $errors = [];

        foreach ($data as $key => $champ) {
            if (empty($champ)) {
                $errors[$key] = "Le champs est vide";
            }

            if (intval($champ) <= 0 && $key === "price") {
                $errors["notPrice"] = "Le prix doit être supérieur à zéro !";
            }
        }

        return $errors;
    }
}
