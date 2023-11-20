<?php

namespace App\Controller;

use App\Model\AdminMessagesManager;

class AdminMessagesController extends AbstractController
{
    public function index()
    {
        if (!$this->admin) {
            header('HTTP/1.1 401 Unauthorized');
            return $this->twig->render(
                'unauthorized_access.html.twig'
            );
        } else {
            $adminMessagesManager = new AdminMessagesManager();
            $messages = $adminMessagesManager->selectAll();

            return $this->twig->render("Admin/AdminMessages/admin_messages.html.twig", [
                "messages" => $messages
            ]);
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
            $adminMessagesManager = new AdminMessagesManager();
            $adminMessagesManager->delete($id);
            header('Location: /admin/MessagesAdmin');
        }
    }
}
