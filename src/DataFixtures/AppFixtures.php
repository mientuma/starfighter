<?php

namespace App\DataFixtures;

use App\Entity\Planet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
        $this->loadPlanets($manager);
    }

    private function loadUsers(ObjectManager $manager)
    {
        foreach ($this->getUsersData() as [$name, $password, $roles])
        {
            $user = new User();
            $user->setUsername($name);
            $user->setPassword($password);
            $user->setRoles([$roles]);
            $manager->persist($user);
        }
        $manager->flush();
    }

    private function loadPlanets(ObjectManager $manager)
    {
        foreach ($this->getPlanetsData() as [$ownerId, $name, $fields, $planetMetal, $lastUpdate, $metalMine, $metalPerHour])
        {
            $planet = new Planet();
            $owner = $manager->getRepository(User::class)->find($ownerId);
            $planet->setOwner($owner);
            $planet->setName($name);
            $planet->setFields($fields);
            $planet->setPlanetMetal($planetMetal);
            $planet->setLastUpdate($lastUpdate);
            $planet->setMetalMine($metalMine);
            $planet->setMetalPerHour($metalPerHour);
            $manager->persist($planet);
        }
        $manager->flush();
    }

    private function getUsersData(): array
    {
        return [
            ['Admin', '$2y$13$mfPppxl.x5cg6YY9.fE8ZeABQzOzNOPRB89/niZ5GQggwewW7p8bO', 'ROLE_ADMIN', 1],
            ['John', '$2y$13$a87BUCewuZ/361fcP9wAve9F2nxT3KHPnhDE6FhheLxPM5i7wSuHG', 'ROLE_USER', 2],
            ['Alice', '$2y$13$vHD6EnCRxXi2DTa.m1wz/u04yhp3UhK.xm7/KrNwYb97iXv/2JbZW', 'ROLE_USER', 3],
            ['Robert', '$2y$13$w8eTOZ8LELEZwIDcGk0ZT.K59EBpob0ezK6OPtaBKw0jfqWslgSae', 'ROLE_USER', 4]
        ];
    }

    private function getPlanetsData(): array
    {
        return [
            ['1', 'Planet 1', 200, 800, new \DateTime('now'), 16, 6000]
        ];
    }
}
