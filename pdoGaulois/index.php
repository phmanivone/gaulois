<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO Gaulois</title>
</head>
<body>

    <h1>SQL Gaulois</h1>

    <?php 

    foreach(range(1,15) as $numero) { ?>
        <a href="requete<?= $numero ?>.php">Requête <?= $numero ?></a><br>
    
    <?php } ?>

</body>
</html>