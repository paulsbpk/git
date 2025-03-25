<?php
class Entreprise {
    private $entreprises = [];

    public function __construct() {
        $this->entreprises = [
            ['nom' => 'TechCorp', 'secteur' => 'Technologie', 'ville' => 'Paris'],
            ['nom' => 'FinSoft', 'secteur' => 'Finance', 'ville' => 'Londres'],
            ['nom' => 'MediCare', 'secteur' => 'Santé', 'ville' => 'Berlin'],
            ['nom' => 'GreenEnergy', 'secteur' => 'Énergie', 'ville' => 'Amsterdam'],
            ['nom' => 'EduSmart', 'secteur' => 'Éducation', 'ville' => 'New York'],
            ['nom' => 'AutoDrive', 'secteur' => 'Automobile', 'ville' => 'Détroit'],
            ['nom' => 'CyberSafe', 'secteur' => 'Cybersécurité', 'ville' => 'San Francisco'],
            ['nom' => 'RetailMax', 'secteur' => 'Commerce', 'ville' => 'Londres'],
            ['nom' => 'AeroTech', 'secteur' => 'Aéronautique', 'ville' => 'Toulouse'],
            ['nom' => 'AgriFuture', 'secteur' => 'Agriculture', 'ville' => 'Bruxelles'],
            ['nom' => 'FoodLovers', 'secteur' => 'Agroalimentaire', 'ville' => 'Madrid'],
            ['nom' => 'BuildIt', 'secteur' => 'BTP', 'ville' => 'Lyon'],
            ['nom' => 'SoftLogic', 'secteur' => 'Technologie', 'ville' => 'Dublin'],
            ['nom' => 'BankTrust', 'secteur' => 'Banque', 'ville' => 'Zurich'],
            ['nom' => 'HealthFirst', 'secteur' => 'Santé', 'ville' => 'Toronto'],
            ['nom' => 'EcoSolutions', 'secteur' => 'Énergie', 'ville' => 'Stockholm'],
            ['nom' => 'AI Revolution', 'secteur' => 'Intelligence Artificielle', 'ville' => 'Singapour'],
            ['nom' => 'CloudNet', 'secteur' => 'Cloud Computing', 'ville' => 'Seattle'],
            ['nom' => 'MovieWorld', 'secteur' => 'Divertissement', 'ville' => 'Los Angeles'],
            ['nom' => 'Sportify', 'secteur' => 'Sport', 'ville' => 'Milan'],
            ['nom' => 'LogisFast', 'secteur' => 'Logistique', 'ville' => 'Hambourg'],
            ['nom' => 'GreenMobility', 'secteur' => 'Transport', 'ville' => 'Oslo'],
            ['nom' => 'WebDevPro', 'secteur' => 'Développement Web', 'ville' => 'San Diego'],
            ['nom' => 'PharmaPlus', 'secteur' => 'Pharmaceutique', 'ville' => 'Bruxelles'],
            ['nom' => 'DataScienceX', 'secteur' => 'Data Science', 'ville' => 'Boston'],
            ['nom' => 'GameStudio', 'secteur' => 'Jeux Vidéo', 'ville' => 'Tokyo'],
            ['nom' => 'SmartHome', 'secteur' => 'Domotique', 'ville' => 'Munich'],
            ['nom' => 'InvestSec', 'secteur' => 'Investissement', 'ville' => 'Genève'],
            ['nom' => 'AI Labs', 'secteur' => 'Technologie', 'ville' => 'Palo Alto'],
            ['nom' => 'LuxuryStyle', 'secteur' => 'Mode', 'ville' => 'Paris'],
            ['nom' => 'SpaceXplore', 'secteur' => 'Aérospatial', 'ville' => 'Houston'],
            ['nom' => 'SmartMed', 'secteur' => 'Biotechnologie', 'ville' => 'Copenhague'],
            ['nom' => 'CloudSafe', 'secteur' => 'Cybersécurité', 'ville' => 'Tel Aviv'],
            ['nom' => 'WineExperts', 'secteur' => 'Viticulture', 'ville' => 'Bordeaux'],
            ['nom' => 'AI Consulting', 'secteur' => 'Conseil', 'ville' => 'Dubaï'],
            ['nom' => 'RecyclingPro', 'secteur' => 'Environnement', 'ville' => 'Vienne'],
            ['nom' => 'CyberTech', 'secteur' => 'Technologie', 'ville' => 'Berlin'],
            ['nom' => 'MobilityFuture', 'secteur' => 'Transport', 'ville' => 'Chicago'],
            ['nom' => 'BigDataCorp', 'secteur' => 'Analyse de données', 'ville' => 'Bangalore'],
            ['nom' => 'LuxuryCar', 'secteur' => 'Automobile', 'ville' => 'Maranello'],
            ['nom' => 'FashionTrends', 'secteur' => 'Mode', 'ville' => 'Milan'],
            ['nom' => 'E-ShopMaster', 'secteur' => 'E-commerce', 'ville' => 'San José'],
            ['nom' => 'CodeGenius', 'secteur' => 'Développement logiciel', 'ville' => 'Toronto'],
            ['nom' => 'HealthCare+ ', 'secteur' => 'Santé', 'ville' => 'Stockholm'],
            ['nom' => 'CryptoSecure', 'secteur' => 'Finance', 'ville' => 'Hong Kong'],
            ['nom' => 'RoboticWorld', 'secteur' => 'Robotique', 'ville' => 'Pékin'],
            ['nom' => 'GreenConstruct', 'secteur' => 'BTP', 'ville' => 'Sydney'],
            ['nom' => 'FinTechInnov', 'secteur' => 'Finance', 'ville' => 'Luxembourg'],
            ['nom' => 'MedTechLabs', 'secteur' => 'Technologie médicale', 'ville' => 'Boston'],
            ['nom' => 'AutoAI', 'secteur' => 'Automobile', 'ville' => 'Shenzhen'],
        ];
    }

