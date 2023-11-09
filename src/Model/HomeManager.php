<?php

namespace App\Model;

class HomeManager extends AbstractManager
{
    public function selectLast3Categories(): array
    {
        $query = 'SELECT name, id FROM category';
          return $this->pdo->query($query)->fetchAll();
    }
    public function selectLast3News(): array
    {
        $query = 'SELECT actuality.title, actuality.image, actuality.description, actuality.category_id 
        FROM actuality INNER JOIN category ON category_id=category.id ORDER BY actuality.id DESC LIMIT 0,3';
          return $this->pdo->query($query)->fetchAll();
    }
}
