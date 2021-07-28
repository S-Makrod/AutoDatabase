<?php
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=autosdb', 'fred', 'zap');
    // $pdo = new PDO('mysql:host=localhost;port=3306;dbname=autosdb', 'Saad', 'saad123'); ALTERNATE
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>