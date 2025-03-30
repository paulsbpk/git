<?php
$tableau_donnee = [];
$erreurs = [];
$formulaire_soumis = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formulaire_soumis = true;
    
    // récupérer les données du form dans un tableau
    $tableau_donnee = [
        'civilite' => isset($_POST['civilite']) ? $_POST['civilite'] : '',
        'nom' => isset($_POST['nom']) ? $_POST['nom'] : '',
        'prenom' => isset($_POST['prenom']) ? $_POST['prenom'] : '',
        'email' => isset($_POST['email']) ? $_POST['email'] : '',
        'permits' => isset($_POST['permits']) ? 'Oui' : 'Non',
        'vehicle' => isset($_POST['vehicle']) ? 'Oui' : 'Non',
        'certifications' => isset($_POST['certifications']) ? 'Oui' : 'Non',
        'majority' => isset($_POST['majority']) ? $_POST['majority'] : '',
        'message' => isset($_POST['message']) ? $_POST['message'] : ''
    ];
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'adresse email n'est pas valide.";
    }

    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $taille_MAX = 2 * 1024 * 1024;
        $ext_acceptee = ['pdf', 'doc', 'docx', 'odt', 'jpeg', 'jpg', 'png'];

        if ($_FILES['cv']['size'] > $taille_MAX) {
            $erreurs[] = "Le fichier est trop volumineux (max 2 Mo).";
        }

        $fileExtension = pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $ext_acceptee)) {
            $erreurs[] = "Le format du fichier n'est pas autorisé. Formats acceptés : .pdf, .doc, .docx, .odt, .jpeg, .jpg, .png.";
        }

        if (empty($erreurs)) {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $nom_fichier = uniqid('cv_') . '.' . $fileExtension;
            $chemin_fichier = $uploadDir . $nom_fichier;
            $tableau_donnee['cv'] = $nom_fichier;

            if (!move_uploaded_file($_FILES['cv']['tmp_name'], $chemin_fichier)) {
                $erreurs[] = "Une erreur est survenue lors de l'upload du fichier.";
            }
        }
    } else {
        $erreurs[] = "Veuillez sélectionner un fichier pour le CV.";
    }
}

