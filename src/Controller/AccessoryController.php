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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $form = array_map('trim', $_POST);
            $errors = [];

            if (empty($form['name'])) {
                $errors['name'] = 'Name is required';
            }

            if (empty($form['url'])) {
                $errors['url'] = 'Url is required';
            }

            if (empty($errors)) {
                $accessoryManager = new AccessoryManager();
                $accessoryManager->add($form);

                header('Location:/accessory/list');
            }

            return $this->twig->render('Accessory/add.html.twig', ['errors' => $errors]);
        }
        return $this->twig->render('Accessory/add.html.twig');
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
        $accessoryManager = new AccessoryManager();
        $accessories = $accessoryManager->selectAll();

        return $this->twig->render('Accessory/list.html.twig', ['accessories' => $accessories]);
    }
}
