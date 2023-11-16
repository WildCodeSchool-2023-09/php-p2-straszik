<?php

namespace App\Controller;

class CreateUserController extends AbstractController
{
    public function index(): string
    {
        $isLogin = true;
        return $this->twig->render("Users/create_account_user.html.twig", ['isLogin' => $isLogin]);
    }
}
