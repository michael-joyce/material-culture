<?php

declare(strict_types=1);

/*
 * (c) 2021 Michael Joyce <mjoyce@sfu.ca>
 * This source file is subject to the GPL v2, bundled
 * with this source code in the file LICENSE.
 */

namespace App\DataFixtures;

use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 */
class PublicationFixtures extends Fixture {
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager) : void {
        $item1 = new Publication();
        $item1->setTitle('Domestic Architecture and Power: The Historical Archaeology of Colonial Ecuador.');
        $item1->setCitation('<p id="citation-text">&ldquo;Domestic Architecture and Power: The Historical Archaeology of Colonial Ecuador.&rdquo; Choice Reviews Online 37.10 (2000): 37&ndash;5754&ndash;37&ndash;5754. Crossref. Web.</p>');
        $item1->setAbstract('Jamieson\'s book is based on fieldwork conducted in 1993-4. No other published accounts...</p>');
        $item1->setUrls(['http://google.com', 'http://example.com']);
        $item1->setDoi('https://doi.org/10.5860/choice.37-5754');
        $this->addReference('_reference_Publication1', $item1);
        $manager->persist($item1);

        $item2 = new Publication();
        $item2->setTitle('Local heroes: notes on the highway statues of Colta, Ecuador');
        $item2->setCitation('<p id="citation-text">Jamieson, Ross W. &ldquo;Local Heroes: Notes on the Highway Statues of Colta, Ecuador.&rdquo; International Journal of Heritage Studies 23.9 (2017): 800&ndash;815. Crossref. Web.</p>');
        $item2->setDoi('https://doi.org/10.1080/13527258.2017.1333521');
        $this->addReference('_reference_Publication2', $item2);
        $manager->persist($item2);

        $item3 = new Publication();
        $item3->setTitle('Barley and Identity In the Spanish Colonial Audiencia of Quito: Archaeobotany of the 18th Century San Blas Neighborhood In Riobamba');
        $item3->setCitation('<p id="citation-text">Jamieson, Ross W., and Meridith Beck Sayre. &ldquo;Barley and Identity in the Spanish Colonial Audiencia of Quito: Archaeobotany of the 18th Century San Blas Neighborhood in Riobamba.&rdquo; Journal of Anthropological Archaeology 29.2 (2010): 208&ndash;218. Crossref. Web.</p>');
        $item3->setDoi('https://doi.org/10.1016/j.jaa.2010.02.003');
        $this->addReference('_reference_Publication3', $item3);
        $manager->persist($item3);

        $item4 = new Publication();
        $item4->setTitle('The Market for Meat In Colonial Cuenca');
        $item4->setCitation('<p id="citation-text">Jamieson, Ross W. &ldquo;The Market for Meat in Colonial Cuenca: A Seventeenth-Century Urban Faunal Assemblage from the Southern Highlands of Ecuador.&rdquo; Historical Archaeology 42.4 (2008): 21&ndash;37. Crossref. Web.</p>');
        $item4->setDoi('https://doi.org/10.1007/bf03377152');
        $this->addReference('_reference_Publication4', $item4);
        $manager->persist($item4);

        $item5 = new Publication();
        $item5->setTitle('Colonialism, social archaeology andlo Andino: historical archaeology in the Andes');
        $item5->setCitation('<p id="citation-text">Jamieson, Ross W. &ldquo;Colonialism, Social Archaeology Andlo Andino: Historical Archaeology in the Andes.&rdquo; World Archaeology 37.3 (2005): 352&ndash;372. Crossref. Web.</p>');
        $item5->setDoi('https://doi.org/10.1080/00438240500168384');
        $this->addReference('_reference_Publication5', $item5);
        $manager->persist($item5);

        $item6 = new Publication();
        $item6->setTitle('NEUTRON ACTIVATION ANALYSIS OF COLONIAL CERAMICS FROM SOUTHERN HIGHLAND ECUADOR*');
        $item6->setCitation('<p id="citation-text">JAMIESON, R. W., and R. G. V. HANCOCK. &ldquo;NEUTRON ACTIVATION ANALYSIS OF COLONIAL CERAMICS FROM SOUTHERN HIGHLAND ECUADOR*.&rdquo; Archaeometry 46.4 (2004): 569&ndash;583. Crossref. Web.</p>');
        $item6->setDoi('https://doi.org/10.1111/j.1475-4754.2004.00174.x');
        $this->addReference('_reference_Publication6', $item6);
        $manager->persist($item6);

        $item7 = new Publication();
        $item7->setTitle('Bolts of Cloth and Sherds of Pottery: Impressions of Caste In the Material Culture of the Seventeenth Century Audiencia of Quito');
        $item7->setCitation('<p id="citation-text">Jamieson, Ross W. &ldquo;Bolts of Cloth and Sherds of Pottery: Impressions of Caste in the Material Culture of the Seventeenth Century Audiencia of Quito.&rdquo; The Americas 60.3 (2004): 431&ndash;446. Crossref. Web.</p>');
        $item7->setDoi('https://doi.org/10.1353/tam.2004.0016');
        $this->addReference('_reference_Publication7', $item7);
        $manager->persist($item7);

        $manager->flush();
    }
}
