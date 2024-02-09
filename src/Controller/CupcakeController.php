<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\AccessoryManager;
use App\Model\CupcakeManager;

/**
 * Class CupcakeController
 *
 */
class CupcakeController extends AbstractController
{
    /**
     * Display cupcake creation page
     * Route /cupcake/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form = array_map('trim', $_POST);
            $errors = [];

            if (
                empty($form['name']) ||
                empty($form['color1']) ||
                empty($form['color2']) ||
                empty($form['color3']) ||
                empty($form['accessory'])
            ) {
                $errors[] = 'All fields are required';
            }

            if (empty($errors)) {
                $cupcakeManager = new CupcakeManager();
                $cupcakeManager->add($form);
                header('Location:/cupcake/list');
            }
        }
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();

        return $this->twig->render('Cupcake/add.html.twig', ['accessories' => $accessories]);
    }

    /**
     * Display list of cupcakes
     * Route /cupcake/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAll('accessory.accessoryId', 'DESC');

        return $this->twig->render('Cupcake/list.html.twig', ['cupcakes' => $cupcakes]);
    }

    public function show(int $id): string
    {
        $cupcakeManager = new CupcakeManager();
        $cupcake = $cupcakeManager->selectAllCupcakeById($id);

        return $this->twig->render('Cupcake/show.html.twig', ['cupcake' => $cupcake === false ? null : $cupcake]);
    }
}
