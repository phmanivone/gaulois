<?php 

require "dbconnect.php";
$pdo = connect();

$requete = $pdo->query("
    SELECT nom_lieu, COUNT(id_personnage) AS nbPerso
    FROM lieu l
    INNER JOIN personnage p ON p.id_lieu = l.id_lieu
    WHERE nom_lieu != 'Village gaulois'
    GROUP BY nom_lieu
    HAVING nbPerso >= ALL(
        SELECT COUNT(id_personnage)
        FROM lieu l
        INNER JOIN personnage p ON p.id_lieu = l.id_lieu
        WHERE nom_lieu != 'Village gaulois'
        GROUP BY nom_lieu)
");

?>

<a href="index.php">Retour</a>

<h2>Lieu qui a le plus d'habitants en dehors du Village gaulois</h2>

<table border=1>
    <thead>
        <tr>
            <th>NOM LIEU</th>
            <th>NOMBRE HABITANTS</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete as $nombre) { ?>
            <tr>
                <td><?= $nombre["nom_lieu"] ?></td>
                <td><?= $nombre["nbPerso"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php 
    $requete = null;
?>
