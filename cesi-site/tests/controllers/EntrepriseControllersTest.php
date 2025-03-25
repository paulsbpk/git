<?php
use PHPUnit\Framework\TestCase;

class EntrepriseControllerTest extends TestCase
{
    private $entrepriseController;
    private $twig;
    private $entrepriseModel;

    protected function setUp(): void
    {
        // Créer un mock pour Twig
        $this->twig = $this->createMock(\Twig\Environment::class);
        
        // Créer un mock pour le modèle Entreprise
        $this->entrepriseModel = $this->getMockBuilder(Entreprise::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        // Créer le controller avec les mocks
        $this->entrepriseController = new EntrepriseController($this->twig);
        
        // Injecter le mock du modèle dans le controller
        $reflection = new ReflectionClass(EntrepriseController::class);
        $property = $reflection->getProperty('entrepriseModel');
        $property->setAccessible(true);
        $property->setValue($this->entrepriseController, $this->entrepriseModel);
    }

    public function testIndex()
    {
        // Données de test
        $page = 1;
        $entreprisesParPage = 9;
        $entreprises = [
            ['nom' => 'TechCorp', 'secteur' => 'Technologie', 'ville' => 'Paris'],
            ['nom' => 'FinSoft', 'secteur' => 'Finance', 'ville' => 'Londres']
        ];
        
        $data = [
            'entreprises' => $entreprises,
            'page_courante' => $page,
            'total_pages' => 2,
            'index_depart' => 0,
            'entreprises_par_page' => $entreprisesParPage,
            'total_entreprises' => 15
        ];
        
        // Configurer les attentes pour les méthodes du mock
        $this->entrepriseModel->expects($this->once())
            ->method('getEntreprisesByPage')
            ->with($page, $entreprisesParPage)
            ->willReturn($data);
        
        $this->entrepriseModel->expects($this->exactly(2))
            ->method('getCouleurSecteur')
            ->withConsecutive(['Technologie'], ['Finance'])
            ->willReturnOnConsecutiveCalls('#3498db', '#2ecc71');
        
        // Configurer les attentes pour le rendu Twig
        $this->twig->expects($this->once())
            ->method('render')
            ->with('entreprise/index.html.twig', $this->callback(function($arg) {
                return isset($arg['entreprises']) && 
                       isset($arg['page_courante']) && 
                       isset($arg['total_pages']);
            }));
        
        // Définir $_GET pour le test
        $_GET['page'] = $page;
        
        // Exécuter la méthode à tester
        $this->entrepriseController->index();
    }

    public function testGenererLiensPagination()
    {
        $pageCourante = 2;
        $totalPages = 5;
        
        $result = $this->entrepriseController->genererLiensPagination($pageCourante, $totalPages);
        
        $this->assertIsArray($result);
        $this->assertArrayHasKey('page_courante', $result);
        $this->assertArrayHasKey('total_pages', $result);
        $this->assertEquals($pageCourante, $result['page_courante']);
        $this->assertEquals($totalPages, $result['total_pages']);
    }
    
    public function testIndexWithDefaultPage()
    {
        // Simuler l'absence de paramètre page
        unset($_GET['page']);
        
        // Données de test
        $defaultPage = 1;
        $entreprisesParPage = 9;
        $entreprises = [
            ['nom' => 'TechCorp', 'secteur' => 'Technologie', 'ville' => 'Paris']
        ];
        
        $data = [
            'entreprises' => $entreprises,
            'page_courante' => $defaultPage,
            'total_pages' => 1,
            'index_depart' => 0,
            'entreprises_par_page' => $entreprisesParPage,
            'total_entreprises' => 1
        ];
        
        // Configurer les attentes pour les méthodes du mock
        $this->entrepriseModel->expects($this->once())
            ->method('getEntreprisesByPage')
            ->with($defaultPage, $entreprisesParPage)
            ->willReturn($data);
            
        $this->entrepriseModel->expects($this->once())
            ->method('getCouleurSecteur')
            ->with('Technologie')
            ->willReturn('#3498db');
        
        // Configurer les attentes pour le rendu Twig
        $this->twig->expects($this->once())
            ->method('render')
            ->with('entreprise/index.html.twig', $this->anything());
        
        // Exécuter la méthode à tester
        $this->entrepriseController->index();
    }
}