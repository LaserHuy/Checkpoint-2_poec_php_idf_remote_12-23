<?php

namespace App\Controller;

use App\Model\AccessoryManager;

/**
 * Class AccessoryController
 *
 */
class AccessoryController extends AbstractController
{
    /**
     * Display accessory creation page
     * Route /accessory/add
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function add()
    {
        // Initialize the accessory manager
        $accessoryManager = new AccessoryManager();

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO Add your code here to create a new accessory
            // Validate form inputs
            if (empty($_POST['name'])) {
                $errors['name'] = 'Accessory name is required.';
            }

            if (empty($_POST['url'])) {
                $errors['url'] = 'Accessory image URL is required.';
            } elseif (!filter_var($_POST['url'], FILTER_VALIDATE_URL)) {
                $errors['url'] = 'Invalid URL format.';
            }

            // If there are no validation errors, proceed with inserting data
            if (empty($errors)) {
                $accessory = [
                    'name' => $_POST['name'],
                    'url' => $_POST['url'],
                ];
                $accessoryManager = $accessoryManager->insert($accessory);
                header('Location:/accessory/list');
                exit; // Stop further execution
            }
        }
        return $this->twig->render('Accessory/add.html.twig', ['errors' => $errors]);
    }

    /**
     * Display list of accessories
     * Route /accessory/list
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function list()
    {
        //TODO Add your code here to retrieve all accessories
        // Initialize the accessory manager
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();
        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories]);
    }
}
