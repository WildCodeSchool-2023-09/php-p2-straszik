<?php

namespace App\Model;
use PDO;

class ConcertManager extends AbstractManager
{
    public function selectAllConcerts(): array
    {
        $query = 'SELECT concert.location, concert.capacity, concert.places_availables, concert.date, concert.id, concert.affiche FROM concert';
          return $this->pdo->query($query)->fetchAll();
    }
}
