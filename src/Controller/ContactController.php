<?php

namespace App\Controller;

use App\Controller\Component\NewsletterController;
use App\Model\ContactManager;

class ContactController extends AbstractController
{
    public function index(): string
    {
        $contactManager = new ContactManager();
        $errors = [];
        $validateContact = false;
        $validateNewsletter = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = array_map('trim', $_POST);

            if (isset($data['contact'])) {
                $errors = $this->validateContact($data);

                if (empty($errors)) {
                    $contactManager->insert($data);
                    $validateContact = true;
                }
            }

            if (isset($data["newsletter"])) {
                $newsletterController = new NewsletterController();
                $errors = $newsletterController->verifFormNewsletter($data);

                if (empty($errors)) {
                    $validateNewsletter = $newsletterController->addEmailNewletter($data['email']);
                }
            }
        }
        return $this->twig->render('Contact/contact.html.twig', ['errors' => $errors,
        'validateContact' => $validateContact, 'validateNewsletter' => $validateNewsletter]);
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
