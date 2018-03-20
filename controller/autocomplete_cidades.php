<?php
session_start();
require_once '../models/config.php';
$term = $_POST["term"];
$db =  new DB();
$con = $db->DBconnect();
$query = "SELECT id_cidade, C.nome, E.uf FROM magiclink.Cidade C "
        . "INNER JOIN Estado E ON (C.id_estado = E.id_estado) WHERE C.nome like '%$term%' limit 5";
$nomes_cidades = mysqli_query($con, $query);
$dados = mysqli_fetch_all($nomes_cidades);
$json = json_encode($dados);

echo $json;

