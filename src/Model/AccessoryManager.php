<?php

namespace App\Model;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function add(array $accessory): void
    {
        $query = "INSERT INTO " . self::TABLE . " (accessoryName, url) VALUES (:name, :url)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $accessory['name'], \PDO::PARAM_STR);
        $statement->bindValue('url', $accessory['url'], \PDO::PARAM_STR);
        $statement->execute();
    }
}
