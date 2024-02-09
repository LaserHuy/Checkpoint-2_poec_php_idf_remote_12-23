<?php

namespace App\Model;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function add(array $cupcake): void
    {
        $query = "INSERT INTO " . self::TABLE . " 
        (cupcakeName, color1, color2, color3, accessory_id, created_at) 
        VALUES (:name, :color1, :color2, :color3, :accessory_id, NOW())";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue('name', $cupcake['name'], \PDO::PARAM_STR);
        $statement->bindValue('color1', $cupcake['color1'], \PDO::PARAM_STR);
        $statement->bindValue('color2', $cupcake['color2'], \PDO::PARAM_STR);
        $statement->bindValue('color3', $cupcake['color3'], \PDO::PARAM_STR);
        $statement->bindValue('accessory_id', $cupcake['accessory'], \PDO::PARAM_INT);

        $statement->execute();
    }

    public function selectAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT * FROM ' . static::TABLE . ' 
        INNER JOIN accessory ON cupcake.accessory_id = accessory.accessoryId';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        return $this->pdo->query($query)->fetchAll();
    }

    public function selectAllCupcakeById(int $id): array|false
    {
        // prepared request
        $statement = $this->pdo->prepare("SELECT * FROM " . static::TABLE . " 
        INNER JOIN accessory ON cupcake.accessory_id = accessory.accessoryId WHERE cupcakeId=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
