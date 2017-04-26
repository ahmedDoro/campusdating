<?php
    $dsn = 'mysql:host=br-cdbr-azure-south-b.cloudapp.net;dbname=campusdate';
    $username = 'b5878316b539fe';
    $password = '8e5d969e';

    try {
        $con = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/err.php');
        exit();
    }
?>
