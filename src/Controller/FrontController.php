<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}
