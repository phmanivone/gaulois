<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_lieu, COUNT(p.id_lieu) AS nbGaulois
    FROM lieu l
    INNER JOIN personnage p ON p.id_lieu = l.id_lieu
    GROUP BY nom_lieu
    ORDER BY nbGaulois DESC
");

?>

<a href="index.php">Retour</a>

<h2>Nombre de gaulois par lieu</h2>

<p>Il y a <?= $requete->rowCount() ?> lieux</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM LIEU</th>
            <th>NOMBRE GAULOIS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $lieu) { ?>
            <tr>
                <td><a href=""><?= $lieu["nom_lieu"] ?></a></td>
                <td><?= $lieu["nbGaulois"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
