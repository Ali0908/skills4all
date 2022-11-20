<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\CategoryRepository;
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
        return $this->render('front/index.html.twig', 
        ["carList"=> $carRepository->findAll(),]
    );
    }
    /**
     * @Route("/", name="app_front")
     */
    public function categoryList(CategoryRepository $categoryRepository): Response
    {
    return $this->render(
        'front/index.html.twig',
        ["categoryList"=> $categoryRepository->findAll(),]
    );
    }
    //  /**
    //  * @Route("/category", name="app_category")
    //  */
    // public function categoryFilter(CarRepository $carRepository): Response
    // {
    //     $carsFilters=$carRepository->findAll();
    //     $carFiltersArray= array($carsFilters);
    //     $resultCarsFilters=array_unique($carFiltersArray);
    //     return $this->json($resultCarsFilters,Response::HTTP_OK,[],["groups" => ["api_car_list"]]);

    
    // }

    /**
     * @Route("/list", name="list", methods={"GET"})
     * 
     */
    public function listCarsByName(CarRepository $carRepository): JsonResponse
    {
        $carsByName = $carRepository->findCarsByNameAsc();

    
        return $this->json($carsByName,Response::HTTP_OK,[],["groups" => ["api_car_list"]]);
    
    }
    /**
     * @Route("/display", name="display")
     * 
     * @return Response
     */
    public function displayCarsByCategoryName(CarRepository $carRepository): Response
    {
        $carsByCategoryName = $carRepository->findCarsByCategoryName();
    
        // On transmet à notre vue la liste des films
        return $this->json($carsByCategoryName,Response::HTTP_OK,[],["groups" => ["api_car_list"]]);
    
    }

}
