<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class FrontController extends AbstractController
{
    /**
     * @Route("/", name="app_front")
     */
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('front/index.html.twig', 
        ["carList"=> $carRepository->findAll(),]
    );
    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * 
     */
    public function listCarsByName(
    CarRepository $carRepository): JsonResponse
    {
        $allcars = $carRepository->findCarsByNameAsc();

    
        return $this->json($allcars,Response::HTTP_OK,[],["groups" => ["api_car_list"]]);
    
    }
}
