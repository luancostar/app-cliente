<?php
session_start();
include_once "../../../conexao.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = "SELECT * FROM cadastro_clientes ORDER BY last_interaction DESC";
$query = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($query) == 0) {
    $output .= "Não há clientes por enquanto";
} elseif (mysqli_num_rows($query) > 0) {
    include_once "data.php";
}
echo $output;
