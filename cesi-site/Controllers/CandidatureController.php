<?php
require_once '../models/Candidature.php';

class CandidatureController {
    private $candidatureModel;
    private $twig;
    
    public function __construct($twig) {
        $this->candidatureModel = new Candidature();
        $this->twig = $twig;
    }
    
    public function showForm() {
        $result = [
            'formulaire_soumis' => false,
            'donnees' => [],
            'erreurs' => [],
            'succes' => false
        ];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $this->candidatureModel->traiterFormulaire($_POST, $_FILES);
        }
        
        echo $this->twig->render('candidature/form.html.twig', [
            'donnees' => $result['donnees'],
            'erreurs' => $result['erreurs'],
            'formulaire_soumis' => $result['formulaire_soumis'],
            'succes' => $result['succes']
        ]);
    }
}