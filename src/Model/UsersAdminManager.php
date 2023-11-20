<?php

namespace App\Model;

use PDO;

class UsersAdminManager extends AbstractManager
{
    public const TABLE = 'user';

    public function selectAllUsers(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function update(array $users): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET `firstname` = :firstname, `lastname` = :lastname, `email` = :email,
        `adresse` = :adresse, `code_postal` = :code_postal, `ville` = :ville, 
        `status` = :status WHERE id=:id");
        $statement->bindValue('id', $users['id'], PDO::PARAM_INT);
        $statement->bindValue('firstname', $users['firstname'], PDO::PARAM_STR);
        $statement->bindValue('lastname', $users['lastname'], PDO::PARAM_STR);
        $statement->bindValue('email', $users['email'], PDO::PARAM_STR);
        $statement->bindValue('adresse', $users['adresse'], PDO::PARAM_STR);
        $statement->bindValue('code_postal', $users['code_postal'], PDO::PARAM_INT);
        $statement->bindValue('ville', $users['ville'], PDO::PARAM_STR);
        $statement->bindValue('status', $users['status'], PDO::PARAM_INT);

        return $statement->execute();
    }
}
