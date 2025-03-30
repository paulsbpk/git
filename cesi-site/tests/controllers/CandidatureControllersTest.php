<?php
use PHPUnit\Framework\TestCase;

class CandidatureControllerTest extends TestCase
{
    private $candidatureController;
    private $twig;
    private $candidatureModel;

    protected function setUp(): void
    {
        // Créer un mock pour Twig
        $this->twig = $this->createMock(\Twig\Environment::class);
        
        // Créer un mock pour le modèle Candidature
        $this->candidatureModel = $this->getMockBuilder(Candidature::class)
            ->disableOriginalConstructor()
            ->getMock();
        
        // Créer le controller avec le mock Twig
        $this->candidatureController = new CandidatureController($this->twig);
        
        // Injecter le mock du modèle dans le controller
        $reflection = new ReflectionClass(CandidatureController::class);
        $property = $reflection->getProperty('candidatureModel');
        $property->setAccessible(true);
        $property->setValue($this->candidatureController, $this->candidatureModel);
    }

    public function testShowFormGet()
    {
        // Simuler une requête GET
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        // Configurer les attentes pour le rendu Twig
        $this->twig->expects($this->once())
            ->method('render')
            ->with('candidature/form.html.twig', $this->callback(function($arg) {
                return isset($arg['donnees']) && 
                       isset($arg['erreurs']) && 
                       isset($arg['formulaire_soumis']) &&
                       isset($arg['succes']) &&
                       $arg['formulaire_soumis'] === false;
            }));
        
        // Exécuter la méthode à tester
        $this->candidatureController->showForm();
    }

    public function testShowFormPost()
    {
        // Simuler une requête POST
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['nom' => 'Test', 'email' => 'test@example.com'];
        $_FILES = ['cv' => ['name' => 'cv.pdf']];
        
        // Données de retour simulées du modèle
        $resultData = [
            'formulaire_soumis' => true,
            'donnees' => ['nom' => 'Test', 'email' => 'test@example.com'],
            'erreurs' => [],
            'succes' => true
        ];
        
        // Configurer les attentes pour la méthode du modèle
        $this->candidatureModel->expects($this->once())
            ->method('traiterFormulaire')
            ->with($_POST, $_FILES)
            ->willReturn($resultData);
        
        // Configurer les attentes pour le rendu Twig
        $this->twig->expects($this->once())
            ->method('render')
            ->with('candidature/form.html.twig', $this->callback(function($arg) {
                return isset($arg['donnees']) && 
                       isset($arg['erreurs']) && 
                       isset($arg['formulaire_soumis']) &&
                       isset($arg['succes']) &&
                       $arg['formulaire_soumis'] === true &&
                       $arg['succes'] === true;
            }));
        
        // Exécuter la méthode à tester
        $this->candidatureController->showForm();
    }

    public function testShowFormPostWithErrors()
    {
        // Simuler une requête POST
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST = ['nom' => 'Test', 'email' => 'email_invalide'];
        $_FILES = ['cv' => ['name' => 'cv.pdf']];
        
        // Données de retour simulées du modèle avec erreurs
        $resultData = [
            'formulaire_soumis' => true,
            'donnees' => ['nom' => 'Test', 'email' => 'email_invalide'],
            'erreurs' => ["L'adresse email n'est pas valide."],
            'succes' => false
        ];
        
        // Configurer les attentes pour la méthode du modèle
        $this->candidatureModel->expects($this->once())
            ->method('traiterFormulaire')
            ->with($_POST, $_FILES)
            ->willReturn($resultData);
        
        // Configurer les attentes pour le rendu Twig
        $this->twig->expects($this->once())
            ->method('render')
            ->with('candidature/form.html.twig', $this->callback(function($arg) {
                return isset($arg['donnees']) && 
                       isset($arg['erreurs']) && 
                       isset($arg['formulaire_soumis']) &&
                       isset($arg['succes']) &&
                       $arg['formulaire_soumis'] === true &&
                       $arg['succes'] === false &&
                       count($arg['erreurs']) > 0;
            }));
        
        // Exécuter la méthode à tester
        $this->candidatureController->showForm();
    }
}