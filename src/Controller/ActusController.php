<?php

namespace App\Controller;

use App\Model\ActusManager;

class ActusController extends AbstractController
{
    public function index(): string
    {
        $actusManager = new ActusManager();
        $categories = $actusManager->selectAllCategories();
        $news = $actusManager->selectAllNews();
        return $this->twig->render('actus/actus.html.twig', ['categories' => $categories, 'news' => $news]);
    }

    public function indexAdmin(): string
    {
        $actusManager = new ActusManager();
        $categories = $actusManager->selectAllCategories();
        $news = $actusManager->selectAllNews();
        return $this->twig->render('Admin/ActusAdmin/index.html.twig', ['categories' => $categories, 'news' => $news]);
    }

    public function new()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            $fileName = '';
            foreach ($_FILES['image']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['image']['name'][$index];
                move_uploaded_file($tmpName, $uploadDir . $fileName);
            }
            $actusManager = new ActusManager();
            $actusManager->insert($_POST, $fileName);
            header('Location: /admin/actusadmin');
        }

        return $this->twig->render('Admin/ActusAdmin/new.html.twig');
    }

    public function edit(int $id)
    {
        $actusManager = new ActusManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = __DIR__ . '/../../public/uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }
            $fileName = '';
            foreach ($_FILES['image']['tmp_name'] as $index => $tmpName) {
                $fileName = $_FILES['image']['name'][$index];
                move_uploaded_file($tmpName, $uploadDir . $fileName);
            }
            $actusManager->update($_POST, $fileName);
            header('Location: /admin/actusadmin');
        }

        $news = $actusManager->selectOneById($id);

        return $this->twig->render('Admin/ActusAdmin/edit.html.twig', ['new' => $news]);
    }

    public function delete(int $id)
    {
        $actusManager = new ActusManager();
        $actusManager->delete($id);
        header('Location: /admin/actusadmin');
    }
}
