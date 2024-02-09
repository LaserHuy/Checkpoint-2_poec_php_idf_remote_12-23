<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function insert(array $cupcake): int
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (`name`, `color1`, `color2`, `color3`,
        `accessory_id`, `created_at` )
        VALUES (:name, :color1, :color2, :color3, :accessory_id, :created_at)");
        $statement->bindValue('name', $cupcake['name'], PDO::PARAM_STR);
        $statement->bindValue('color1', $cupcake['color1'], PDO::PARAM_STR);
        $statement->bindValue('color2', $cupcake['color2'], PDO::PARAM_STR);
        $statement->bindValue('color3', $cupcake['color3'], PDO::PARAM_STR);
        $statement->bindValue('accessory_id', (int)$cupcake['accessory_id'], PDO::PARAM_INT);

        if (!isset($cupcake['created_at'])) {
            $cupcake['created_at'] = date('Y-m-d H:i:s');
        }

        $statement->bindValue('created_at', $cupcake['created_at'], PDO::PARAM_STR);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }
    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE;

        if (!empty($orderBy)) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }
}
