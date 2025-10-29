<?php

declare(strict_types=1);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercice PHP POO : Déclaration de Classes</title>
</head>

<body>
    <?php
    class JeuVideo
    {
        public function __construct(
            public string $nom,
            public float $prix,
            public string $plateforme,
            public int $stock,
            public string $description,
            public string $ageMinimum,
            public string $editeur,
        ) {}

        public function afficher(): string
        {
            return "{$this->nom} - {$this->plateforme} - {$this->stock} - {$this->description}";
        }

        public function calculerPrix(float $remise = 0.1): float
        {
            return $this->prix * (1 - $remise);
        }
        public function afficherPrix(): string
        {
            return "Prix : " . number_format($this->calculerPrix(), 2, ',', ' ') . " €";
        }
        public function afficherStock(): string
        {
            if ($this->stock > 20) {
                return "Stock : Disponible";
            } else {
                return "Stock : Rupture de stock";
            }
        }
        public function afficherAgeMinimum(): string
        {
            if ($this->ageMinimum == "18+") {
                return "Age minimum : 18+";
            } else {
                return "Age minimum : 12+";
            }
        }
        public function afficherEditeur(): string
        {
            if ($this->editeur == "Activision") {
                return "Editeur : Activision";
            } else if ($this->editeur == "CD Projekt Red") {
                return "Editeur : CD Projekt Red";
            } else if ($this->editeur == "Kickstarter Games") {
                return "Editeur : Kickstarter Games";
            } else if ($this->editeur == "Sid Meier's") {
                return "Editeur : Sid Meier's";
            } else {
                return "Editeur : Inconnu";
            }
        }
        public function afficherDescription(): string
        {
            if ($this->description == "FPS") {
                return "Description : Un jeu de tir à la première personne.";
            } else if ($this->description == "RPG") {
                return "Description : Un jeu de rôle.";
            } else if ($this->description == "Point&Click") {
                return "Description : Un jeu de point & click.";
            } else if ($this->description == "Gestion") {
                return "Description : Un jeu de gestion.";
            } else {
                return "Description : Inconnu";
            }
        }
    }
    $jeu1 = new JeuVideo(
        "Call of Duty",
        59.99,
        "PS5",
        10,
        "FPS",
        "18+",
        "Activision"
    );
    echo $jeu1->afficher() . " <br> " . $jeu1->afficherPrix() . " <br> " . $jeu1->afficherStock() . " <br> " . $jeu1->afficherAgeMinimum() . " <br> " . $jeu1->afficherEditeur() . " <br> " . $jeu1->afficherDescription();
    echo "<br>";
    $jeu2 = new JeuVideo(
        "The Witcher 3",
        59.99,
        "PS5",
        10,
        "RPG",
        "18+",
        "CD Projekt Red"
    );
    echo $jeu2->afficher() . " <br> " . $jeu2->afficherPrix() . " <br> " . $jeu2->afficherStock() . " <br> " . $jeu2->afficherAgeMinimum() . " <br> " . $jeu2->afficherEditeur() . " <br> " . $jeu2->afficherDescription();
    echo "<br>";
    $jeu3 = new JeuVideo(
        "Gobliins 6",
        59.99,
        "PC",
        10,
        "Point&Click",
        "18+",
        "Kickstarter Games"
    );
    echo $jeu3->afficher() . " <br> " . $jeu3->afficherPrix() . " <br> " . $jeu3->afficherStock() . " <br> " . $jeu3->afficherAgeMinimum() . " <br> " . $jeu3->afficherEditeur() . " <br> " . $jeu3->afficherDescription();
    echo "<br>";
    $jeu4 = new JeuVideo(
        "Civilization 7",
        59.99,
        "PC",
        10,
        "Gestion",
        "12+",
        "Sid Meier's"
    );
    echo $jeu4->afficher() . " <br> " . $jeu4->afficherPrix() . " <br> " . $jeu4->afficherStock() . " <br> " . $jeu4->afficherAgeMinimum() . " <br> " . $jeu4->afficherEditeur() . " <br> " . $jeu4->afficherDescription();
    echo "<br>";
    $jeu5 = new JeuVideo(
        "Farming Simulator 25",
        59.99,
        "PC",
        10,
        "Gestion",
        "12+",
        "Giants Software"
    );
    echo $jeu5->afficher() . " <br> " . $jeu5->afficherPrix() . " <br> " . $jeu5->afficherStock() . " <br> " . $jeu5->afficherAgeMinimum() . " <br> " . $jeu5->afficherEditeur() . " <br> " . $jeu5->afficherDescription();
    echo "<br>";




    class Jeu
    {
        protected $nom;
        protected $prix;
        protected $plateforme;
        protected $stock;
        protected $genre;
        protected $ageMinimum;
        protected $editeur;
        protected $description;

        public function __construct($nom, $prix, $plateforme, $stock, $genre, $ageMinimum, $editeur, $description = "")
        {
            $this->nom = $nom;
            $this->prix = $prix;
            $this->plateforme = $plateforme;
            $this->stock = $stock;
            $this->genre = $genre;
            $this->ageMinimum = $ageMinimum;
            $this->editeur = $editeur;
            $this->description = $description;

            echo "🎮 Nouveau jeu ajouté au catalogue : {$nom} ({$plateforme})\n";
        }

        public function afficherInfos()
        {
            echo "🎮 Jeu : {$this->nom}<br>";
            echo "💰 Prix : {$this->prix}€<br>";
            echo "📦 Stock : {$this->stock} unités<br>";
            echo "🕹️ Plateforme : {$this->plateforme}<br>";
            echo "🎯 Genre : {$this->genre}<br>";
            echo "👶 Âge minimum : {$this->ageMinimum} ans<br>";
            echo "🏢 Éditeur : {$this->editeur}<br>";
            echo "📝 Description : {$this->description}<br>";
            echo "--------------------------------<br>";
        }

        /**
         * 🔍 MÉTHODE : Vérifier si en stock (comme Produit mais avec message spécialisé)
         */
        public function verifierStock()
        {
            if ($this->stock > 0) {
                echo "✅ Le jeu {$this->nom} est disponible sur {$this->plateforme} ({$this->stock} copies)\n";
                return true;
            } else {
                echo "❌ {$this->nom} est épuisé sur {$this->plateforme}\n";
                return false;
            }
        }

        /**
         * 🎲 MÉTHODE : Simuler "jouer" au jeu
         * 
         * Analogie : Comme mettre le jeu dans la console et l'allumer
         */
        public function jouer()
        {
            echo "🎮 Lancement de {$this->nom} sur {$this->plateforme}...\n";
            echo "🔥 Vous jouez à un {$this->genre} ! Amusez-vous bien !\n";
        }

        /**
         * 💿 MÉTHODE : Simuler l'installation
         * 
         * Analogie : Télécharger et installer le jeu
         */
        public function installerJeu()
        {
            $tailleGo = rand(15, 100); // Taille aléatoire entre 15 et 100 Go
            echo "💿 Installation de {$this->nom} en cours...<br>";
            echo "📊 Taille : {$tailleGo} Go<br>";
            echo "⏳ Installation terminée !<br>";
        }

        /**
         * 👶 MÉTHODE : Vérifier l'âge du joueur
         * 
         * Analogie : Vérifier la carte d'identité avant la vente
         */
        public function verifierAge($ageJoueur)
        {
            if ($ageJoueur >= $this->ageMinimum) {
                echo "✅ Âge vérifié ! {$ageJoueur} ans >= {$this->ageMinimum} ans requis<br>";
                echo "🎮 Vous pouvez acheter {$this->nom}<br>";
                return true;
            } else {
                echo "❌ Désolé, vous devez avoir au moins {$this->ageMinimum} ans pour acheter ce jeu<br>";
                echo "👶 Votre âge : {$ageJoueur} ans<br>";
                return false;
            }
        }

        /**
         * 🏷️ MÉTHODE : Prix avec remise selon la plateforme
         * 
         * Analogie : Promo spéciale selon la console
         */
        public function calculerPrix($remise = 0)
        {
            // Bonus : remise supplémentaire pour PC
            if ($this->plateforme === "PC" && $remise < 20) {
                $remise += 5; // +5% de remise sur PC
                echo "🖥️ Bonus PC : +5% de remise supplémentaire !<br>";
            }

            $prixFinal = $this->prix * (1 - $remise / 100);

            if ($remise > 0) {
                echo "🏷️ Prix original : {$this->prix}€<br>";
                echo "🎯 Remise totale : {$remise}%<br>";
                echo "💸 Prix final : {$prixFinal}€<br>";
            }

            return $prixFinal;
        }
    }

    // 🧪 EXEMPLE D'UTILISATION :

    $cod = new Jeu(
        "Call of Duty: Modern Warfare III",
        69.99,
        25,
        "PS5",
        "FPS/Action",
        18,
        "Activision",
        "Le dernier opus de la saga mythique"
    );

    // Utiliser les méthodes
    $cod->afficherInfos();
    $cod->verifierStock();
    $cod->verifierAge(20);  // Joueur de 20 ans
    $cod->installerJeu();
    $cod->jouer();
    $cod->calculerPrix(15); // 15% de remise

    ?>
</body>

</html>