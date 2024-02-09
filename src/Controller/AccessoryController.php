<?php

namespace App\Controller;

use App\Model\AccessoryManager;

/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    public function add(): ?string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accessory = array_map('trim', $_POST);
            $accessoryManager = new AccessoryManager();
            $accessory = $accessoryManager->insert($accessory);

            header('Location:/accessory/list');
            return null;
        }

        return $this->twig->render('Accessory/add.html.twig');
    }

    public function list(): string
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll('name');

        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories]);
    }
}
