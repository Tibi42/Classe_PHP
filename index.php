<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs - Classes PHP</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #667eea;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .output {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            white-space: pre-wrap;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            line-height: 1.6;
            overflow-x: auto;
        }

        .output-success {
            color: #28a745;
        }

        .output-error {
            color: #dc3545;
        }

        .output-info {
            color: #17a2b8;
        }

        .output-warning {
            color: #ffc107;
        }

        .separator {
            border-top: 2px dashed #dee2e6;
            margin: 15px 0;
        }

        .section {
            margin: 30px 0;
        }

        .section-title {
            font-size: 1.5em;
            color: #764ba2;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🎮 Système de Gestion d'Utilisateurs</h1>
        <div class="output">
            <?php
            class Utilisateur
            {
                protected string $nom;
                protected string $email;
                protected int $age;
                private string $hashMotDePasse;
                private string $dateInscription;
                public function __construct($nom, $email, $age, $motDePasse)
                {
                    $this->nom = $nom;
                    $this->email = $email;
                    $this->age = $age;
                    $this->hashMotDePasse = $this->hashPassword($motDePasse);
                    $this->dateInscription = date('Y-m-d H:i:s');
                }

                public function hashPassword($password)
                {
                    return "HASH_" . strtoupper(md5($password));
                }


                /**
                 * 🔑 MÉTHODE : Se connecter
                 * 
                 * Analogie : Montrer sa carte d'identité et son mot de passe
                 */
                public function seConnecter($email, $motDePasse)
                {
                    $motDePasseHash = $this->hashPassword($motDePasse);

                    if ($this->email === $email && $this->hashMotDePasse === $motDePasseHash) {
                        echo nl2br("✅ Connexion réussie ! Bienvenue " . htmlspecialchars($this->nom) . "\n");
                        return true;
                    } else {
                        echo nl2br("❌ Email ou mot de passe incorrect\n");
                        return false;
                    }
                }

                /**
                 * ✏️ MÉTHODE : Modifier le profil
                 * 
                 * Analogie : Mettre à jour ses informations personnelles
                 */
                public function modifierProfil($nouveauNom = null, $nouvelAge = null)
                {
                    if ($nouveauNom !== null) {
                        $ancienNom = $this->nom;
                        $this->nom = $nouveauNom;
                        echo nl2br("📝 Nom modifié : " . htmlspecialchars($ancienNom) . " → " . htmlspecialchars($nouveauNom) . "\n");
                    }

                    if ($nouvelAge !== null) {
                        $ancienAge = $this->age;
                        $this->age = $nouvelAge;
                        echo nl2br("🎂 Âge modifié : {$ancienAge} → {$nouvelAge} ans\n");
                    }
                }

                /**
                 * 🔓 GETTER : Récupérer l'âge (méthode publique pour accéder à une info)
                 * 
                 * Analogie : Comme demander poliment "Quel âge avez-vous ?"
                 * au lieu de fouiller dans les affaires personnelles
                 */
                public function getAge()
                {
                    return $this->age;
                }

                /**
                 * 🔓 GETTER : Récupérer le nom
                 */
                public function getNom()
                {
                    return $this->nom;
                }

                /**
                 * 🔓 GETTER : Récupérer l'email
                 */
                public function getEmail()
                {
                    return $this->email;
                }

                /**
                 * 🔒 GETTER : Récupérer la date d'inscription (info privée accessible)
                 * 
                 * Analogie : L'utilisateur peut consulter sa propre date d'inscription
                 */
                public function getDateInscription()
                {
                    return $this->dateInscription;
                }

                /**
                 * 🔐 SETTER : Changer le mot de passe (avec vérification)
                 * 
                 * Analogie : Changer la combinaison de son coffre-fort
                 */
                public function changerMotDePasse($ancienMotDePasse, $nouveauMotDePasse)
                {
                    $ancienHash = $this->hashPassword($ancienMotDePasse);

                    if ($this->hashMotDePasse === $ancienHash) {
                        $this->hashMotDePasse = $this->hashPassword($nouveauMotDePasse);
                        echo nl2br("🔐 Mot de passe modifié avec succès\n");
                        return true;
                    } else {
                        echo nl2br("❌ Ancien mot de passe incorrect\n");
                        return false;
                    }
                }

                /**
                 * 📋 MÉTHODE : Afficher les infos publiques de l'utilisateur
                 * 
                 * Analogie : Montrer sa carte de visite (pas ses secrets !)
                 */
                public function afficherProfil()
                {
                    echo nl2br("👤 Profil utilisateur :\n");
                    echo nl2br("📛 Nom : " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("📧 Email : " . htmlspecialchars($this->email) . "\n");
                    echo nl2br("🎂 Âge : {$this->age} ans\n");
                    echo nl2br("📅 Inscrit le : " . htmlspecialchars($this->dateInscription) . "\n");
                    // Notez qu'on N'AFFICHE PAS le mot de passe !
                    echo nl2br("-------------------\n");
                }
            }

            class client extends Utilisateur
            {
                private string $adresse;
                private string $carteDeCredit;
                private string $historiqueAchats;
                private float $montant;
                private string $date;
                private string $transaction;
                public function __construct($nom, $email, $age, $motDePasse, $adresse, $carteDeCredit, $historiqueAchats = "", $montant = 0, $date = "", $transaction = "")
                {
                    parent::__construct($nom, $email, $age, $motDePasse);
                    $this->adresse = $adresse;
                    $this->carteDeCredit = $carteDeCredit;
                    $this->historiqueAchats = $historiqueAchats;
                    $this->montant = $montant;
                    $this->date = $date;
                    $this->transaction = $transaction;
                }
                public function afficherProfil()
                {
                    echo nl2br("👤 Profil client :\n");
                    echo nl2br("📛 Nom : " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("📧 Email : " . htmlspecialchars($this->email) . "\n");
                    echo nl2br("🎂 Âge : {$this->age} ans\n");
                    echo nl2br("📅 Inscrit le : " . htmlspecialchars($this->getDateInscription()) . "\n");
                    echo nl2br("📍 Adresse : " . htmlspecialchars($this->adresse) . "\n");
                    echo nl2br("💳 Carte de crédit : " . htmlspecialchars($this->carteDeCredit) . "\n");
                    echo nl2br("📜 Historique d'achats : " . htmlspecialchars($this->historiqueAchats) . "\n");
                    echo nl2br("-------------------\n");
                }
                protected function ajouterAuPanier($produit)
                {
                    $this->historiqueAchats .= $produit . "\n";
                }
                protected function supprimerDuPanier($produit)
                {
                    $this->historiqueAchats = str_replace($produit . "\n", "", $this->historiqueAchats);
                }
                protected function viderLePanier()
                {
                    $this->historiqueAchats = "";
                }
                protected function afficherHistoriqueAchats()
                {
                    echo nl2br("📜 Historique d'achats : " . htmlspecialchars($this->historiqueAchats) . "\n");
                }
                protected function payer()
                {
                    echo nl2br("📱 Paiement en cours...\n");
                    echo nl2br("💳 Carte de crédit : " . htmlspecialchars($this->carteDeCredit) . "\n");
                    echo nl2br("💰 Montant : {$this->montant}\n");
                    echo nl2br("📅 Date : " . htmlspecialchars($this->date) . "\n");
                    echo nl2br("📝 Transaction : " . htmlspecialchars($this->transaction) . "\n");
                    echo nl2br("📜 Historique d'achats : " . htmlspecialchars($this->historiqueAchats) . "\n");
                    echo nl2br("-------------------\n");
                }
                protected function afficherMontant()
                {
                    echo nl2br("💰 Montant : {$this->montant}\n");
                }
            }

            // Instanciation supprimée - utiliser la classe Administrateur complète ci-dessous

            $client = new client("John Doe", "john.doe@example.com", 30, "motdepasse123", "123 Rue de la Paix, Paris, France", "1234567890", "Historique d'achats");
            $client->afficherProfil();
            $client->seConnecter("john.doe@example.com", "motdepasse123");
            $client->modifierProfil("John Doe", 31);
            $client->changerMotDePasse("motdepasse123", "nouveaumotdepasse456");
            $client->afficherProfil();

            // 🧪 EXEMPLE D'UTILISATION :

            // Créer un utilisateur
            $utilisateur = new Utilisateur("Alice Gamer", "alice@email.com", 25, "motdepasse123");

            // Utiliser les méthodes publiques
            $utilisateur->afficherProfil();
            $utilisateur->seConnecter("alice@email.com", "motdepasse123");
            $utilisateur->modifierProfil("Alice Pro-Gamer", 26);



            // Utiliser les getters
            echo nl2br("L'utilisateur s'appelle : " . htmlspecialchars($utilisateur->getNom()) . "\n");
            echo nl2br("Il a " . $utilisateur->getAge() . " ans\n");

            // Changer le mot de passe
            $utilisateur->changerMotDePasse("motdepasse123", "nouveaumotdepasse456");

            // ATTENTION : Ceci ne marche PAS car $motDePasse est privé !
            // echo $utilisateur->motDePasse; // ❌ ERREUR !




            class Administrateur extends Utilisateur
            {
                private string $niveau;
                private int $codeAcces;
                private array $permissions = [];

                public function __construct($nom, $email, $age, $motDePasse, $niveau, $codeAcces = null)
                {
                    parent::__construct($nom, $email, $age, $motDePasse);
                    $this->niveau = $niveau;
                    $this->codeAcces = $codeAcces ?? rand(1000, 9999); // Code aléatoire si non fourni

                    // Définir les permissions selon le niveau
                    $this->definirPermissions();

                    echo nl2br("👑 Administrateur " . htmlspecialchars($niveau) . " créé avec code d'accès : {$this->codeAcces}\n");
                }

                /**
                 * 🔐 MÉTHODE PRIVÉE : Définir les permissions selon le niveau
                 * 
                 * Analogie : Donner les clés appropriées selon le poste
                 */
                private function definirPermissions()
                {
                    switch ($this->niveau) {
                        case 'junior':
                            $this->permissions = ['voir_stocks', 'modifier_produits'];
                            break;
                        case 'senior':
                            $this->permissions = ['voir_stocks', 'modifier_produits', 'ajouter_produits', 'voir_rapports'];
                            break;
                        case 'super':
                            $this->permissions = ['voir_stocks', 'modifier_produits', 'ajouter_produits', 'voir_rapports', 'supprimer_utilisateurs', 'modifier_prix'];
                            break;
                        default:
                            $this->permissions = ['voir_stocks'];
                    }
                }

                /**
                 * 🔍 MÉTHODE : Vérifier si l'admin a une permission
                 * 
                 * Analogie : Vérifier si on a la bonne clé pour ouvrir une porte
                 */
                private function aPermission($action)
                {
                    if (in_array($action, $this->permissions)) {
                        return true;
                    } else {
                        echo nl2br("❌ Permission refusée pour '" . htmlspecialchars($action) . "'. Niveau requis supérieur.\n");
                        return false;
                    }
                }

                /**
                 * ➕ MÉTHODE : Ajouter un produit au catalogue
                 * 
                 * Analogie : Recevoir une nouvelle marchandise et la mettre en rayon
                 */
                public function ajouterProduit($produit)
                {
                    if (!$this->aPermission('ajouter_produits')) {
                        return false;
                    }

                    echo nl2br("📦 Ajout du produit au catalogue par " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("✅ " . htmlspecialchars($produit->nom) . " ajouté avec succès\n");
                    echo nl2br("💰 Prix : {$produit->prix}€\n");
                    echo nl2br("📊 Stock initial : {$produit->stock} unités\n");

                    return true;
                }

                /**
                 * 🗑️ MÉTHODE : Supprimer un utilisateur (action sensible)
                 * 
                 * Analogie : Résilier un compte client (nécessite confirmation)
                 */
                public function supprimerUtilisateur($utilisateur, $codeConfirmation)
                {
                    if (!$this->aPermission('supprimer_utilisateurs')) {
                        return false;
                    }

                    // Vérification du code de sécurité
                    if ($codeConfirmation != $this->codeAcces) {
                        echo nl2br("🔐 Code d'accès incorrect. Suppression annulée pour des raisons de sécurité.\n");
                        return false;
                    }

                    echo nl2br("⚠️ SUPPRESSION D'UTILISATEUR par " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("👤 Utilisateur concerné : " . htmlspecialchars($utilisateur->getNom()) . "\n");
                    echo nl2br("📧 Email : " . htmlspecialchars($utilisateur->getEmail()) . "\n");
                    echo nl2br("✅ Compte supprimé avec succès\n");

                    return true;
                }

                /**
                 * 📊 MÉTHODE : Modifier le stock d'un produit
                 * 
                 * Analogie : Faire l'inventaire et ajuster les quantités
                 */
                public function modifierStock($produit, $nouvelleQuantite, $raison = "Ajustement inventaire")
                {
                    if (!$this->aPermission('modifier_produits')) {
                        return false;
                    }

                    $ancienStock = $produit->stock;
                    $produit->stock = $nouvelleQuantite;

                    echo nl2br("📊 Modification de stock par " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("📦 Produit : " . htmlspecialchars($produit->nom) . "\n");
                    echo nl2br("📈 Ancien stock : {$ancienStock}\n");
                    echo nl2br("📉 Nouveau stock : {$nouvelleQuantite}\n");
                    echo nl2br("📝 Raison : " . htmlspecialchars($raison) . "\n");

                    return true;
                }

                /**
                 * 📈 MÉTHODE : Générer un rapport de ventes
                 * 
                 * Analogie : Faire le bilan mensuel du magasin
                 */
                public function genererRapport($periode = "mensuel")
                {
                    if (!$this->aPermission('voir_rapports')) {
                        return false;
                    }

                    echo nl2br("📊 RAPPORT " . htmlspecialchars($periode) . " généré par " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("📅 Date : " . date('Y-m-d H:i:s') . "\n");
                    echo nl2br("-------------------\n");

                    // Simulation de données
                    $ventesSimulees = rand(50, 200);
                    $chiffreAffaires = rand(5000, 20000);
                    $produitsPopulaires = ["FIFA 24", "Call of Duty", "Zelda BOTW"];

                    echo nl2br("🛍️ Ventes : {$ventesSimulees} produits vendus\n");
                    echo nl2br("💰 Chiffre d'affaires : {$chiffreAffaires}€\n");
                    echo nl2br("🏆 Top produits : " . htmlspecialchars(implode(", ", $produitsPopulaires)) . "\n");
                    echo nl2br("📊 Tendance : " . (rand(0, 1) ? "📈 En hausse" : "📉 En baisse") . "\n");

                    return true;
                }

                /**
                 * 💰 MÉTHODE : Modifier le prix d'un produit (super-admin uniquement)
                 * 
                 * Analogie : Changer les étiquettes prix (action très sensible)
                 */
                public function modifierPrix($produit, $nouveauPrix, $codeConfirmation)
                {
                    if (!$this->aPermission('modifier_prix')) {
                        return false;
                    }

                    // Double vérification pour action sensible
                    if ($codeConfirmation != $this->codeAcces) {
                        echo nl2br("🔐 Code d'accès incorrect. Modification de prix refusée.\n");
                        return false;
                    }

                    $ancienPrix = $produit->prix;
                    $produit->prix = $nouveauPrix;

                    echo nl2br("💰 MODIFICATION DE PRIX par " . htmlspecialchars($this->nom) . "\n");
                    echo nl2br("📦 Produit : " . htmlspecialchars($produit->nom) . "\n");
                    echo nl2br("💸 Ancien prix : {$ancienPrix}€\n");
                    echo nl2br("💵 Nouveau prix : {$nouveauPrix}€\n");
                    echo nl2br("📊 Variation : " . ($nouveauPrix > $ancienPrix ? "📈 Hausse" : "📉 Baisse") . "\n");

                    return true;
                }

                /**
                 * 📋 MÉTHODE : Afficher le profil admin (OVERRIDE)
                 * 
                 * Analogie : Montrer son badge d'employé avec ses autorisations
                 */
                public function afficherProfil()
                {
                    // 🔗 Appeler la méthode du parent
                    parent::afficherProfil();

                    // ➕ Ajouter les infos admin
                    echo nl2br("👑 Niveau : Administrateur " . htmlspecialchars($this->niveau) . "\n");
                    echo nl2br("🔐 Code d'accès : {$this->codeAcces}\n");
                    echo nl2br("🗝️ Permissions : " . htmlspecialchars(implode(", ", $this->permissions)) . "\n");
                    echo nl2br("-------------------\n");
                }
            }

            // 🧪 EXEMPLE D'UTILISATION :
            /*
// Créer différents niveaux d'admin
$adminJunior = new Administrateur("Alice Admin", "alice.admin@magasin.com", 28, "admin123", "junior");
$superAdmin = new Administrateur("Bob Boss", "bob.boss@magasin.com", 35, "boss456", "super", 9999);

// Actions selon les permissions
$jeu = new JeuVideo("Nouveau Jeu", 49.99, 0, "PC", "Action", 16, "Studio");

// Admin junior : peut modifier stock mais pas ajouter de produit
$adminJunior->modifierStock($jeu, 25, "Réassort");
$adminJunior->ajouterProduit($jeu); // ❌ Permission refusée

// Super admin : peut tout faire
$superAdmin->ajouterProduit($jeu);
$superAdmin->modifierPrix($jeu, 39.99, 9999); // Avec code correct
$superAdmin->genererRapport("hebdomadaire");

// Afficher les profils
$adminJunior->afficherProfil();
$superAdmin->afficherProfil();
*/
            ?>
        </div>
    </div>
</body>

</html>