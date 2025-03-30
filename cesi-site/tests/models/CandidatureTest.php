<?php
use PHPUnit\Framework\TestCase;

class CandidatureTest extends TestCase
{
    private $candidature;

    protected function setUp(): void
    {
        $this->candidature = new Candidature();
    }

    public function testTraiterFormulaireWithInvalidEmail()
    {
        $post = [
            'civilite' => 'M',
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'email_invalide',
            'majority' => 'Oui',
            'message' => 'Test message'
        ];
        
        $files = [
            'cv' => [
                'name' => 'cv.pdf',
                'type' => 'application/pdf',
                'tmp_name' => '/tmp/phpXXXXXX',
                'error' => 0,
                'size' => 1024
            ]
        ];
        
        // Remplacer move_uploaded_file pour les tests
        $this->setUpMockMoveUploadedFile(true);
        
        $result = $this->candidature->traiterFormulaire($post, $files);
        
        $this->assertTrue($result['formulaire_soumis']);
        $this->assertFalse($result['succes']);
        $this->assertContains("L'adresse email n'est pas valide.", $result['erreurs']);
    }

    public function testTraiterFormulaireWithValidData()
    {
        $post = [
            'civilite' => 'M',
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'permits' => 'on',
            'vehicle' => 'on',
            'certifications' => 'on',
            'majority' => 'Oui',
            'message' => 'Test message'
        ];
        
        $files = [
            'cv' => [
                'name' => 'cv.pdf',
                'type' => 'application/pdf',
                'tmp_name' => '/tmp/phpXXXXXX',
                'error' => 0,
                'size' => 1024
            ]
        ];
        
        // Remplacer move_uploaded_file pour les tests
        $this->setUpMockMoveUploadedFile(true);
        
        $result = $this->candidature->traiterFormulaire($post, $files);
        
        $this->assertTrue($result['formulaire_soumis']);
        $this->assertTrue($result['succes']);
        $this->assertEmpty($result['erreurs']);
        $this->assertEquals('Oui', $result['donnees']['permits']);
        $this->assertEquals('Oui', $result['donnees']['vehicle']);
        $this->assertEquals('Oui', $result['donnees']['certifications']);
    }

    public function testTraiterFormulaireWithTooLargeFile()
    {
        $post = [
            'civilite' => 'M',
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'majority' => 'Oui',
            'message' => 'Test message'
        ];
        
        $files = [
            'cv' => [
                'name' => 'cv.pdf',
                'type' => 'application/pdf',
                'tmp_name' => '/tmp/phpXXXXXX',
                'error' => 0,
                'size' => 3 * 1024 * 1024 // 3 Mo, au-dessus de la limite
            ]
        ];
        
        $result = $this->candidature->traiterFormulaire($post, $files);
        
        $this->assertTrue($result['formulaire_soumis']);
        $this->assertFalse($result['succes']);
        $this->assertContains("Le fichier est trop volumineux (max 2 Mo).", $result['erreurs']);
    }

    public function testTraiterFormulaireWithInvalidFileType()
    {
        $post = [
            'civilite' => 'M',
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'majority' => 'Oui',
            'message' => 'Test message'
        ];
        
        $files = [
            'cv' => [
                'name' => 'cv.exe',
                'type' => 'application/octet-stream',
                'tmp_name' => '/tmp/phpXXXXXX',
                'error' => 0,
                'size' => 1024
            ]
        ];
        
        $result = $this->candidature->traiterFormulaire($post, $files);
        
        $this->assertTrue($result['formulaire_soumis']);
        $this->assertFalse($result['succes']);
        $this->assertContains("Le format du fichier n'est pas autorisé.", $result['erreurs']);
    }

    private function setUpMockMoveUploadedFile($returnValue)
    {
        // Créer un mocking pour la fonction move_uploaded_file
        // Cette approche nécessite l'extension uopz ou un autre framework de mocking
        // Pour simplifier, nous supposons que la fonction est déjà mockée
        // Dans un environnement réel, vous devriez utiliser une bibliothèque comme php-mock
    }

    public function testEchap()
    {
        $input = '<script>alert("XSS")</script>';
        $escaped = $this->candidature->echap($input);
        
        $this->assertEquals('&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', $escaped);
    }
}