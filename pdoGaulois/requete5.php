<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_bataille, date_bataille, nom_lieu
    FROM bataille b
    INNER JOIN lieu l ON l.id_lieu = b.id_lieu
    ORDER BY date_bataille DESC
");

?>

<a href="index.php">Retour</a>

<h2>Nom, date et lieu des batailles</h2>

<p>Il y a eu <?= $requete->rowCount() ?> batailles</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM BATAILLE</th>
            <th>DATE</th>
            <th>LIEU</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $bataille) { ?>
            <tr>
                <td><?= $bataille["nom_bataille"] ?></td>
                <td><?= $bataille["date_bataille"] ?></td>
                <td><?= $bataille["nom_lieu"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
