<?php

declare(strict_types=1);

class Utilisateur
{
    public string $nom;
    public string $email;
    public string $naissance;
    public string $motDePasse;
    public string $login;

    public function __construct() {}
}

$utilisateur = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nom'])) {
    $utilisateur = new Utilisateur();
    $utilisateur->nom = $_POST['nom'] ?? '';
    $utilisateur->email = $_POST['email'] ?? '';
    $utilisateur->naissance = $_POST['naissance'] ?? '';
    $utilisateur->motDePasse = $_POST['motDePasse'] ?? '';
    $utilisateur->login = $_POST['login'] ?? '';
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateur</title>
</head>

<body>
    <form action="index.php" method="post">
        <div><label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div><label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>
        <div><label for="naissance">Date de naissance</label>
            <input type="date" name="naissance" id="naissance">
        </div>
        <div><label for="motDePasse">Mot de passe</label>
            <input type="password" name="motDePasse" id="motDePasse">
        </div>
        <div><label for="login">Login</label>
            <input type="text" name="login" id="login">
        </div>
        <button type="submit">Créer</button>
    </form>
    <?php if ($utilisateur !== null): ?>
        <table>
            <tr>
                <td>Nom</td>
                <td><?php echo htmlspecialchars($utilisateur->nom); ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo htmlspecialchars($utilisateur->email); ?></td>
            </tr>
            <tr>
                <td>Date de naissance</td>
                <td><?php echo htmlspecialchars($utilisateur->naissance); ?></td>
            </tr>
            <tr>
                <td>Mot de passe</td>
                <td><?php echo htmlspecialchars($utilisateur->motDePasse); ?></td>
            </tr>
            <tr>
                <td>Login</td>
                <td><?php echo htmlspecialchars($utilisateur->login); ?></td>
            </tr>
        </table>
    <?php endif; ?>
</body>

</html>