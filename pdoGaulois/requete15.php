<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_personnage
    FROM personnage p
    WHERE id_personnage NOT IN (
        SELECT id_personnage
        FROM autoriser_boire ab
        INNER JOIN potion po ON ab.id_potion = po.id_potion
        WHERE nom_potion = 'Magique')
    ORDER BY nom_personnage
");

?>

<a href="index.php">Retour</a>

<h2>Gaulois n'ayant pas le droit de boire de la potion Magique</h2>

<p>Il y a <?= $requete->rowCount() ?> gaulois qui n'ont pas le droit de boire de la potion Magique</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM GAULOIS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $perso) { ?>
            <tr>
                <td><?= $perso["nom_personnage"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
