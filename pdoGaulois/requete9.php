<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_personnage, SUM(dose_boire) AS qttBue
    FROM personnage p 
    INNER JOIN boire b ON p.id_personnage = b.id_personnage
    GROUP BY nom_personnage
    ORDER BY qttBue DESC
");

?>

<a href="index.php">Retour</a>

<h2>Nombre de gaulois par lieu</h2>

<p>Il y a <?= $requete->rowCount() ?> gaulois qui ont bu de la potion</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM DU GAULOIS</th>
            <th>QUANTITE BUE</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $boire) { ?>
            <tr>
                <td><?= $boire["nom_personnage"] ?></td>
                <td><?= $boire["qttBue"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