function echap($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://cesi-static.local/style.css" rel="stylesheet">
    <title>LEBONPLAN</title>
</head>
<body>
    <img src="http://cesi-static.local/image/logo-lbp-header.png" class="TITRE" alt="Logo de LEBONPLAN">

    <nav class="barre">
        <div class="nav-links">
            <a href="accueil.html" class="nav">Accueil</a>
            <a href="http://cesi-site.local/entreprise.php" class="nav">Entreprises</a>
            <a href="index.html">Offres</a>
            <a href="Wishlist.html" class="nav">Wishlist</a>
            <a href="Contact.html" class="nav">Contact</a>
        </div>
    
        <div class="header-right">
            <a href="Connexion.html" class="log">CONNEXION</a>
            <a href="Inscription.html" class="log2">S'INSCRIRE</a>
        </div>

        <div class="burger-menu" onclick="toggleMenu()">
            ☰
        </div>
    </nav>
    
    <div class="hierarchie">
        <a href="acceuil.html" class="arbo">Accueil ></a>
        <a href="index.html" class="arbo">Offres ></a>
        <a href="stage.html" class="arbo">Stages > </a> 
        <a href="#" class="arbo2"> Postuler</a>
    </div>

    <div id="mySidenav" class="sidenav">
        <a id="closeBtn" href="#" class="close">×</a>
        <ul>
            <a href="accueil.html" class="nav">Accueil</a>
            <a href="Entreprises.html" class="nav">Entreprises</a>
            <a href="index.html">Offres</a>
            <a href="Wishlist.html" class="nav">Wishlist</a>
            <a href="Contact.html" class="nav">Contact</a>
        </ul>
    </div>
      
    <a href="#" id="openBtn">
        <span class="burger-icon">
        <span></span>
        <span></span>
        <span></span>
        </span>
    </a>

    <h1 class="title">Postuler à une offre de stage</h1>
    <h5 class="desc">Vous pouvez ici répondre directement à l'offre de stage qui a été déposée par l'entreprise. Soyez le plus précis possible dans vos réponses !</h5>

    <h2 class="info">Stage - Administrateur Système et Réseau H/F</h2>
    <h6 class="co">IBM | Pornichet - 44 | Publiée le 29/01/2025 | Ref.123XYZ-44</h6>

    <div class="Resume">
        <h3 class="offre">Résumé de l'offre</h3>
        <button class="bouton">3 Mois</button>
        <button class="bouton">BAC+2, BAC+3</button>
        <button class="bouton">Système, Réseaux, Cloud</button>
        <button class="bouton">Exp - 1 an</button>
    </div>

    <?php if ($formulaire_soumis): ?>
        <?php if (!empty($erreurs)): ?>
            <div class="error-message">
                <p>Veuillez corriger les erreurs suivantes :</p>
                <ul>
                <?php foreach ($erreurs as $error): ?>
                    <li><?= echap($error) ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        

        <div class="data-display">
            <h3>Données soumises</h3>
            <div class="data-item">
                <span class="data-label">Civilité:</span>
                <span class="data-value"><?= echap($tableau_donnee['civilite']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Nom:</span>
                <span class="data-value"><?php echo echap($tableau_donnee['nom']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Prénom:</span>
                <span class="data-value"><?= echap($tableau_donnee['prenom']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Email:</span>
                <span class="data-value"><?= echap($tableau_donnee['email']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Permis B:</span>
                <span class="data-value"><?= echap($tableau_donnee['permits']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Véhicule:</span>
                <span class="data-value"><?= echap($tableau_donnee['vehicle']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Certifications:</span>
                <span class="data-value"><?= echap($tableau_donnee['certifications']) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Majeur:</span>
                <span class="data-value"><?= echap($tableau_donnee['majority']) === 'yes' ? 'Oui' : 'Non' ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">Message:</span>
                <span class="data-value"><?= nl2br(echap($tableau_donnee['message'])) ?></span>
            </div>
            <div class="data-item">
                <span class="data-label">CV:</span>
                <span class="data-value"><?= isset($tableau_donnee['cv']) ? echap($tableau_donnee['cv']) : 'Non transmis' ?></span>
            </div>
            <?php if (empty($erreurs)): ?>
                <p class="success-message">Candidature envoyée avec succès !</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="candidature">
        <h2>Envoyez votre candidature dès maintenant !</h2>
        <form method="POST" enctype="multipart/form-data">
            <label for="civilite" class="civ"><strong>CIVILITÉ</strong></label><br>
            <select id="civilite" name="civilite" class="choix">
                <option value="monsieur" <?= isset($tableau_donnee['civilite']) && $tableau_donnee['civilite'] === 'monsieur' ? 'selected' : '' ?>>Monsieur</option>
                <option value="madame" <?= isset($tableau_donnee['civilite']) && $tableau_donnee['civilite'] === 'madame' ? 'selected' : '' ?>>Madame</option>
            </select>
            
            <div>
                <h4 class="formulaire">NOM</h4>
                <input type="text" id="nom" name="nom" class="choix2" required value="<?= isset($tableau_donnee['nom']) ? echap($tableau_donnee['nom']) : '' ?>">
            </div>
            
            <div>
                <h4 class="formulaire">PRÉNOM</h4>
                <input type="text" id="prenom" name="prenom" class="choix2" required value="<?= isset($tableau_donnee['prenom']) ? echap($tableau_donnee['prenom']) : '' ?>">
            </div>
            
            <div>
                <h4 class="formulaire">COURRIEL</h4>
                <input type="email" id="email" name="email" class="mail" required value="<?= isset($tableau_donnee['email']) ? echap($tableau_donnee['email']) : '' ?>">
            </div>
            
            <div>
                <h4 class="formulaire">À PROPOS DE VOUS</h4>
                <label><input type="checkbox" name="permits" value="permis" class="checkbox" <?= isset($tableau_donnee['permits']) && $tableau_donnee['permits'] === 'Oui' ? 'checked' : '' ?>> Permis B</label><br>
                <label><input type="checkbox" name="vehicle" value="vehicule" class="checkbox" <?= isset($tableau_donnee['vehicle']) && $tableau_donnee['vehicle'] === 'Oui' ? 'checked' : '' ?>> Véhicule</label><br>
                <label><input type="checkbox" name="certifications" value="certifications" class="checkbox" <?= isset($tableau_donnee['certifications']) && $tableau_donnee['certifications'] === 'Oui' ? 'checked' : '' ?>> Certifications (Microsoft, Cisco...)</label><br>
            </div>
            
            <div class="majeur">
                <h4>JE SUIS MAJEUR :</h4>
                <label><input type="radio" name="majority" value="yes" required <?= isset($tableau_donnee['majority']) && $tableau_donnee['majority'] === 'yes' ? 'checked' : '' ?>> Oui</label>
                <label><input type="radio" name="majority" value="no" required <?= isset($tableau_donnee['majority']) && $tableau_donnee['majority'] === 'no' ? 'checked' : '' ?>> Non</label>
            </div>
            
            <div>
                <h4 class="cv">VOTRE MESSAGE AU RECRUTEUR</h4>
                <textarea id="message" name="message" required><?= isset($tableau_donnee['message']) ? echap($tableau_donnee['message']) : '' ?></textarea>
            </div>
            
            <div>
                <h6 class="cv">CV</h6>
                <label for="cv" class="custom-file-upload">Ajouter un CV</label>
                <input type="file" id="cv" name="cv" accept=".pdf, .doc, .docx, .jpg, .png" required>
                <p class="format">Format max : 2Mo</p>
                <p class="format">Formats acceptés : .pdf, .doc, .docx, .odt, .jpeg, .png</p>
            </div>
            
            <button type="submit" class="Postuler">POSTULER</button>
            <button type="reset" class="reset">RÉINITIALISER</button>
        </form>
    </div>

    <button id="scrollTopBtn" class="scroll-top-btn">SCROLL</button>
    <script src="http://cesi-static.local/script.js"></script>
    <script src="train.js"></script>
    <p>En cliquant sur "Postuler", vous acceptez les 
        <a href="cgu.html" target="_blank">CGU</a> et déclarez avoir pris connaissance de notre 
        <a href="politique-protection-donnees.html" target="_blank">politique de protection des données</a>.
    </p>
    
    <footer class="Foot">
        <p class="pieds">@2024 Tous droits sont réservés WEB4ALL</p>
    </footer>
</body>
</html>