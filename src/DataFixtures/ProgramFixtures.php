<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [ 
        ['title' => 'Uncharted', 'synopsis' => 'Synopsis1', 'poster' => 'uncharted.jpeg', 'category'=> 'category_Action'],
        ['title' => 'Dune', 'synopsis' => 'Synopsis2', 'poster' => 'dune.jpeg', 'category' => 'category_Aventure'],
        ['title' => 'Raya', 'synopsis' => 'Synopsis3', 'poster' => 'raya.jpeg','category' => 'category_Animation'],
        ['title' => 'Justice League', 'synopsis' => 'Synopsis4', 'poster' => 'justiceLeague.jpeg', 'category' => 'category_Fantastique'],
        ['title' => 'The Walkind Dead', 'synopsis' => 'Synopsis5', 'poster' => 'walkingdead.jpeg', 'category' => 'category_Horreur'],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $programName) {
            $program = new Program();
            $program->setTitle($programName['title']);
            $program->setSynopsis($programName['synopsis']);
            $program->setPoster($programName['poster']);
            $program->setCategory($this->getReference($programName['category']));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {

        return [(CategoryFixtures::class)];
    }
}
