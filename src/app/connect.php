<?php

$localhost = "localhost";
$user = "root";
$password = "";
$bd = "cieegame";


$connect = mysqli_connect($localhost, $user, $password, $bd);

if($connect -> error){
    die("Falha ao conectar com o banco de dados". $connect->error);
}

?>