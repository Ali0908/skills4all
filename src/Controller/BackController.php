<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back")
 */
class BackController extends AbstractController
{
    /**
     * @Route("/", name="app_back_index", methods={"GET"})
     */
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('back/index.html.twig', [
            'cars' => $carRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_back_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CarRepository $carRepository): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carRepository->add($car, true);

            return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/new.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_show", methods={"GET"})
     */
    public function show(Car $car): Response
    {
        return $this->render('back/show.html.twig', [
            'car' => $car,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Car $car, CarRepository $carRepository): Response
    {
        $form = $this->createForm(CarType::class, $car);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carRepository->add($car, true);

            return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/edit.html.twig', [
            'car' => $car,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_delete", methods={"POST"})
     */
    public function delete(Request $request, Car $car, CarRepository $carRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$car->getId(), $request->request->get('_token'))) {
            $carRepository->remove($car, true);
        }

        return $this->redirectToRoute('app_back_index', [], Response::HTTP_SEE_OTHER);
    }
}
