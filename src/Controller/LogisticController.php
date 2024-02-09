<?php

namespace App\Controller;

use App\Service\Container;

class LogisticController extends AbstractController
{
    public function index()
    {
        $containers = new Container();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cupcakeNumber = trim($_POST['cupcakeNumber']);
            // TODO call inbox() method of Container class with $cupcakeNumber as parameter
            // TODO affect the result of inbox() method to $inbox variable
            $containers = $containers->inbox($cupcakeNumber);
        }
        return $this->twig->render('Logistic/index.html.twig', [
            // TODO send a containers variable to Twig with results of inbox() method
            'containers' => $containers
        ]);
    }
}
