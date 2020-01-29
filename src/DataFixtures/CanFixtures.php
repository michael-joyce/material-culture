<?php

declare(strict_types=1);

/*
 * (c) 2020 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Can;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class CanFixtures extends Fixture implements DependentFixtureInterface {
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) : void {
        $item2 = new Can();
        $item2->setCompany('Can Can Co');
        $item2->setBrand('Cannings & Co');
        $item2->setManufacturer($this->getReference('_reference_Manufacturer4'));
        $item2->setLabel('(partial) Pickl ... Peanut Butter');
        $item2->setContent($this->getReference('_reference_Content1'));
        $item2->setRecoveryLocation($this->getReference('_reference_Location5'));
        $item2->setRecoveryDate('1980');
        $item2->setManufactureLocation($this->getReference('_reference_Location6'));
        $item2->setPackagingLocation($this->getReference('_reference_Location4'));
        $item2->setManufactureDate('c1780');
        $item2->setInstitution($this->getReference('_reference_Institution3'));
        $item2->setCatalogNumbers(['askdjfhk']);
        $item2->setDescription('Can with soiled label');
        $item2->setFurtherReading('Introduction to cans');
        $this->addReference('_reference_Can2', $item2);
        $manager->persist($item2);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on.
     *
     * @return array
     */
    public function getDependencies() {
        return [
            VesselFixtures::class,
            GlazeFixtures::class,
            LocationFixtures::class,
            LocationFixtures::class,
            InstitutionFixtures::class,
            ManufacturerFixtures::class,
            ContentFixtures::class,
        ];
    }
}