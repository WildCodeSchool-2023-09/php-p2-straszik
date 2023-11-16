<?php

namespace App\Model;

use PDO;

class GoodiesManager extends AbstractManager
{
    public const TABLE = 'goodie';

    /**
     * Get all row from database.
     */
    public function selectAllGoodies(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function insert(array $goodie): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (`price`, `designation`, `picture`, `description`) 
        VALUES (:price, :designation, :picture, :description)");

        $statement->bindValue('price', $goodie['price'], PDO::PARAM_INT);
        $statement->bindValue('designation', $goodie['designation'], PDO::PARAM_STR);
        $statement->bindValue('picture', $goodie['picture'], PDO::PARAM_STR);
        $statement->bindValue('description', $goodie['description'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $goodie): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET `price` = :price, designation = :designation, 
        picture = :picture, description = :description WHERE id=:id");
        $statement->bindValue('id', $goodie['id'], PDO::PARAM_INT);
        $statement->bindValue('price', $goodie['price'], PDO::PARAM_INT);
        $statement->bindValue('designation', $goodie['designation'], PDO::PARAM_STR);
        $statement->bindValue('picture', $goodie['picture'], PDO::PARAM_STR);
        $statement->bindValue('description', $goodie['description'], PDO::PARAM_STR);

        return $statement->execute();
    }
}
