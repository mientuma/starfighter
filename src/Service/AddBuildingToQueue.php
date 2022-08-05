<?php

namespace App\Service;

use App\Entity\Planet;
use Doctrine\ORM\EntityManagerInterface;

class AddBuildingToQueue
{
    private EntityManagerInterface $em;

    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addBuildingToBuildingQueue($planetId): void
    {
        $planet = $this->em->getRepository(Planet::class)->find($planetId);
        $buildingQueueEndTime = $planet->getBuildingsQueueEndTime();

        if ($buildingQueueEndTime == null)
        {
            $buildingQueueEndTime = time()+30;
            $planet->setBuildingsQueueEndTime($buildingQueueEndTime);
            $this->em->persist($planet);
            $this->em->flush();
        }

    }

}