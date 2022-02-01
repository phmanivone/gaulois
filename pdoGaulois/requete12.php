<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
SELECT nom_potion
FROM potion p 
INNER JOIN composer c ON c.id_potion = p.id_potion
INNER JOIN ingredient i ON i.id_ingredient = c.id_ingredient
WHERE nom_ingredient = 'Poisson frais'
GROUP BY nom_potion
");

?>

<a href="index.php">Retour</a>

<h2>Potions dont l'un des ingrédients est le poisson frais</h2>

<p>Il y a <?= $requete->rowCount() ?> potions qui utilisent le poisson frais</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM POTION</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $boire) { ?>
            <tr>
                <td><?= $boire["nom_potion"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
