<?php

namespace App\Model;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function insert(array $cupcake): int
    {
        // prepared request
        $statement = $this->pdo->prepare(
            "INSERT INTO " . self::TABLE .
                " (`name`, `color1`, `color2`, `color3`, `accessory_id`) VALUES" .
                " (:name, :color1, :color2, :color3, :accessory_id)"
        );
        $statement->bindValue('name', $cupcake['name'], \PDO::PARAM_STR);
        $statement->bindValue('color1', $cupcake['color1'], \PDO::PARAM_STR);
        $statement->bindValue('color2', $cupcake['color2'], \PDO::PARAM_STR);
        $statement->bindValue('color3', $cupcake['color3'], \PDO::PARAM_STR);
        $statement->bindValue('accessory_id', $cupcake['accessory_id'], \PDO::PARAM_INT);

        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }
    public function selectAllWithAccessory(): array
    {
        return $this->pdo->query(
            'SELECT cupcake.id, cupcake.name, color1, color2, color3, url FROM ' .
                self::TABLE .
                ' JOIN accessory ON accessory.id=cupcake.accessory_id' .
                ' ORDER BY cupcake.id DESC'
        )->fetchAll();
    }
    public function selectOneByIdWithAccessory(int $id): array
    {
        $statement = $this->pdo->prepare(
            'SELECT cupcake.id, cupcake.name, color1, color2, color3, url FROM ' .
                self::TABLE .
                ' JOIN accessory ON accessory.id=cupcake.accessory_id' .
                ' WHERE cupcake.id=:id'
        );
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
