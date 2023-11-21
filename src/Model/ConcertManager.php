<?php

namespace App\Model;

use PDO;

class ConcertManager extends AbstractManager
{
    public function selectAllConcerts(): array
    {
        $query = 'SELECT * FROM concert';
          return $this->pdo->query($query)->fetchAll();
    }
}
