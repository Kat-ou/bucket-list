<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /**
     * @Route ("/")
     */
    public function home()
    {

        return $this->render("main/home.html.twig");
        //echo "<h1>accueil!</h1>";
        //die();
    }

    /**
     * @Route ("/test")
     */
    public function test()
    {
        echo "<h1>testounet!</h1>";
        die();
    }


}