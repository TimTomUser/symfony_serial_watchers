<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MovieController extends AbstractController
{
    #[Route('/movies', name: 'movies_list')]
    public function liste(MovieRepository $movieRepository): Response
    {
        return $this->render('movie/liste.html.twig', [
            'movies' => $movieRepository->findAll()
        ]);
    }
    #[Route('/movies/genre/{genre}', name: 'movies_list_par_genre')]
    public function listeByGenre(string $genre, MovieRepository $movieRepository): Response
    {
        return $this->render('movie/liste.html.twig', [
            'movies' => $movieRepository->findBy(['genre' => $genre])
        ]);
    }
    #[Route('/movies/new', name: 'movie_new')]
    public function new(Request $request, EntityManagerInterface $em): Response {

        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($movie);
            $em->flush();

            return $this->redirectToRoute('movies_list');
        }
        return $this->render('movie/new.html.twig', [
            'form' => $form
        ]);

    }
    #[Route('/movies/{id}', name: 'movie_detail')]
    public function detail(int $id, MovieRepository $movieRepository): Response
    {
        $monMovie = $movieRepository->find($id);
        if(!$monMovie) {
            return $this->createNotFoundException('Ce film n\'existe pas');
        }
        return $this->render('movie/detail.html.twig', [
            'movie' => $monMovie
        ]);
    }
}
