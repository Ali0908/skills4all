<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $carList=$carRepository->findAll();
        return $this->render('front/index.html.twig', 
        ["carList"=> $carList]
    );
    }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * 
     */
    public function listCarsByName(CarRepository $carRepository): JsonResponse
    {
        $carsByName = $carRepository->findCarsByName();

       
        return $this->json($carsByName,Response::HTTP_OK,[],["groups" => ["api_car_list"]]);
    
    }
    /**
     * @Route("/display", name="display")
     * 
     * @return Response
     */
    public function displayCarsByCategoryName(CarRepository $carRepository): Response
    {
        $carsByCategoryName = $carRepository->findCarsByName();
        // On transmet à notre vue la liste des films
        return $this->json($carsByCategoryName,Response::HTTP_OK,[],["groups" => ["api_car_display"]]);
    
    }

}
