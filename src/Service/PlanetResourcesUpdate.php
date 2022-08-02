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
        $lastUpdate = ($planet->getLastUpdate())->getTimestamp();
        $currentDateTime = (new \DateTime('now'))->getTimestamp();
        $timeDifference = $currentDateTime - $lastUpdate;
        $metalPerHour = $planet->getMetalPerHour();
        $metalPerSecond = $metalPerHour/360;
        $metalDifference = $metalPerSecond * $timeDifference;
        $updatedMetal = $planet->getPlanetMetal() + $metalDifference;
        $planet->setPlanetMetal($updatedMetal);
        $planet->setLastUpdate(new \DateTime('now'));
        $this->em->persist($planet);
        $this->em->flush();
    }

}