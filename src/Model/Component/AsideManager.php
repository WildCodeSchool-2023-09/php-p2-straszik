<?php

namespace App\Model\Component;

use App\Model\AbstractManager;
use PDO;

class AsideManager extends AbstractManager
{
    public const TABLE = 'prospect';

    public function verifNewsletter(array $verif): array
    {
        $errors = [];

        if (empty($verif["email"])) {
            $errors[] = "Veuillez remplir le champ !";
        }

        if (!filter_var($verif["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Le mail n'est pas valide !";
        }

        return $errors;
    }

    public function insert(string $item)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`) VALUES (:email)");
        $statement->bindValue('email', $item, PDO::PARAM_STR);

        $statement->execute();
    }
}
