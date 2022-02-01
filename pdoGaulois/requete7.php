<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
SELECT nom_ingredient, cout_ingredient, qte
FROM composer c
INNER JOIN potion p ON p.id_potion = c.id_potion
INNER JOIN ingredient i ON i.id_ingredient = c.id_ingredient
WHERE nom_potion = 'Santé' 
");

?>

<a href="index.php">Retour</a>

<h2>Nom + coût + quantité de chaque ingrédient de la potion 'Santé'</h2>

<p>Il y a <?= $requete->rowCount() ?> ingrédients</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM INGREDIENT</th>
            <th>COUT</th>
            <th>QUANTITE</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $ingredient) { ?>
            <tr>
                <td><?= $ingredient["nom_ingredient"] ?></td>
                <td><?= $ingredient["cout_ingredient"] ?></td>
                <td><?= $ingredient["qte"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
