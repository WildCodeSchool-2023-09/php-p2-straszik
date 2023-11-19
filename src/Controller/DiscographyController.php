<?php

namespace App\Controller;

use App\Model\DiscographyManager;

class DiscographyController extends AbstractController
{
    public function index(): string
    {
        $discographyManager = new DiscographyManager();
        $albums = $discographyManager->selectAllAlbum();
        $songs = $discographyManager->selectAllSongs();
        return $this->twig->render(
            'discography/discography.html.twig',
            ['albums' => $albums, 'songs' => $songs]
        );
    }

    public function indexAdmin(): string
    {
        $discographyManager = new DiscographyManager();
        $albums = $discographyManager->selectAllAlbum();
        $songs = $discographyManager->selectAllSongs();
        return $this->twig->render(
            'Admin/DiscoAdmin/index.html.twig',
            ['albums' => $albums, 'songs' => $songs]
        );
    }

    public function newAlbum()
    {
        $errors = [];
        $errorsFile = [];
        $uploadDir = './../public/assets/images/albums/';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $fileName = $_FILES['image']['name'];

            $errors = $this->verifForm($data);
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            $errorsFile = $this->verifImage($_FILES['image']);
            if (empty($errorsFile) && empty($errors)) {
                $discographyManager = new DiscographyManager();
                $data["picture"] = $fileName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $fileName);
                $discographyManager->insertAlbum($data, $fileName);
                header('Location: /admin/DiscoAdmin');
            }
        }
        return $this->twig->render(
            'Admin/DiscoAdmin/newAlbum.html.twig',
            ["errors" => $errors, "errorsFile" => $errorsFile]
        );
    }

    public function newSong()
    {
        $errors = [];
        $discographyManager = new DiscographyManager();

        $albums = $discographyManager->selectAllAlbum();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->verifForm($data);

            if (empty($errors)) {
                $discographyManager->insertSong($data);
                header('Location: /admin/DiscoAdmin');
            }
        }
        return $this->twig->render(
            'Admin/DiscoAdmin/newSong.html.twig',
            ["albums" => $albums]
        );
    }

    public function editAlbum(int $id)
    {
        $discographyManager = new DiscographyManager();
        $albums = $discographyManager->selectOneByIdAlbum($id);
        $errors = [];
        $errorsFile = [];
        $uploadDir = './../public/assets/images/albums/';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $fileName = $_FILES['image']['name'];

            $errors = $this->verifForm($data);

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            $errorsFile = $this->verifImage($_FILES['image']);

            if (empty($errorsFile) && empty($errors)) {
                $discographyManager = new DiscographyManager();
                $data["picture"] = $fileName;
                $data["id"] = $id;

                move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDir . $fileName);
                $discographyManager->updateAlbum($data, $fileName);
                header('Location: /admin/DiscoAdmin');
            }
        }
        return $this->twig->render(
            'Admin/DiscoAdmin/editAlbum.html.twig',
            ['albums' => $albums, "errors" => $errors, "errorsFile" => $errorsFile]
        );
    }

    public function editSong(int $id)
    {
        $discographyManager = new DiscographyManager();
        $songs = $discographyManager->selectOneByIdSong($id);
        $errors = [];
        $albumTitle = $discographyManager->selectOneByIdAlbum($songs['album_id']);
        $albums = $discographyManager->selectAllAlbum();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);
            $errors = $this->verifForm($data);
            if (empty($errors)) {
                $discographyManager = new DiscographyManager();
                $data["id"] = $id;
                $discographyManager->updateSong($data);
                header('Location: /admin/DiscoAdmin');
            }
        }
        return $this->twig->render(
            'Admin/DiscoAdmin/editSong.html.twig',
            ['songs' => $songs, 'album_title' => $albumTitle, 'errors' => $errors, 'albums' => $albums]
        );
    }

    public function deleteAlbum(int $id)
    {
        $discographyManager = new DiscographyManager();
        $discographyManager->deleteAlbum($id);
        header('Location: /admin/DiscoAdmin');
    }

    public function deleteSong(int $id)
    {
        $discographyManager = new DiscographyManager();
        $discographyManager->deleteSong($id);
        header('Location: /admin/DiscoAdmin');
    }

    public function verifForm(array $data): array
    {
        $errors = [];

        foreach ($data as $key => $champ) {
            if (empty($champ)) {
                $errors[$key] = "Le champ est vide";
            }
        }
        return $errors;
    }

    public function verifImage(array $file): array
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
            $errors["extension"] = "L'extension du fichier ne correspond 
            pas avec l'extension demandé";
        }
        return $errors;
    }
}
