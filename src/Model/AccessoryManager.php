<?php
namespace App\Model;

use PDO;
class AccessoryManager extends AbstractManager{
    const TABLE='accessory';

    public function insert(array $accessory){
        $query="INSERT INTO ".self::TABLE." (name,url) VALUES (:name,:url)  ";
        $statement=$this->pdo->prepare($query);
        $statement->bindValue('name',$accessory['name'],PDO::PARAM_STR);
        $statement->bindValue('url',$accessory['url'],PDO::PARAM_STR);
        $statement->execute();
        return (int)$this->pdo->lastInsertId();
}
}