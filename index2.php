<?php

declare(strict_types=1);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice PHP POO : Classe Utilisateur Complète</title>
</head>

<body>
    <section id="creation-utilisateur" style="margin-bottom:20px;">
        <h1>Créer un nouvel utilisateur</h1>
        <form method="post" style="display:grid; gap:8px; max-width:420px;">
            <label>Nom<br>
                <input name="nom" type="text" required>
            </label>
            <label>Âge<br>
                <input name="age" type="number" min="0" required>
            </label>
            <label>Email<br>
                <input name="email" type="email" required>
            </label>
            <label>Mot de passe<br>
                <input name="motDePasse" type="password" required>
            </label>
            <button type="submit">Créer l’utilisateur</button>
        </form>
        <div id="resultat-utilisateur"></div>
    </section>
    <?php
    class Utilisateur
    {
        public function __construct(
            public string $nom,
            public int $age,
            public string $email,
            private string $motDePasse,
        ) {
            $this->motDePasse = $this->hashPassword($motDePasse);
            $this->dateInscription = date('Y-m-d H:i:s');

            echo "Nouvel utilisateur inscrit : {$nom}\n";
        }

        private string $dateInscription;

        private function hashPassword($password)
        {
            return "HASH_" . strtoupper(md5($password));
        }

        public function seConnecter($email, $motDePasse)
        {
            $motDePasseHash = $this->hashPassword($motDePasse);

            if ($this->email === $email && $this->motDePasse === $motDePasseHash) {
                echo "Connexion réussie ! Bienvenue {$this->nom}\n";
                return true;
            } else {
                echo "Email ou mot de passe incorrect\n";
                return false;
            }
        }

        public function modifierProfil($nouveauNom = null, $nouvelAge = null)
        {
            if ($nouveauNom !== null) {
                $ancienNom = $this->nom;
                $this->nom = $nouveauNom;
                echo "Nom modifié : {$ancienNom} → {$nouveauNom}\n";
            }

            if ($nouvelAge !== null) {
                $ancienAge = $this->age;
                $this->age = $nouvelAge;
                echo "Âge modifié : {$ancienAge} → {$nouvelAge} ans\n";
            }
        }

        public function getAge()
        {
            return $this->age;
        }

        public function getNom()
        {
            return $this->nom;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getDateInscription()
        {
            return $this->dateInscription;
        }

        public function changerMotDePasse($ancienMotDePasse, $nouveauMotDePasse)
        {
            $ancienHash = $this->hashPassword($ancienMotDePasse);

            if ($this->motDePasse === $ancienHash) {
                $this->motDePasse = $this->hashPassword($nouveauMotDePasse);
                echo "🔐 Mot de passe modifié avec succès\n";
                return true;
            } else {
                echo "Ancien mot de passe incorrect\n";
                return false;
            }
        }

        public function afficherProfil()
        {
            echo "Profil utilisateur :\n";
            echo "Nom : {$this->nom}\n";
            echo "Email : {$this->email}\n";
            echo "Âge : {$this->age} ans\n";
            echo "Inscrit le : {$this->dateInscription}\n";
            echo "-------------------\n";
        }
    }

    // Initialisation du stockage des utilisateurs en session
    if (!isset($_SESSION['utilisateurs'])) {
        $_SESSION['utilisateurs'] = [];
    }

    // Réinitialisation optionnelle de la liste pour les tests
    if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && ($_POST['reset'] ?? '') === '1') {
        $_SESSION['utilisateurs'] = [];
    }

    $erreurs = [];
    $utilisateurCree = null;
    if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST') {
        $nom = trim($_POST['nom'] ?? '');
        $age = (int)($_POST['age'] ?? 0);
        $email = trim($_POST['email'] ?? '');
        $mdp = $_POST['motDePasse'] ?? '';

        if ($nom === '') {
            $erreurs[] = 'Nom requis';
        }
        if ($age <= 0) {
            $erreurs[] = 'Âge invalide';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = 'Email invalide';
        }
        if ($mdp === '') {
            $erreurs[] = 'Mot de passe requis';
        }

        if (!$erreurs && (($_POST['reset'] ?? '') !== '1')) {
            $utilisateurCree = new Utilisateur($nom, $age, $email, $mdp);
            // Enregistrement d'une version sérialisable en session (sans mot de passe)
            $_SESSION['utilisateurs'][] = [
                'nom' => $utilisateurCree->getNom(),
                'age' => $utilisateurCree->getAge(),
                'email' => $utilisateurCree->getEmail(),
                'dateInscription' => $utilisateurCree->getDateInscription(),
            ];
        }
    }

    if (!empty($erreurs)) {
        echo '<section style="max-width:600px; margin:10px 0; padding:10px; border:1px solid #e00; background:#fee;">';
        echo '<h2>Erreurs de validation</h2><ul>';
        foreach ($erreurs as $err) {
            echo '<li>' . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '</li>';
        }
        echo '</ul></section>';
    } elseif ($utilisateurCree) {
        echo '<section id="profil" style="max-width:600px; margin:10px 0; padding:10px; border:1px solid #0a0; background:#efe;">';
        echo '<h2>Utilisateur créé</h2><pre>';
        $utilisateurCree->afficherProfil();
        echo '</pre></section>';
    }

    // Affichage de la liste des utilisateurs enregistrés
    if (!empty($_SESSION['utilisateurs'])) {
        echo '<section style="max-width:800px; margin:20px 0; padding:10px; border:1px solid #ccc;">';
        echo '<h2>Utilisateurs enregistrés (' . count($_SESSION['utilisateurs']) . ')</h2>';
        echo '<table border="1" cellpadding="6" cellspacing="0" style="border-collapse:collapse; width:100%">';
        echo '<tr><th>Nom</th><th>Âge</th><th>Email</th><th>Inscription</th></tr>';
        foreach ($_SESSION['utilisateurs'] as $u) {
            echo '<tr>'
                . '<td>' . htmlspecialchars($u['nom'], ENT_QUOTES, 'UTF-8') . '</td>'
                . '<td>' . (int)$u['age'] . '</td>'
                . '<td>' . htmlspecialchars($u['email'], ENT_QUOTES, 'UTF-8') . '</td>'
                . '<td>' . htmlspecialchars($u['dateInscription'], ENT_QUOTES, 'UTF-8') . '</td>'
                . '</tr>';
        }
        echo '</table>';
        echo '<form method="post" style="margin-top:10px">'
            . '<input type="hidden" name="reset" value="1">'
            . '<button type="submit">Vider la liste</button>'
            . '</form>';
        echo '</section>';
    }

    ?>
</body>

</html>