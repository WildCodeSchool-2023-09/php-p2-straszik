<?php

namespace App\Model\Component;

use App\Model\AbstractManager;
use PDO;

class NewsletterManager extends AbstractManager
{
    public const TABLE = 'prospect';

    public function insert(string $email)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`) VALUES (:email)");
        $statement->bindValue('email', $email, PDO::PARAM_STR);

        $statement->execute();
    }

    public function selectOneByEmail(string $email): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
