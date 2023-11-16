<?php

namespace App\Model;

class ActusManager extends AbstractManager
{
    public const TABLE = 'actuality';

    public function selectAllCategories(): array
    {
        $query = 'SELECT name, id FROM category';
          return $this->pdo->query($query)->fetchAll();
    }

    public function selectAllNews(): array
    {
        $query = 'SELECT actuality.id, actuality.title, actuality.image, actuality.description, 
        actuality.category_id, category.name 
        FROM actuality INNER JOIN category ON category_id=category.id ORDER BY id DESC';
          return $this->pdo->query($query)->fetchAll();
    }

    public function insert(array $news, string $fileName): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (id, title, description, image, category_id) 
        VALUES (:id, :title, :description, :image, :category_id)");
        $statement->bindValue('id', $news['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $news['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $news['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $fileName, \PDO::PARAM_STR);
        $statement->bindValue('category_id', $news['category_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }

    public function update(array $news, string $fileName): bool
    {
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE . " 
        SET id=:id, title=:title, description=:description, image=:image, category_id=:category_id WHERE id=:id");
        $statement->bindValue('id', $news['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $news['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $news['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $fileName, \PDO::PARAM_STR);
        $statement->bindValue('category_id', $news['category_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
