<?php

namespace App\Model;

use App\Model\AbstractManager;
use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function add(array $form):void
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
}
