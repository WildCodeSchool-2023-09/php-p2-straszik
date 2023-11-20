<?php

namespace App\Controller;

use App\Model\UsersAdminManager;

class UsersAdminController extends AbstractController
{
    public function indexAdmin(): string
    {
        $usersadminManager = new UsersAdminManager();
        $users = $usersadminManager->selectAll('id', "DESC");
        return $this->twig->render('Admin/UsersAdmin/admin_users_index.html.twig', ['users' => $users]);
    }

    public function edit(int $id)
    {
        $usersadminManager = new UsersAdminManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update'])) {
                $data = array_map('trim', $_POST);
                $data['id'] = $id;
                $usersadminManager->update($data);
                header('Location: /admin/UsersAdmin');
            }

            if (isset($_POST['delete'])) {
                $usersadminManager->delete((int)$id);
                header('Location: /admin/UsersAdmin');
            }
        }
        $users = $usersadminManager->selectOneById($id);
        return $this->twig->render('Admin/UsersAdmin/edit.html.twig', ['users' => $users, 'id' => $id]);
    }

    public function delete(int $id)
    {
        $usersadminManager = new UsersAdminManager();
        $usersadminManager->delete($id);
        header('Location: /admin/UsersAdmin');
    }
}
