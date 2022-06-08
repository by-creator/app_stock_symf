<?php

namespace App\Test\Controller;

use App\Entity\Entree;
use App\Repository\EntreeRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EntreeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntreeRepository $repository;
    private string $path = '/entree/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Entree::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entree index');

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
            'entree[dateE]' => 'Testing',
            'entree[qteE]' => 'Testing',
            'entree[produit]' => 'Testing',
        ]);

        self::assertResponseRedirects('/entree/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entree();
        $fixture->setDateE('My Title');
        $fixture->setQteE('My Title');
        $fixture->setProduit('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Entree');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Entree();
        $fixture->setDateE('My Title');
        $fixture->setQteE('My Title');
        $fixture->setProduit('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'entree[dateE]' => 'Something New',
            'entree[qteE]' => 'Something New',
            'entree[produit]' => 'Something New',
        ]);

        self::assertResponseRedirects('/entree/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDateE());
        self::assertSame('Something New', $fixture[0]->getQteE());
        self::assertSame('Something New', $fixture[0]->getProduit());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Entree();
        $fixture->setDateE('My Title');
        $fixture->setQteE('My Title');
        $fixture->setProduit('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/entree/');
    }
}
