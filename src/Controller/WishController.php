<?php


namespace App\Controller;


use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="wish_")
 */
class WishController extends AbstractController
{

    /**
     * @Route ("/{page}", name="list",requirements={"page": "\d+"})
     */
    public function list(WishRepository $wishRepository, int $page = 1)
    {
        //$wishes=$wishRepository->findBy(["isPublished"=> true],["date_created" => "DESC"],20);
        $wishes = $wishRepository->findWishList();

        return $this->render("wish/list.html.twig", ["wishes" => $wishes]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details($id, WishRepository $wishRepository)
    {
        $wish = $wishRepository->find($id);

        return $this->render("wish/details.html.twig", ["wish" => $wish]);
    }

    /**
     * @Route ("/add", name="form")
     */
    public function createWish(Request $request, EntityManagerInterface $entityManager): Response
    {
        //crée un wish vide pour que Symfo puisse y ainjecter les données
        $wish = new Wish();

        //crée le formulaire
        $wishForm = $this->createForm(WishType::class, $wish);

        //recupère les données soumises (s'il y a lieu)
        $wishForm->handleRequest($request);

        //si le formulaire est soumis et valide...
        if ($wishForm->isSubmitted() && $wishForm->isValid()) {

            //hydrate les propriétés manquantes
            $wish->setLikes(0);
            $wish->setDateCreated(new \DateTime());
            $wish->setIsPublished(true);

            //sauvegarde en bdd
            $entityManager->persist($wish);
            $entityManager->flush();

            //affiche un message sur la prochaine page
            $this->addFlash("success", "Votre wish a bien été enregistré !");

            //redirige vers la page détails du wish crée
            return $this->redirectToRoute('wish_details',['id'=>$wish->getId()]);
        }
        return $this->render("wish/form.html.twig", ["wishForm" => $wishForm->createView()]);
    }

}