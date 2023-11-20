<?php

namespace App\Controller;

use App\Model\ConcertManager;

class ConcertController extends AbstractController
{
    public function index(): string
    {
        $concertManager = new ConcertManager();
        $concert = $concertManager->selectAllConcert();
        return $this->twig->render('concert/index.html.twig', ['location' => $concert]);
    }

    public function indexAdmin(): string
    {
        $concertManager = new ConcertManager();
        $concert = $concertManager->selectAllConcert();

        return $this->twig->render('Admin/ConcertAdmin/index.html.twig', ['concerts' => $concert]);
    }


   /* public function edit(int $id)
    {
        $concertManager = new concertManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            foreach ($_POST['id']['tmp_name'] as $index => $tmpName) {
                $fileName = $_POST['id']['name'][$index];
                move_uploaded_file($tmpName, $uploadDir . $fileName);
            }
            $concertManager->update($_POST, $fileName);
            header('Location: /admin/ConcertAdmin');
        }

        $concert = $concertManager->selectOneById($id);

        return $this->twig->render('Admin/ConcertAdmin/edit.html.twig', ['concerts' => $concert]);
    }

    public function delete(int $id)
    {
        $concertManager = new concertManager();
        $concertManager->delete($id);
        header('Location: /admin/ConcertAdmin');
    }
    */
}
