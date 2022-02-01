<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_personnage
    FROM personnage p
    LEFT JOIN boire b ON p.id_personnage = b.id_personnage
    WHERE b.id_personnage IS NULL
    GROUP BY nom_personnage
");

?>

<a href="index.php">Retour</a>

<h2>Gaulois n'ayant jamais bu de potion</h2>

<p>Il y a <?= $requete->rowCount() ?> gaulois qui n'ont jamais bu aucune potion</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM GAULOIS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $gaulois) { ?>
            <tr>
                <td><?= $gaulois["nom_personnage"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
