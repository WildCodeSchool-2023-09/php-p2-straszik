<?php

namespace App\Model;

class ContactManager extends AbstractManager
{
    public function selectAllContact(): array
    {
        $query = 'SELECT email, id FROM prospect';
          return $this->pdo->query($query)->fetchAll();
    }
}
