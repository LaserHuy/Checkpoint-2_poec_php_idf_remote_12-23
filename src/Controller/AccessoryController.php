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
            $newAccessory = array_map('trim', $_POST);
            (new AccessoryManager())->add($newAccessory);
            //TODO Add your code here to create a new accessory
            header('Location:/accessory/list');
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
        //TODO Add your code here to retrieve all accessories
        $allAccessories = new AccessoryManager();
        $accessories = $allAccessories->selectAll();
        return $this->twig->render('Accessory/list.html.twig', [
            'accessories' => $accessories]);
    }
}
