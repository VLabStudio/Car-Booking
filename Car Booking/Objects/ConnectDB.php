<?php
    $host = "localhost";
    $dbname = "carbooking";
    $user = "root";
    $pass = "";

    try
    {
        $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    } catch (PDOException $ex)
    {
        echo "Error: " . $ex;
    }
?>
