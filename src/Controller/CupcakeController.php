<?php

namespace App\Controller;

use App\Model\CupcakeManager;
use App\Model\AccessoryManager;
use App\Service\Container;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    public function add(): ?string
    {
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll('name');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcake = array_map('trim', $_POST);
            $cupcakeManager = new CupcakeManager();
            $cupcake = $cupcakeManager->insert($cupcake);

            header('Location:/cupcake/list');
            return null;
        }

        return $this->twig->render('Cupcake/add.html.twig', ['accessories' => $accessories]);
    }

    public function list(): string
    {
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAll();

        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show(int $id): string
    {
        $cupcakeManager = new CupcakeManager();
        $cupcake = $cupcakeManager->selectOneById($id);

        return $this->twig->render('Cupcake/show.html.twig', ['cupcake' => $cupcake]);
    }
}
