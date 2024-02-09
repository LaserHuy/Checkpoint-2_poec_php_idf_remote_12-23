<?php

namespace App\Controller;

use App\Service\Container;
use App\Model\CupCakeManager;
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
        
        $cupckake= new CupCakeManager();
        $errors=[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            $cupcake=array_map('trim',$_POST);

            $rules=['name'=>['message'=>'entrer le nom de cupcake svp','pattern'=>'/^[a-zA-Z]*$/'],
                    'color1'=>['message'=>'entrer la couleur 1 de cupcake svp','pattern'=>"/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"],
                    'color2'=>['message'=>'entrer la couleur 2 de cupcake svp','pattern'=>"/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"],
                    'color3'=>['message'=>'entrer la couleur 3 de cupcake svp','pattern'=>"/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/"]
                    ];

            foreach($rules as $key=>$value){
                if(empty($cupcake[$key]) || (isset($value['pattern']) && !preg_match($value['pattern'], $cupcake[$key]))){
                    $errors[$key] = $value['message'];
                }

            }
            if(empty($errors)){
                $cupckake->insert($cupcake);
                header('Location:/cupcake/list');
                exit();
            }

            
        }
        //TODO retrieve all accessories for the select options
        return $this->twig->render('Cupcake/add.html.twig',['errors'=>$errors]);
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
        return $this->twig->render('Cupcake/list.html.twig');
    }
}
