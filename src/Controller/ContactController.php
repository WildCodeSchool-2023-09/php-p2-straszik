<?php

namespace App\Controller;

use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function index(): string
    {
        $contactManager = new ContactManager();
        $errors = [];
        $validateContact = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contacts = array_map('trim', $_POST);
            $errors = $this->validateContact($contacts);

            if (empty($errors)) {
                $contactManager->insert($contacts);
                $validateContact = true;
            }
        }
        return $this->twig->render('Contact/contact.html.twig', ['errors' => $errors,
        'validateContact' => $validateContact]);
    }

    public function validateContact(array $contacts): array
    {
        $errors = [];

        if (empty($contacts['type'])) {
            $errors['type'] = 'Veuillez sélectionner le type de demande';
        }
        if (empty($contacts['email'])) {
            $errors['email'] = "Veuillez saisir votre adresse email";
        }
        if (!filter_var($contacts['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['validateEmail'] = 'L\'email n\'est pas valide';
        }
        if (empty($contacts['message'])) {
            $errors['message'] = 'Veuillez saisir un message';
        }
        return $errors;
    }
}
