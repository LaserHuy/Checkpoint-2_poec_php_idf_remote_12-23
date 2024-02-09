<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\CupcakeManager;
use App\Model\AccessoryManager;

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
        // Initialize the accessory manager
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
        // Initialize the cupcake manager
        $cupcakeManager = new CupcakeManager();
        $cupcakes = $cupcakeManager->selectAll();

        // Initialize filtered cupcakes
        $filteredCupcakes = $cupcakes;

        $accessoryId = isset($_GET['accessory']) ? intval($_GET['accessory']) : null;
        // Check if accessory filter is set
        if (isset($_GET['accessory']) && $_GET['accessory'] !== 'all') {
            $filteredCupcakes = array_filter($cupcakes, function ($cupcake) {
                return $cupcake['accessory_id'] == $_GET['accessory'];
            });
        }

        return $this->twig->render('Cupcake/list.html.twig', [
            'accessories' => $accessories,
            'cupcakes' => $filteredCupcakes,
            'accessory_id' => $accessoryId,
        ]);
    }
    // show cupcake details
    public function show($id)
    {
        // Initialize the cupcake manager
        $cupcakeManager = new CupcakeManager();
        
        // Retrieve the cupcake details using the provided $id
        $cupcake = $cupcakeManager->selectOneById($id);
        
        // Render the cupcake details view
        return $this->twig->render('Cupcake/_cupcake.html.twig', ['cupcake' => $cupcake]);
    }
}
