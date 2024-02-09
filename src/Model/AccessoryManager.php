<?php

namespace App\Model;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';
    
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }


    public function insert(array $accessory): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `url`) 
        VALUES (:name, :url)");
        $statement->bindValue('name', $accessory['name'], \PDO::PARAM_STR);
        $statement->bindValue('url', $accessory['url'], \PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
}
