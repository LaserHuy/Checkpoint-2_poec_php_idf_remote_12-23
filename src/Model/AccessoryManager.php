<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function add(array $form): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`name`,
        `url`)
        VALUES (
        :name,
        :url
        )");
        $statement->bindValue('name', $form['name'], PDO::PARAM_STR);
        $statement->bindValue('url', $form['url'], PDO::PARAM_STR);
        $statement->execute();
    }
}
