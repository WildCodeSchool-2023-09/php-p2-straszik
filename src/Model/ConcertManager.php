<?php

namespace App\Model;

class ConcertManager extends AbstractManager
{
    public const TABLE = 'concert';
    public function selectAllConcert(): array
    {
        $query = 'SELECT * FROM ' . self::TABLE . ' ORDER BY id DESC';
          return $this->pdo->query($query)->fetchAll();
    }

    public function insert(array $concert): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " 
        (location, capacity, places_availables, date, affiche) 
        VALUES (:location, :capacity, :places_availables, :date, :affiche)");
        $statement->bindValue('location', $concert['location'], \PDO::PARAM_STR);
        $statement->bindValue('capacity', $concert['capacity'], \PDO::PARAM_INT);
        $statement->bindValue('places_availables', $concert['places_availables'], \PDO::PARAM_INT);
        $statement->bindValue('date', $concert['date']);
        $statement->bindValue('affiche', $concert['affiche'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $concert): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET location=:location, capacity=:capacity, places_availables=:places_availables,
         date=:date, affiche=:affiche WHERE id=:id");
        $statement->bindValue('id', $concert['id'], \PDO::PARAM_INT);
        $statement->bindValue('location', $concert['location'], \PDO::PARAM_STR);
        $statement->bindValue('capacity', $concert['capacity'], \PDO::PARAM_INT);
        $statement->bindValue('places_availables', $concert['places_availables'], \PDO::PARAM_INT);
        $statement->bindValue('date', $concert['date']);
        $statement->bindValue('affiche', $concert['affiche'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
