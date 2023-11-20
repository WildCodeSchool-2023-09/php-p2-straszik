<?php

namespace App\Model;

use PDO;
use App\Model\AbstractManager;

class UserManager extends AbstractManager
{
    public const TABLE = 'user';
    public function userLogin(array $user)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE .
        " WHERE email=:email AND password=:password");
        $statement->bindValue('email', $user['email'], \PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
