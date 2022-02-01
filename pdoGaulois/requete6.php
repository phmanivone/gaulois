<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_potion, SUM(cout_ingredient*qte) AS coutPotion
    FROM potion p
    INNER JOIN composer c ON c.id_potion = p.id_potion
    INNER JOIN ingredient i ON i.id_ingredient = c.id_ingredient
    GROUP BY nom_potion
    ORDER BY coutPotion DESC 
");

?>

<a href="index.php">Retour</a>

<h2>Nom des potions + coût de réalisation</h2>

<p>Il y a <?= $requete->rowCount() ?> potions</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM POTION</th>
            <th>COUT</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $potion) { ?>
            <tr>
                <td><?= $potion["nom_potion"] ?></td>
                <td><?= $potion["coutPotion"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
