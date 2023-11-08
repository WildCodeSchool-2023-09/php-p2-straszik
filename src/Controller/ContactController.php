<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function index(): string
    {
        $contactManager = new ContactManager();
        $contacts = $contactManager->selectAllContact();
        return $this->twig->render('contact/contact.html.twig', ['contacts' => $contacts]);
    }
}
