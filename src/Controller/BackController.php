<?php

namespace App\Controller;

use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use ContainerSu2VISK\PaginatorInterface_82dac15;
use Doctrine\ORM\EntityManagerInterface;
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
    public function listAction(EntityManagerInterface $em, PaginatorInterface_82dac15 $paginator, Request $request)
    {
        $dql   = "SELECT * FROM Car";
        $query = $em->createQuery($dql);
    
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );
    
        // parameters to template
        return $this->render('back/list.html.twig', ['pagination' => $pagination]);
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
