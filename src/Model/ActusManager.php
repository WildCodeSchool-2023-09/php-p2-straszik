<?php

namespace App\Model;

class ActusManager extends AbstractManager
{
    public function selectAllCategories(): array
    {
        $query = 'SELECT name, id FROM category';
          return $this->pdo->query($query)->fetchAll();
    }
    public function selectAllNews(): array
    {
        $query = 'SELECT actuality.title, actuality.image, actuality.description, actuality.category_id 
        FROM actuality INNER JOIN category ON category_id=category.id';
          return $this->pdo->query($query)->fetchAll();
    }
}
