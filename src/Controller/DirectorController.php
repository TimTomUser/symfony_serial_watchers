<?php

namespace App\Controller;

use App\Entity\Director;
use App\Form\DirectorType;
use App\Repository\DirectorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DirectorController extends AbstractController
{
    #[Route('/directors', name: 'directors_list')]
    public function index(DirectorRepository $directorRepository): Response
    {
        return $this->render('director/liste.html.twig', [
            'directors' => $directorRepository->findAll()
        ]);
    }
    // #[Route('/directors/new', name: 'director_new')]
    // public function new(Request $request, EntityManagerInterface $em): Response {

    //     $director = new Director();
    //     $form = $this->createForm(DirectorType::class, $director);
    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid()) {
    //         $em->persist($director);
    //         $em->flush();

    //         return $this->redirectToRoute('directors_list');
    //     }
    //     return $this->render('director/new.html.twig', [
    //         'form' => $form
    //     ]);

    // }

    #[Route('/directors/{id}', name: 'director_detail')]
    public function detail(int $id, DirectorRepository $directorRepository): Response
    {
        $monDirector = $directorRepository->find($id);
        // if(!$monDirector) {
        //     return $this->createNotFoundException('Ce réalisateur n\'existe pas');
        // }
        return $this->render('director/detail.html.twig', [
            'director' => $monDirector
        ]);
    }
    
}
