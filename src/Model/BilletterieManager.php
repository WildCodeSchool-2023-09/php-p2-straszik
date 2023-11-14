<?php

namespace App\Model;

use PDO;

class BilletterieManager extends AbstractManager
{
    public function selectAllTicket(): array
    {
        $query = 'SELECT concert.location, concert.capacity, 
        concert.places_availables, concert.date, concert.id 
        FROM concert INNER JOIN ticket ON concert_id=concert.id';
          return $this->pdo->query($query)->fetchAll();
    }
}
