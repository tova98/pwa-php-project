<?php
    header('Content-Type: text/html; charset=utf-8');
    $servername = "localhost:8080";
    $username = "root";
    $password = "";
    $basename = "newsweek";
    $dbc = mysqli_connect($servername, $username, $password, $basename) or die('Error connecting to MySQL server.'.mysqli_error());
    mysqli_set_charset($dbc, "utf8");
    if ($dbc) {
        //echo "Connected successfully";
    }
?>