<?php

namespace App\Controller;

use App\Entity\Image;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends AbstractController
{
  #[Route('/', name: 'Homepage')]
  public function index(ImageRepository $repository, PaginatorInterface $paginator, Request $request): Response
  {
   $query = $repository->createQueryBuilder('p')->getQuery();

   $pagination = $paginator->paginate(
        $query,
        $request->query->getInt('page', 1),
        10 
    );

   return $this->render('Pages/index.html.twig',[
    "pagination" =>$pagination,
   ]); 
  }

// #[Route('/random', name: 'RandomImages')]
// public function random(ImageRepository $repository,): Response
// {
   
//     $allImages = $repository->findAll();

//     shuffle($allImages);

//     $randomImages = array_slice($allImages, 0, 10);

//     return $this->render('Pages/random.html.twig', [
//         'randomImages' => $randomImages,
//     ]);
// }

#[Route('/random', name: 'RandomImages')]
public function random(ImageRepository $repository, PaginatorInterface $paginator, Request $request): Response
{
    $allImages = $repository->findAll();

    shuffle($allImages);

    $randomImages = array_slice($allImages, 0, 10);

    $pagination = $paginator->paginate(
        $randomImages,
        $request->query->getInt('page', 1),
        10 
    );

    return $this->render('Pages/index.html.twig', [
        'pagination' => $pagination,
    ]);
}
}