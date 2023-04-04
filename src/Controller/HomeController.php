<?php

namespace App\Controller;

use App\Repository\PhotographRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/home', name: 'app_home_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PhotoRepository $repository): Response
    {
        return $this->render(
            '/home/index.html.twig',
            [
                'photographList' => $repository->bestPhotographByPhotoCount()
            ]
        );
    }
}