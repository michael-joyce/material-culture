<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Shape;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class LoadShape extends Fixture {
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) {
        $item1 = new Shape();
        $item1->setName('tile');
        $item1->setLabel('Tile');
        $item1->setDescription('Ceramic tile with glaze');
        $this->addReference('_reference_Shape1', $item1);
        $manager->persist($item1);

        $item2 = new Shape();
        $item2->setName('ornament');
        $item2->setLabel('Ornament');
        $item2->setDescription('Decorative ornament with glaze.');
        $this->addReference('_reference_Shape2', $item2);
        $manager->persist($item2);

        $item3 = new Shape();
        $item3->setName('vase');
        $item3->setLabel('Vase');
        $item3->setDescription('Open ceramic container with a shoulder and neck');
        $this->addReference('_reference_Shape3', $item3);
        $manager->persist($item3);

        $item4 = new Shape();
        $item4->setName('bowl');
        $item4->setLabel('Bowl');
        $item4->setDescription('A round ceramic dish or container.');
        $this->addReference('_reference_Shape4', $item4);
        $manager->persist($item4);

        $manager->flush();
    }
}