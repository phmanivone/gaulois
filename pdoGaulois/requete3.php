<?php 

require "dbconnect.php";
$pdo = connect();

// exécution de la requête
$requete = $pdo->query("
SELECT nom_personnage, nom_specialite, adresse_personnage, nom_lieu
FROM personnage p
INNER JOIN specialite s ON p.id_specialite = s.id_specialite
INNER JOIN lieu l ON l.id_lieu = p.id_lieu
ORDER BY nom_lieu, nom_personnage
");

?>

<a href="index.php">Retour</a>

<h2>Nom des gaulois + spécialité + adresse et lieu d'habitation</h2>

<!-- compter le nombre d'enregistrements de la requête -->
<p>Il y a <?= $requete->rowCount() ?> gaulois</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM PERSONNAGE</th>
            <th>SPECIALITE</th>
            <th>ADRESSE</th>
            <th>LIEU</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // parcourir la requête pour en afficher le contenu
        foreach ($requete as $gaulois) { ?>
            <tr>
                <td><?= $gaulois["nom_personnage"] ?></td>
                <td><?= $gaulois["nom_specialite"] ?></td>
                <td><?= $gaulois["adresse_personnage"] ?></td>
                <td><?= $gaulois["nom_lieu"] ?></td>
            </tr>
    <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
