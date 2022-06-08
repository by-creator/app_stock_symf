<?php

namespace App\Test\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProduitControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProduitRepository $repository;
    private string $path = '/produit/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Produit::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit index');

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
            'produit[libelle]' => 'Testing',
            'produit[qte]' => 'Testing',
            'produit[prix]' => 'Testing',
            'produit[categorie]' => 'Testing',
            'produit[users]' => 'Testing',
        ]);

        self::assertResponseRedirects('/produit/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setLibelle('My Title');
        $fixture->setQte('My Title');
        $fixture->setPrix('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setUsers('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Produit');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Produit();
        $fixture->setLibelle('My Title');
        $fixture->setQte('My Title');
        $fixture->setPrix('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setUsers('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'produit[libelle]' => 'Something New',
            'produit[qte]' => 'Something New',
            'produit[prix]' => 'Something New',
            'produit[categorie]' => 'Something New',
            'produit[users]' => 'Something New',
        ]);

        self::assertResponseRedirects('/produit/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getLibelle());
        self::assertSame('Something New', $fixture[0]->getQte());
        self::assertSame('Something New', $fixture[0]->getPrix());
        self::assertSame('Something New', $fixture[0]->getCategorie());
        self::assertSame('Something New', $fixture[0]->getUsers());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Produit();
        $fixture->setLibelle('My Title');
        $fixture->setQte('My Title');
        $fixture->setPrix('My Title');
        $fixture->setCategorie('My Title');
        $fixture->setUsers('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/produit/');
    }
}
