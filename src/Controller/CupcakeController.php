<?php

namespace App\Controller;

use App\Service\Container;
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
        // Initialize the cupcake manager
        $cupcakeManager = new CupcakeManager();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO Add your code here to create a new cupcake
            // Validate form inputs
            if (empty($_POST['name'])) {
                $errors['name'] = 'Cupcake name is required.';
            }
            // If there are no validation errors, proceed with inserting data
            if (empty($errors)) {
                $cupcake = [
                    'name' => $_POST['name'],
                    'color1' => $_POST['color1'],
                    'color2' => $_POST['color2'],
                    'color3' => $_POST['color3'],
                    'accessory_id' => $_POST['accessory'],
                ];
                $cupcakeManager = $cupcakeManager->insert($cupcake);
                header('Location:/cupcake/list');
            }
        }
        //TODO retrieve all accessories for the select options
        return $this->twig->render('Cupcake/add.html.twig', [
            'errors' => $errors, 
        ]);
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
        //TODO Retrieve all cupcakes
        // Initialize the cupcake manager
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAll('name');

        return $this->twig->render('Cupcake/list.html.twig', [
            'cupcakes' => $cupcakes
        ]);
    }
}
