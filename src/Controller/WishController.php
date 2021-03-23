<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="wish_")
 */
class WishController extends AbstractController
{

    /**
     * @Route ("/", name="list")
     */
    public function list()
    {
        // todo aller chercher en bdd
        return $this->render("wish/list.html.twig");
    }

    /**
     * @Route("/details/", name="details")
     */
    public function details()
    {
        // todo aller chercher en bdd
        return $this->render("wish/details.html.twig");
    }

}