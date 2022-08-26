<?php

namespace App\Controller;

use App\Service\BuildBuilding;
use App\Service\PlanetResourcesUpdate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'sf_mainView')]
    public function index(): Response
    {
        $time = time();
        dump($time);
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/planet/{id}', name: 'sf_planetView')]
    public function planetView(int $planetId, PlanetResourcesUpdate $planetResourcesUpdate, BuildBuilding $buildBuilding): Response
    {
        $planetResourcesUpdate->planetResourcesUpdate($planetId);
        $buildBuilding->addBuildingToBuildingQueue($planetId);
        $buildBuilding->buildingLevelUpdate($planetId);
        return $this->render('main/index.html.twig', [
            'controller_name' => $planetId,
        ]);
    }
}
