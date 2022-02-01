<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_type_casque, COUNT(id_casque) AS nbCasque, SUM(cout_casque) AS coutCasque
    FROM casque c
    INNER JOIN type_casque tc ON tc.id_type_casque = c.id_type_casque
    GROUP BY nom_type_casque
    ORDER BY coutCasque DESC 
");

?>

<a href="index.php">Retour</a>

<h2>Nom du type de casque + quantité + coût total</h2>

<p>Il y a <?= $requete->rowCount() ?> casques</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM TYPE CASQUE</th>
            <th>QUANTITE</th>
            <th>COUT</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $casque) { ?>
            <tr>
                <td><?= $casque["nom_type_casque"] ?></td>
                <td><?= $casque["nbCasque"] ?></td>
                <td><?= $casque["coutCasque"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
