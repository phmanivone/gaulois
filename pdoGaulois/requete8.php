<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_personnage, SUM(qte) AS nbCasqueMax
    FROM prendre_casque pc
    INNER JOIN personnage p ON p.id_personnage = pc.id_personnage
    INNER JOIN bataille b ON b.id_bataille = pc.id_bataille
    WHERE nom_bataille = 'Bataille du village gaulois'
    GROUP BY nom_personnage
    HAVING nbCasqueMax >= ALL(
        SELECT SUM(qte) 
        FROM prendre_casque pc
        INNER JOIN personnage p ON p.id_personnage = pc.id_personnage
        INNER JOIN bataille b ON b.id_bataille = pc.id_bataille
        WHERE nom_bataille = 'Bataille du village gaulois'
        GROUP BY nom_personnage)
");

?>

<a href="index.php">Retour</a>

<h2>Gaulois qui a pris le plus de casques lors de la 'Bataille du village 
gaulois'</h2>

<p>Il y a <?= $requete->rowCount() ?> personnage</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM DU GAULOIS</th>
            <th>NOMBRE DE CASQUES</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $casque) { ?>
            <tr>
                <td><?= $casque["nom_personnage"] ?></td>
                <td><?= $casque["nbCasqueMax"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
