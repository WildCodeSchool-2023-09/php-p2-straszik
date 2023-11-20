<?php

namespace App\Model;

class ConcertManager extends AbstractManager
{
    public const TABLE = 'concert';
    public function selectAllConcert(): array
    {
        $query = 'SELECT * FROM concert ORDER BY id DESC';
          return $this->pdo->query($query)->fetchAll();
    }

    public function insert(array $concert): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (id, location, capacity, places_availabes, date) 
        VALUES (:id, :location, :capacity, :places_availables, :date)");
        $statement->bindValue('id', $concert['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $concert['location'], \PDO::PARAM_STR);
        $statement->bindValue('description', $concert['capacity'], \PDO::PARAM_INT);
        $statement->bindValue('image', $concert['places_availables'], \PDO::PARAM_INT);
        $statement->bindValue('category_id', $concert['date'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $concert): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET id=:id, location=:location, capacity=:capacity, places_availables:places_availables, date:date");
        $statement->bindValue('id', $concert['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $concert['location'], \PDO::PARAM_STR);
        $statement->bindValue('description', $concert['capacity'], \PDO::PARAM_INT);
        $statement->bindValue('image', $concert['places_availabes'], \PDO::PARAM_INT);
        $statement->bindValue('category_id', $concert['date'], \PDO::PARAM_INT);

        return $statement->execute();
    }
/*
    public function delete($concert): bool
    {
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
        $statement->bindValue('id', $concert['id'], \PDO::PARAM_INT);
        return $statement->execute();
    }
    */
}
