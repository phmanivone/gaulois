<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_bataille, SUM(qte) AS nbCasqueMax
    FROM bataille b 
    INNER JOIN prendre_casque pc ON b.id_bataille = pc.id_bataille
    GROUP BY nom_bataille
    HAVING nbCasqueMax >= ALL(
        SELECT SUM(qte) 
        FROM bataille b
        INNER JOIN prendre_casque pc ON b.id_bataille = pc.id_bataille
        GROUP BY nom_bataille)
");

?>

<a href="index.php">Retour</a>

<h2>Bataille où le nombre de casques pris a été le plus important</h2>

<table border=1>
    <thead>
        <tr>
            <th>NOM BATAILLE</th>
            <th>NOMBRE CASQUES</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $casque) { ?>
            <tr>
                <td><?= $casque["nom_bataille"] ?></td>
                <td><?= $casque["nbCasqueMax"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
