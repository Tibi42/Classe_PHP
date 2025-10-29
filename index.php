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
            echo "✅ Connexion réussie ! Bienvenue {$this->nom}\n";
            return true;
        } else {
            echo "❌ Email ou mot de passe incorrect\n";
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
            echo "📝 Nom modifié : {$ancienNom} → {$nouveauNom}\n";
        }

        if ($nouvelAge !== null) {
            $ancienAge = $this->age;
            $this->age = $nouvelAge;
            echo "🎂 Âge modifié : {$ancienAge} → {$nouvelAge} ans\n";
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
            echo "🔐 Mot de passe modifié avec succès\n";
            return true;
        } else {
            echo "❌ Ancien mot de passe incorrect\n";
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
        echo "👤 Profil utilisateur :\n";
        echo "📛 Nom : {$this->nom}\n";
        echo "📧 Email : {$this->email}\n";
        echo "🎂 Âge : {$this->age} ans\n";
        echo "📅 Inscrit le : {$this->dateInscription}\n";
        // Notez qu'on N'AFFICHE PAS le mot de passe !
        echo "-------------------\n";
    }
}

class client extends Utilisateur {
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
        echo "👤 Profil client :\n";
        echo "📛 Nom : {$this->nom}\n";
        echo "📧 Email : {$this->email}\n";
        echo "🎂 Âge : {$this->age} ans\n";
        echo "📅 Inscrit le : {$this->getdateInscription()}\n";
        echo "📍 Adresse : {$this->adresse}\n";
        echo "💳 Carte de crédit : {$this->carteDeCredit}\n";
        echo "📜 Historique d'achats : {$this->historiqueAchats}\n";
        echo "-------------------\n";
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
        echo "📜 Historique d'achats : {$this->historiqueAchats}\n";
    }
    protected function payer()
    {
        echo "📱 Paiement en cours...\n";
        echo "💳 Carte de crédit : {$this->carteDeCredit}\n";
        echo "💰 Montant : {$this->montant}\n";
        echo "📅 Date : {$this->date}\n";
        echo "📝 Transaction : {$this->transaction}\n";
        echo "📜 Historique d'achats : {$this->historiqueAchats}\n";
        echo "-------------------\n";
    }
    protected function afficherMontant()
    {
        echo "💰 Montant : {$this->montant}\n";
    }
}

class administrateur extends Utilisateur {
    private string $role;
    public function __construct($nom, $email, $age, $motDePasse, $role)
    {
        parent::__construct($nom, $email, $age, $motDePasse);
        $this->role = $role;
    }
    public function afficherProfil()
    {
        echo "👤 Profil administrateur :\n";
        echo "📛 Nom : {$this->nom}\n";
        echo "📧 Email : {$this->email}\n";
        echo "🎂 Âge : {$this->age} ans\n";
        echo "📅 Inscrit le : {$this->getdateInscription()}\n";
        echo "📍 Role : {$this->role}\n";
        echo "-------------------\n";
    }
}
$administrateur = new administrateur("John Doe", "john.doe@example.com", 30, "motdepasse123", "admin");
$administrateur->afficherProfil();
$administrateur->seConnecter("john.doe@example.com", "motdepasse123");
$administrateur->modifierProfil("John Doe", 31);
$administrateur->changerMotDePasse("motdepasse123", "nouveaumotdepasse456");
$administrateur->afficherProfil();

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
echo "L'utilisateur s'appelle : " . $utilisateur->getNom() . "\n";
echo "Il a " . $utilisateur->getAge() . " ans\n";

// Changer le mot de passe
$utilisateur->changerMotDePasse("motdepasse123", "nouveaumotdepasse456");

// ATTENTION : Ceci ne marche PAS car $motDePasse est privé !
// echo $utilisateur->motDePasse; // ❌ ERREUR !




