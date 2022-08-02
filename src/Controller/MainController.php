<?php

namespace App\Controller;

use App\Service\PlanetResourcesUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'sf_mainView')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/planet/{id}', name: 'sf_planetView')]
    public function planetView(int $id, PlanetResourcesUpdate $planetResourcesUpdate): Response
    {
        $planetResourcesUpdate->planetResourcesUpdate($id);
        return $this->render('main/index.html.twig', [
            'controller_name' => $id,
        ]);
    }
}
