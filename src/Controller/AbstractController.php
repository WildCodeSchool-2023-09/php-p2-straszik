<?php

namespace App\Controller;

use App\Model\UserManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Extension\DebugExtension;

/**
 * Initialized some Controller common features (Twig...)
 */
abstract class AbstractController
{
    protected Environment $twig;
    protected bool $admin;


    public function __construct()
    {
        $loader = new FilesystemLoader(APP_VIEW_PATH);
        $this->twig = new Environment(
            $loader,
            [
                'cache' => false,
                'debug' => true,
            ]
        );
        $this->twig->addExtension(new DebugExtension());
        $userManager = new UserManager();
        if (isset($_SESSION['user_id'])) {
            $user = $userManager->selectOneById($_SESSION['user_id']);
            $this->admin = $user["status"] ? true : false;
        } else {
            $this->admin = false;
        }

        $this->twig->addGlobal("session", $_SESSION);
        $this->twig->addGlobal("admin", $this->admin);
    }
}
