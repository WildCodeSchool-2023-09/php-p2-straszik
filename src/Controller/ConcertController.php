<?php

namespace App\Controller;

use App\Model\ConcertManager;

class ConcertController extends AbstractController
{
    public function index(): string
    {
        $concertManager = new ConcertManager();
        $concert = $concertManager->selectAllConcert();
        return $this->twig->render('Concert/concert.html.twig', ['concert' => $concert]);
    }

    public function indexAdmin(): string
    {
        if (!$this->admin) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $concertManager = new ConcertManager();
            $concert = $concertManager->selectAllConcert();

            return $this->twig->render('Admin/ConcertAdmin/index.html.twig', ['concerts' => $concert]);
        }
    }

    public function new(): string
    {
        if (!$this->admin) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $errors = [];
            $errorsFile = [];
            $uploadDir = './../public/assets/images/goodies/';

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $data = array_map('trim', $_POST);
                $fileName = $_FILES['affiche']['name'];

                $errors = $this->verifForm($data);

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir);
                }
                $errorsFile = $this->verifAffiche($_FILES['affiche']);

                if (empty($errorsFile) && empty($errors)) {
                    $concertManager = new ConcertManager();
                    $data["affiche"] = $fileName;

                    move_uploaded_file($_FILES["affiche"]["tmp_name"], $uploadDir . $fileName);
                    $concertManager->insert($data);
                    header("Location: /admin/ConcertAdmin");
                }
            }

            return $this->twig->render(
                "Admin/ConcertAdmin/new.html.twig",
                ["errors" => $errors, "errorsFile" => $errorsFile]
            );
        }
    }

    public function edit(int $id): string
    {
        if (!$this->admin) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $concertManager = new ConcertManager();
            $concert = $concertManager->selectOneById($id);
            $errors = [];
            $errorsFile = [];
            $uploadDir = './../public/assets/images/concert/';

            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                $data = array_map('trim', $_POST);
                $fileName = $_FILES['affiche']['name'];

                $errors = $this->verifForm($data);

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir);
                }

                $errorsFile = $this->verifAffiche($_FILES['affiche']);

                if (empty($errorsFile) && empty($errors)) {
                    $concertManager = new ConcertManager();
                    $data["affiche"] = $fileName;
                    $data["id"] = $id;

                    move_uploaded_file($_FILES["affiche"]["tmp_name"], $uploadDir . $fileName);
                    $concertManager->update($data);
                    header("Location: /admin/ConcertAdmin");
                }
            }

            return $this->twig->render(
                "Admin/ConcertAdmin/edit.html.twig",
                ["concert" => $concert, "errors" => $errors, "errorsFile" => $errorsFile]
            );
        }
    }

    public function delete(int $id)
    {
        if (!$this->admin) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $concertManager = new concertManager();
            $concertManager->delete($id);
            header('Location: /admin/ConcertAdmin');
        }
    }


    public function verifAffiche(array $file): array
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
        }

        return $errors;
    }
}
