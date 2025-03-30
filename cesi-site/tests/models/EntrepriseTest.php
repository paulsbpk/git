<?php
use PHPUnit\Framework\TestCase;

class EntrepriseTest extends TestCase
{
    private $entreprise;

    protected function setUp(): void
    {
        $this->entreprise = new Entreprise();
    }

    public function testGetAllEntreprises()
    {
        $entreprises = $this->entreprise->getAllEntreprises();
        $this->assertIsArray($entreprises);
        $this->assertNotEmpty($entreprises);
        $this->assertArrayHasKey('nom', $entreprises[0]);
        $this->assertArrayHasKey('secteur', $entreprises[0]);
        $this->assertArrayHasKey('ville', $entreprises[0]);
    }

    public function testGetEntreprisesByPage()
    {
        $page = 1;
        $entreprisesParPage = 10;
        $result = $this->entreprise->getEntreprisesByPage($page, $entreprisesParPage);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('entreprises', $result);
        $this->assertArrayHasKey('page_courante', $result);
        $this->assertArrayHasKey('total_pages', $result);
        $this->assertArrayHasKey('index_depart', $result);
        $this->assertArrayHasKey('entreprises_par_page', $result);
        $this->assertArrayHasKey('total_entreprises', $result);
        
        $this->assertEquals($page, $result['page_courante']);
        $this->assertEquals($entreprisesParPage, $result['entreprises_par_page']);
        $this->assertCount($entreprisesParPage, $result['entreprises']);
    }

    public function testGetEntreprisesByPageWithInvalidPage()
    {
        $page = -1; // Page invalide
        $entreprisesParPage = 10;
        $result = $this->entreprise->getEntreprisesByPage($page, $entreprisesParPage);

        $this->assertEquals(1, $result['page_courante']); // Devrait être ajusté à 1
    }

    public function testGetEntreprisesByPageWithExceedingPage()
    {
        $entreprisesParPage = 10;
        $totalEntreprises = count($this->entreprise->getAllEntreprises());
        $totalPages = ceil($totalEntreprises / $entreprisesParPage);
        
        $page = $totalPages + 1; // Page dépassant le total
        $result = $this->entreprise->getEntreprisesByPage($page, $entreprisesParPage);

        $this->assertEquals($totalPages, $result['page_courante']); // Devrait être ajusté à la dernière page
    }

    public function testGetCouleurSecteur()
    {
        $secteur = 'Technologie';
        $couleur = $this->entreprise->getCouleurSecteur($secteur);
        
        $this->assertEquals('#3498db', $couleur);
        
        // Test avec un secteur inexistant
        $secteurInexistant = 'SecteurInexistant';
        $couleurDefaut = $this->entreprise->getCouleurSecteur($secteurInexistant);
        
        $this->assertEquals('#95a5a6', $couleurDefaut);
    }
}