    public function getAllEntreprises() {
        return $this->entreprises;
    }

    public function getEntreprisesByPage($page, $entreprisesParPage) {
        $page = max(1, intval($page));
        $totalPages = ceil(count($this->entreprises) / $entreprisesParPage);
        $page = min($page, $totalPages);
        
        $indexDepart = ($page - 1) * $entreprisesParPage;
        return [
            'entreprises' => array_slice($this->entreprises, $indexDepart, $entreprisesParPage),
            'page_courante' => $page,
            'total_pages' => $totalPages,
            'index_depart' => $indexDepart,
            'entreprises_par_page' => $entreprisesParPage,
            'total_entreprises' => count($this->entreprises)
        ];
    }

    public function getCouleurSecteur($secteur) {
        $couleurs = [
            'Technologie' => '#3498db',
            'Finance' => '#2ecc71',
            'Santé' => '#e74c3c',
            'Énergie' => '#f39c12',
            'Éducation' => '#9b59b6',
            'Automobile' => '#34495e',
            'Cybersécurité' => '#1abc9c',
            'Commerce' => '#d35400',
            'Aéronautique' => '#7f8c8d',
            'Agriculture' => '#27ae60',
            'Agroalimentaire' => '#c0392b',
            'BTP' => '#f1c40f',
            'Banque' => '#16a085',
            'Intelligence Artificielle' => '#8e44ad',
            'Cloud Computing' => '#3498db',
            'Divertissement' => '#e67e22',
            'Sport' => '#2980b9',
            'Logistique' => '#7f8c8d',
            'Transport' => '#d35400',
            'Développement Web' => '#3498db',
            'Pharmaceutique' => '#e74c3c',
            'Data Science' => '#9b59b6',
            'Jeux Vidéo' => '#2c3e50',
            'Domotique' => '#1abc9c',
            'Investissement' => '#2ecc71',
            'Mode' => '#e84393',
            'Aérospatial' => '#34495e',
            'Biotechnologie' => '#e74c3c',
            'Viticulture' => '#8e44ad',
            'Conseil' => '#3498db',
            'Environnement' => '#27ae60',
            'Analyse de données' => '#9b59b6',
            'E-commerce' => '#e67e22',
            'Développement logiciel' => '#3498db',
            'Technologie médicale' => '#e74c3c',
            'Robotique' => '#0984e3'
        ];
        
        return isset($couleurs[$secteur]) ? $couleurs[$secteur] : '#95a5a6'; 
    }
}