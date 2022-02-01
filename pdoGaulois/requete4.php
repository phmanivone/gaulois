<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_specialite, COUNT(id_personnage) AS nbGaulois
    FROM specialite s
    INNER JOIN personnage p ON p.id_specialite = s.id_specialite
    GROUP BY nom_specialite
    ORDER BY nbGaulois DESC
");

?>

<a href="index.php">Retour</a>

<h2>Nombre de gaulois par spécialité</h2>

<p>Il y a <?= $requete->rowCount() ?> spécialités</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM SPECIALITE</th>
            <th>NOMBRE GAULOIS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $specialite) { ?>
            <tr>
                <td><?= $specialite["nom_specialite"] ?></td>
                <td><?= $specialite["nbGaulois"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
