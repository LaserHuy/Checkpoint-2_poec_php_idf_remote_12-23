<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager
{
    public const TABLE = 'cupcake';

    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

}