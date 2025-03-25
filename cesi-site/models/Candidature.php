<?php
class Candidature {
    private $donnees = [];
    private $erreurs = [];
    private $formulaire_soumis = false;
    private $uploadDir = 'uploads/';

    public function __construct() {
        $this->initialiserDonnees();
    }

    private function initialiserDonnees() {
        $this->donnees = [
            'civilite' => '',
            'nom' => '',
            'prenom' => '',
            'email' => '',
            'permits' => 'Non',
            'vehicle' => 'Non',
            'certifications' => 'Non',
            'majority' => '',
            'message' => '',
            'cv' => ''
        ];
    }

    public function traiterFormulaire($post, $files) {
        $this->formulaire_soumis = true;
        
        // Récupérer les données du formulaire
        $this->donnees = [
            'civilite' => isset($post['civilite']) ? $post['civilite'] : '',
            'nom' => isset($post['nom']) ? $post['nom'] : '',
            'prenom' => isset($post['prenom']) ? $post['prenom'] : '',
            'email' => isset($post['email']) ? $post['email'] : '',
            'permits' => isset($post['permits']) ? 'Oui' : 'Non',
            'vehicle' => isset($post['vehicle']) ? 'Oui' : 'Non',
            'certifications' => isset($post['certifications']) ? 'Oui' : 'Non',
            'majority' => isset($post['majority']) ? $post['majority'] : '',
            'message' => isset($post['message']) ? $post['message'] : ''
        ];
        
        // Valider l'email
        if (!filter_var($this->donnees['email'], FILTER_VALIDATE_EMAIL)) {
            $this->erreurs[] = "L'adresse email n'est pas valide.";
        }

        // Traiter le CV
        if (isset($files['cv']) && $files['cv']['error'] == 0) {
            $this->traiterCV($files['cv']);
        } else {
            $this->erreurs[] = "Veuillez sélectionner un fichier pour le CV.";
        }
        
        return [
            'succes' => empty($this->erreurs),
            'donnees' => $this->donnees,
            'erreurs' => $this->erreurs,
            'formulaire_soumis' => $this->formulaire_soumis
        ];
    }

    private function traiterCV($fichier) {
        $taille_MAX = 2 * 1024 * 1024;
        $ext_acceptee = ['pdf', 'doc', 'docx', 'odt', 'jpeg', 'jpg', 'png'];

        if ($fichier['size'] > $taille_MAX) {
            $this->erreurs[] = "Le fichier est trop volumineux (max 2 Mo).";
            return;
        }

        $fileExtension = pathinfo($fichier['name'], PATHINFO_EXTENSION);
        if (!in_array(strtolower($fileExtension), $ext_acceptee)) {
            $this->erreurs[] = "Le format du fichier n'est pas autorisé. Formats acceptés : .pdf, .doc, .docx, .odt, .jpeg, .jpg, .png.";
            return;
        }

        if (empty($this->erreurs)) {
            if (!is_dir($this->uploadDir)) {
                mkdir($this->uploadDir, 0777, true);
            }
            $nom_fichier = uniqid('cv_') . '.' . $fileExtension;
            $chemin_fichier = $this->uploadDir . $nom_fichier;
            $this->donnees['cv'] = $nom_fichier;

            if (!move_uploaded_file($fichier['tmp_name'], $chemin_fichier)) {
                $this->erreurs[] = "Une erreur est survenue lors de l'upload du fichier.";
            }
        }
    }

    public function echap($data) {
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    public function getDonnees() {
        return $this->donnees;
    }
    
    public function getErreurs() {
        return $this->erreurs;
    }
    
    public function isFormulaireSubmit() {
        return $this->formulaire_soumis;
    }
}