<?php
namespace App\Model;

use PDO;
class CupCakeManager extends AbstractManager{
    const TABLE='cupcake';

    public function insert(array $cupcake){
        $query="INSERT INTO ".self::TABLE." (`name`, `color1`, `color2`, `color3`, `accessory_id`, `created_at`) VALUES (:name, :color1, :color2, :color3, :accessory_id, :created_at)";
        $stmt=$this->pdo->prepare($query);
        $stmt->bindValue(':name', $cupcake['name']);
        $stmt->bindValue(':color1', $cupcake['color1']);
        $stmt->bindValue(':color2', $cupcake['color2']);
        $stmt->bindValue(':color3', $cupcake['color3']);
        $stmt->bindValue(':accessory_id', $cupcake['accessory']);
        $stmt->bindValue(':created_at',date('Y-m-d H:i:s'));
        $stmt->execute();
        return (int)$this->pdo->lastInsertId();
}
}