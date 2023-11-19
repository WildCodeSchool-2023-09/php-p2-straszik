<?php

namespace App\Controller;

class UserController extends AbstractController
{
    public function logout()
    {
        session_destroy();
        header("Location: /");
    }
}
