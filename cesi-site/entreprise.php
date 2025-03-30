<?php

$entreprises = [
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


$entreprisesParPage = 9;
$totalPages = ceil(count($entreprises) / $entreprisesParPage);
$pageCourante = 1; 

if (isset($_GET['page']) && !empty($_GET['page'])) {
    $pageRequise = intval($_GET['page']);
    
    if ($pageRequise > 0 && $pageRequise <= $totalPages) {
        $pageCourante = $pageRequise;
    }
}
$indexDepart = ($pageCourante - 1) * $entreprisesParPage;
$entreprisesPagination = array_slice($entreprises, $indexDepart, $entreprisesParPage);


function genererLiensPagination($pageCourante, $totalPages) {
    $html = '<div class="pagination">';
    
    if ($pageCourante > 1) {
        $html .= '<a href="?page=' . ($pageCourante - 1) . '" class="pagination-btn prev">Précédent</a>';
    } else {
        $html .= '<span class="pagination-btn prev disabled">Précédent</span>';
    }
    
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $pageCourante) {
            $html .= '<span class="page-number active">' . $i . '</span>';
        } else {
            $html .= '<a href="?page=' . $i . '" class="page-number">' . $i . '</a>';
        }
    }
    
    if ($pageCourante < $totalPages) {
        $html .= '<a href="?page=' . ($pageCourante + 1) . '" class="pagination-btn next">Suivant</a>';
    } else {
        $html .= '<span class="pagination-btn next disabled">Suivant</span>';
    }
    $html .= '</div>';
    return $html;
}


function getCouleurSecteur($secteur) {
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
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cesi-static.local/entreprise.css" rel="stylesheet">
    <title>Liste des Entreprises Partenaires</title>
</head>
<body>
<img src="http://cesi-static.local/image/logo-lbp-header.png" class="TITRE" alt="Logo de LEBONPLAN">
    <div class="barre">
        <div class="nav-links">
            <a href="accueil.html" class="nav">Accueil</a>
            <a href="Entreprises.html" class="nav">Entreprises</a>
            <a href="http://cesi-site.local/index.php" class="nav">Offres</a>
            <a href="Wishlist.html" class="nav">Wishlist</a>
            <a href="Contact.html" class="nav">Contact</a>
        </div>
    
        <div class="header-right">
            <a href="Connexion.html" class="log">CONNEXION</a>
            <a href="Inscription.html" class="log2">S'INSCRIRE</a>
        </div>
    </div>
    
    <div class="hierarchie">
        <a href="accueil.html" class="arbo">Accueil ></a>
        <a href="#" class="arbo2">Entreprises</a>
    </div>
    
    <h1>Liste des Entreprises Partenaires</h1>
    
    <div class="page-info">
        Page <?php echo $pageCourante; ?> sur <?php echo $totalPages; ?> - 
        Affichage de <?php echo $indexDepart + 1; ?> à 
        <?php echo min($indexDepart + $entreprisesParPage, count($entreprises)); ?> 
        sur <?php echo count($entreprises); ?> entreprises
    </div>
    
    <div class="entreprises-grid">
        <?php foreach ($entreprisesPagination as $entreprise): ?>
        <div class="entreprise-card">
            <div class="card-header">
                <?php echo htmlspecialchars($entreprise['nom']); ?>
            </div>
            <div class="card-body">
                <div class="secteur-badge" style="background-color: <?php echo getCouleurSecteur($entreprise['secteur']); ?>">
                    <?php echo htmlspecialchars($entreprise['secteur']); ?>
                </div>
                <div class="ville-info">
                    <?php echo htmlspecialchars($entreprise['ville']); ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <?php echo genererLiensPagination($pageCourante, $totalPages); ?>
    
    <button id="scrollTopBtn" class="scroll-top-btn" onclick="topFunction()">↑</button>
    
    <footer class="Foot">
        <p class="pieds">@2024 Tous droits sont réservés WEB4ALL</p>
    </footer>
    
   
</body>
</html>