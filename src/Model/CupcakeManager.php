<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function add(array $form): void
    {
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE . "
        (`name`,
        `color1`,
        `color2`,
        `color3`,
        `accessory_id`,
        `created_at`)
        VALUES (
        :name,
        :color1,
        :color2,
        :color3,
        :accessory_id,
        NOW()
        )");
        $statement->bindValue('name', $form['name'], PDO::PARAM_STR);
        $statement->bindValue('color1', $form['color1'], PDO::PARAM_STR);
        $statement->bindValue('color2', $form['color2'], PDO::PARAM_STR);
        $statement->bindValue('color3', $form['color3'], PDO::PARAM_STR);
        $statement->bindValue('accessory_id', $form['accessory'], PDO::PARAM_STR);

        $statement->execute();
    }

    public function getAll(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT c.name, c.color1, c.color2, c.color3, a.url, a.id
        FROM cupcake as c INNER JOIN accessory as a ON a.id = c.accessory_id';
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }
        return $this->pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getId(int $id): array|false
    {
        $statement = $this->pdo->prepare("SELECT c.name, c.color1, c.color2, c.color3, a.url, a.id
        FROM cupcake as c INNER JOIN accessory as a ON a.id = c.accessory_id WHERE a.id=:id");
        $statement->bindValue('id', $id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}
