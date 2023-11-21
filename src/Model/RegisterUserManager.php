<?php

namespace App\Model;

use PDO;

class RegisterUserManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectOneByEmail(string $email): array|false
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " WHERE email=:email");
        $statement->bindValue('email', $email, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }

    public function insertNewUser(array $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (`firstname`, `lastname`, `email`, `password`, `status`, 
        `adresse`, `code_postal`, `ville`) VALUES (:firstname, :lastname, :email, :password, :status, 
        :adresse, :code_postal, :ville)");
        $statement->bindValue('firstname', $user['firstname'], PDO::PARAM_STR);
        $statement->bindValue('lastname', $user['lastname'], PDO::PARAM_STR);
        $statement->bindValue('email', $user['email'], PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], PDO::PARAM_STR);
        $statement->bindValue('status', 0, PDO::PARAM_INT);
        $statement->bindValue('adresse', $user['adresse'], PDO::PARAM_STR);
        $statement->bindValue('code_postal', $user['code_postal'], PDO::PARAM_INT);
        $statement->bindValue('ville', $user['city'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
