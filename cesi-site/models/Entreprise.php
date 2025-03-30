<?php
require_once '../config/database.php';


class EntrepriseModel {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function getEntreprisesByPage($page, $entreprisesParPage) {
        $offset = ($page - 1) * $entreprisesParPage;
        
        $stmt = $this->pdo->prepare("SELECT * FROM entreprise LIMIT :offset, :limit");
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $entreprisesParPage, PDO::PARAM_INT);
        $stmt->execute();
        $entreprises = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $totalStmt = $this->pdo->query("SELECT COUNT(*) FROM entreprise");
        $totalEntreprises = $totalStmt->fetchColumn();
        
        return [
            'entreprises' => $entreprises,
            'page_courante' => $page,
            'total_pages' => ceil($totalEntreprises / $entreprisesParPage),
            'index_depart' => $offset,
            'entreprises_par_page' => $entreprisesParPage,
            'total_entreprises' => $totalEntreprises
        ];
    }

    public function createEntreprise($nom, $description) {
        $stmt = $this->pdo->prepare("INSERT INTO entreprise (Nom_entreprise, Description) VALUES (:nom, :description)");
        $stmt->execute(['nom' => $nom, 'description' => $description]);
    }
}
?>
