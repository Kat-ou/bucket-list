<?php


namespace App\Controller;


use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="wish_")
 */
class WishController extends AbstractController
{

    /**
     * @Route ("/{page}", name="list",requirements={"page": "\d+"})
     */
    public function list(WishRepository $wishRepository, int $page=1)
    {
        //$wishes=$wishRepository->findBy(["isPublished"=> true],["date_created" => "DESC"],20);
        $wishes=$wishRepository->findWishList();

        return $this->render("wish/list.html.twig", ["wishes"=>$wishes]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details($id, WishRepository $wishRepository )
    {
        $wish=$wishRepository->find($id);

        return $this->render("wish/details.html.twig", ["wish"=> $wish]);
    }

}