<?php

namespace App\Controller;

use App\Repository\RentalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rental")
 */
class RentalController extends AbstractController
{
    /**
     * @Route("/", name="rental_index")
     */
    public function index(RentalRepository $rentalRepository, Request $request)
    {
        $result= null;
        $rentalSearsh= $request->request->get('destination_searsh');
        if($rentalSearsh){
            $result= $rentalRepository->findByNameAndDescription($rentalSearsh);
        }else{
            $result= $rentalRepository->findAll();
        }
        return $this->render('rental/index.html.twig', [
            'rental' => $result,
        ]);
    }
}
