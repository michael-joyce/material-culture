<?php

namespace AppBundle\Tests\Controller;

use AppBundle\DataFixtures\ORM\LoadPublication;
use AppBundle\Entity\Publication;
use Nines\UserBundle\DataFixtures\ORM\LoadUser;
use Nines\UtilBundle\Tests\Util\BaseTestCase;

class PublicationControllerTest extends BaseTestCase {
    protected function getFixtures() {
        return array(
            LoadUser::class,
            LoadPublication::class,
        );
    }

    /**
     * @group anon
     * @group index
     */
    public function testAnonIndex() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/publication/');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(0, $crawler->selectLink('New')->count());
    }

    /**
     * @group user
     * @group index
     */
    public function testUserIndex() {
        $client = $this->makeClient(LoadUser::USER);
        $crawler = $client->request('GET', '/publication/');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(0, $crawler->selectLink('New')->count());
    }

    /**
     * @group admin
     * @group index
     */
    public function testAdminIndex() {
        $client = $this->makeClient(LoadUser::ADMIN);
        $crawler = $client->request('GET', '/publication/');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(1, $crawler->selectLink('New')->count());
    }

    /**
     * @group anon
     * @group show
     */
    public function testAnonShow() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/publication/1');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(0, $crawler->selectLink('Edit')->count());
        $this->assertEquals(0, $crawler->selectLink('Delete')->count());
    }

    /**
     * @group user
     * @group show
     */
    public function testUserShow() {
        $client = $this->makeClient(LoadUser::USER);
        $crawler = $client->request('GET', '/publication/1');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(0, $crawler->selectLink('Edit')->count());
        $this->assertEquals(0, $crawler->selectLink('Delete')->count());
    }

    /**
     * @group admin
     * @group show
     */
    public function testAdminShow() {
        $client = $this->makeClient(LoadUser::ADMIN);
        $crawler = $client->request('GET', '/publication/1');
        $this->assertStatusCode(200, $client);
        $this->assertEquals(1, $crawler->selectLink('Edit')->count());
        $this->assertEquals(1, $crawler->selectLink('Delete')->count());
    }

    /**
     * @group anon
     * @group typeahead
     */
    public function testAnonTypeahead() {
        $client = $this->makeClient();
        $client->request('GET', '/publication/typeahead?q=STUFF');
        $response = $client->getResponse();
        $this->assertStatusCode(302, $client);
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $this->assertEquals('application/json', $response->headers->get('content-type'));
        $json = json_decode($response->getContent());
        $this->assertEquals(4, count($json));
    }

    /**
     * @group user
     * @group typeahead
     */
    public function testUserTypeahead() {
        $client = $this->makeClient(LoadUser::USER);
        $client->request('GET', '/publication/typeahead?q=STUFF');
        $response = $client->getResponse();
        $response = $client->getResponse();
        $this->assertStatusCode(403, $client);
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $json = json_decode($response->getContent());
        $this->assertEquals(4, count($json));
    }

    /**
     * @group admin
     * @group typeahead
     */
    public function testAdminTypeahead() {
        $client = $this->makeClient(LoadUser::ADMIN);
        $client->request('GET', '/publication/typeahead?q=STUFF');
        $response = $client->getResponse();
        $this->assertStatusCode(200, $client);
        $this->assertEquals('application/json', $response->headers->get('content-type'));
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $json = json_decode($response->getContent());
        $this->assertEquals(4, count($json));
    }

    /**
     * @group anon
     * @group edit
     */
    public function testAnonEdit() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/publication/1/edit');
        $this->assertStatusCode(302, $client);
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    /**
     * @group user
     * @group edit
     */
    public function testUserEdit() {
        $client = $this->makeClient(LoadUser::USER);
        $crawler = $client->request('GET', '/publication/1/edit');
        $this->assertStatusCode(403, $client);
    }

    /**
     * @group admin
     * @group edit
     */
    public function testAdminEdit() {
        $client = $this->makeClient(LoadUser::ADMIN);
        $formCrawler = $client->request('GET', '/publication/1/edit');
        $this->assertStatusCode(200, $client);

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $form = $formCrawler->selectButton('Update')->form(array(
            // DO STUFF HERE.
            // 'publications[FIELDNAME]' => 'FIELDVALUE',
        ));

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect('/publication/1'));
        $responseCrawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // $this->assertEquals(1, $responseCrawler->filter('td:contains("FIELDVALUE")')->count());
    }

    /**
     * @group anon
     * @group new
     */
    public function testAnonNew() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/publication/new');
        $this->assertStatusCode(302, $client);
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    /**
     * @group anon
     * @group new
     */
    public function testAnonNewPopup() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/publication/new_popup');
        $this->assertStatusCode(302, $client);
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    /**
     * @group user
     * @group new
     */
    public function testUserNew() {
        $client = $this->makeClient(LoadUser::USER);
        $crawler = $client->request('GET', '/publication/new');
        $this->assertStatusCode(403, $client);
    }

    /**
     * @group user
     * @group new
     */
    public function testUserNewPopup() {
        $client = $this->makeClient(LoadUser::USER);
        $crawler = $client->request('GET', '/publication/new_popup');
        $this->assertStatusCode(403, $client);
    }

    /**
     * @group admin
     * @group new
     */
    public function testAdminNew() {
        $client = $this->makeClient(LoadUser::ADMIN);
        $formCrawler = $client->request('GET', '/publication/new');
        $this->assertStatusCode(200, $client);

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $form = $formCrawler->selectButton('Create')->form(array(
            // DO STUFF HERE.
            // 'publications[FIELDNAME]' => 'FIELDVALUE',
        ));

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $responseCrawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // $this->assertEquals(1, $responseCrawler->filter('td:contains("FIELDVALUE")')->count());
    }

    /**
     * @group admin
     * @group new
     */
    public function testAdminNewPopup() {
        $client = $this->makeClient(LoadUser::ADMIN);
        $formCrawler = $client->request('GET', '/publication/new_popup');
        $this->assertStatusCode(200, $client);

        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
        $form = $formCrawler->selectButton('Create')->form(array(
            // DO STUFF HERE.
            // 'publications[FIELDNAME]' => 'FIELDVALUE',
        ));

        $client->submit($form);
        $this->assertTrue($client->getResponse()->isRedirect());
        $responseCrawler = $client->followRedirect();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        // $this->assertEquals(1, $responseCrawler->filter('td:contains("FIELDVALUE")')->count());
    }

    /**
     * @group anon
     * @group delete
     */
    public function testAnonDelete() {
        $client = $this->makeClient();
        $crawler = $client->request('GET', '/publication/1/delete');
        $this->assertStatusCode(302, $client);
        $this->assertTrue($client->getResponse()->isRedirect());
    }

    /**
     * @group user
     * @group delete
     */
    public function testUserDelete() {
        $client = $this->makeClient(LoadUser::USER);
        $crawler = $client->request('GET', '/publication/1/delete');
        $this->assertStatusCode(403, $client);
    }

    /**
     * @group admin
     * @group delete
     */
    public function testAdminDelete() {
        $preCount = count($this->em->getRepository(Publication::class)->findAll());
        $client = $this->makeClient(LoadUser::ADMIN);
        $crawler = $client->request('GET', '/publication/1/delete');
        $this->assertStatusCode(302, $client);
        $this->assertTrue($client->getResponse()->isRedirect());
        $responseCrawler = $client->followRedirect();
        $this->assertStatusCode(200, $client);

        $this->em->clear();
        $postCount = count($this->em->getRepository(Publication::class)->findAll());
        $this->assertEquals($preCount - 1, $postCount);
    }
}
