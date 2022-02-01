<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_lieu
    FROM lieu
    WHERE nom_lieu LIKE '%um'
    ORDER BY nom_lieu
");

?>

<a href="index.php">Retour</a>

<h2>Noms des lieux finissant par 'um'</h2>

<p>Il y a <?= $requete->rowCount() ?> lieux qui finissent par 'um'</p>

<table border=1>
    <thead>
        <tr>
            <th>NOM LIEU</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $lieu) { ?>
            <tr>
                <td><?= $lieu["nom_lieu"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
