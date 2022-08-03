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

    public function planetResourcesUpdate($id): void
    {
        $planet = $this->em->getRepository(Planet::class)->find($id);
        $lastUpdate = $planet->getLastUpdate();
        $currentDateTime = (new \DateTime('now'))->getTimestamp();
        $timeDifference = $currentDateTime - $lastUpdate;

        $metalPerSecond = ($planet->getMetalPerHour())/360;
        $updatedMetal = $planet->getPlanetMetal() + $metalPerSecond * $timeDifference;

        $planet->setPlanetMetal($updatedMetal);
        $planet->setLastUpdate($currentDateTime);
        $this->em->persist($planet);
        $this->em->flush();
    }

}