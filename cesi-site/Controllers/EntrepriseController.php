<?php
require_once '../models/EntrepriseModel.php';

class EntrepriseController {
    private $entrepriseModel;
    private $twig;
    
    public function __construct($twig) {
        $this->entrepriseModel = new EntrepriseModel();
        $this->twig = $twig;
    }
    
    public function index() {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $entreprisesParPage = 9;
        
        $data = $this->entrepriseModel->getEntreprisesByPage($page, $entreprisesParPage);
        
        echo $this->twig->render('entreprise/index.html.twig', [
            'entreprises' => $data['entreprises'],
            'page_courante' => $data['page_courante'],
            'total_pages' => $data['total_pages'],
            'index_depart' => $data['index_depart'],
            'entreprises_par_page' => $data['entreprises_par_page'],
            'total_entreprises' => $data['total_entreprises']
        ]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $description = $_POST['description'] ?? '';
            
            if (!empty($nom) && !empty($description)) {
                $this->entrepriseModel->createEntreprise($nom, $description);
                header('Location: index.php?route=entreprises');
                exit();
            }
        }
    }
}

?>
