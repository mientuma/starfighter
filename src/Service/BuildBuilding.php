<?php

namespace App\Service;

use App\Entity\Planet;
use Doctrine\ORM\EntityManagerInterface;

class BuildBuilding
{
    private EntityManagerInterface $em;

    public function __construct (EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildingLevelUpdate($planetId): void
    {
        $planet = $this->em->getRepository(Planet::class)->find($planetId);
        $buildingQueueEndTime = $planet->getBuildingsQueueEndTime();

        if ($buildingQueueEndTime != null)
        {
            $currentTime = time();
            if ($buildingQueueEndTime <= $currentTime)
            {
                $metalMineLevel = $planet->getMetalMineLevel()+1;
                $planet->setMetalMineLevel($metalMineLevel);
                $planet->setBuildingsQueueEndTime(null);
                $this->em->persist($planet);
                $this->em->flush();
            }
        }
    }

}