<?php 
    $dsn="mysql:host=localhost;dbname=login";
    $user ="root";
    $password="";
    $options=[];
    try {
        $connection = new PDO($dsn,$user,$password,$options);
        // echo "connection successfull";
    }
    catch (PDOException){
        echo "connection unsuccessfull";
    }
    session_start();
?>