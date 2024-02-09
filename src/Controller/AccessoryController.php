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

        $accessorymanager= new AccessoryManager();
        $errors = []; 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //TODO Add your code here to create a new accessory
           $accessoires=array_map('trim',$_POST);
                  
           $validation = [
            'name' => ['message' => 'entrer le nom de accessoires svp', 'pattern' => '/^[a-zA-Z]*$/'],
            'url' => ['message' => 'entrer le lien de accessoires svp', 'pattern' => "/^(http|https):\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,}(\/\S*)?$/"]
        ];

        $errors = [];

        foreach($validation as $key => $value){
            if(empty($accessoires[$key]) || (isset($value['pattern']) && !preg_match($value['pattern'], $accessoires[$key]))){
                $errors[$key] = $value['message'];
            }   
        }

            if(empty($errors)){
                $accessorymanager->insert($accessoires);
                header('Location:/accessory/list');
                exit();
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
        $allaccessoires= new AccessoryManager();
        $accessoires=$allaccessoires->selectAll();

        return $this->twig->render('Accessory/list.html.twig', ['accessoires' => $accessoires]);
    }
}
