<?php

namespace App\Model;

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
}
