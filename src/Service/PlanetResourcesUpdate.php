<?php

namespace App\Service;

use App\Entity\Planet;
use  Doctrine\ORM\EntityManagerInterface;

class PlanetResourcesUpdate
{
    private EntityManagerInterface $em;

    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function planetResourcesUpdate($planetId): void
    {
        $planet = $this->em->getRepository(Planet::class)->find($planetId);
        $lastUpdate = $planet->getLastUpdate();
        $currentTime = time();
        $timeDifference = $currentTime - $lastUpdate;

        $metalPerSecond = ($planet->getMetalPerHour())/360;
        $updatedMetal = $planet->getPlanetMetal() + $metalPerSecond * $timeDifference;

        $planet->setPlanetMetal($updatedMetal);
        $planet->setLastUpdate($currentTime);
        $this->em->persist($planet);
        $this->em->flush();
    }

}