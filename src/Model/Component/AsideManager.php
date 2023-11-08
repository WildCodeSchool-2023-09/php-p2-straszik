<?php

namespace App\Model\Component;

use App\Model\AbstractManager;
use PDO;

class AsideManager extends AbstractManager
{
    public const TABLE = 'prospect';

    public function insert(string $item)
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`email`) VALUES (:email)");
        $statement->bindValue('email', $item, PDO::PARAM_STR);

        $statement->execute();
    }
}
