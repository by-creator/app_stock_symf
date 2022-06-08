<?php

namespace App\Test\Controller;

use App\Entity\Sortie;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SortieControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SortieRepository $repository;
    private string $path = '/sortie/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Sortie::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Sortie index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'sortie[dateS]' => 'Testing',
            'sortie[qteS]' => 'Testing',
            'sortie[produit]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sortie/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Sortie();
        $fixture->setDateS('My Title');
        $fixture->setQteS('My Title');
        $fixture->setProduit('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Sortie');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Sortie();
        $fixture->setDateS('My Title');
        $fixture->setQteS('My Title');
        $fixture->setProduit('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'sortie[dateS]' => 'Something New',
            'sortie[qteS]' => 'Something New',
            'sortie[produit]' => 'Something New',
        ]);

        self::assertResponseRedirects('/sortie/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateS());
        self::assertSame('Something New', $fixture[0]->getQteS());
        self::assertSame('Something New', $fixture[0]->getProduit());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Sortie();
        $fixture->setDateS('My Title');
        $fixture->setQteS('My Title');
        $fixture->setProduit('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/sortie/');
    }
}
