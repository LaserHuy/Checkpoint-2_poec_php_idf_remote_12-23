<?php

namespace App\Controller;

use App\Model\AccessoryManager;
use App\Model\CupcakeManager;
use App\Service\Container;

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
            //TODO Add your code here to create a new cupcake
            $myCupcake = array_map('trim', $_POST);
            (new CupcakeManager())->add($myCupcake);
            header('Location:/cupcake/list');
        }
        //TODO retrieve all accessories for the select options
        $accessories = (new AccessoryManager())->selectAll();
        return $this->twig->render('Cupcake/add.html.twig', [
            'accessories' => $accessories
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
        $cupcakes = (new CupcakeManager())->getAll();
        return $this->twig->render('Cupcake/list.html.twig', [
            'cupcakes' => $cupcakes
        ]);
    }
}
