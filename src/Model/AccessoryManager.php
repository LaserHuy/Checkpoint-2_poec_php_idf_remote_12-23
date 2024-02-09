<?php

namespace App\Model;

use PDO;

class AccessoryManager extends AbstractManager
{
    public const TABLE = 'accessory';

    public function __construct()
    {
        parent::__construct();
    }
}
