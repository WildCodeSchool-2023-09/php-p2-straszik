<?php

namespace App\Model;
use PDO;

class ContactManager extends AbstractManager
{
    public const TABLE = 'contact';

    public function insert(array $contacts)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . 
        " (type, email, message) VALUES (:type, :email, :message)");
        $statement->bindValue('type', $contacts['type'], PDO::PARAM_STR);
        $statement->bindValue('email', $contacts['email'], PDO::PARAM_STR);
        $statement->bindValue('message', $contacts['message']);
        $statement->execute();
    }
}
