<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("", name="main_")
 */
class MainController extends AbstractController
{

    /**
     * @Route ("/", name="home")
     */
    public function home()
    {
        return $this->render("main/home.html.twig");
    }

    /**
     * @Route("/about_us", name="about_us")
     */
    public function aboutUs()
    {
        return $this->render("main/about_us.html.twig");
    }

}