<?php
session_start();
if (isset($_SESSION['cliente_logado']) || isset($_SESSION['adm_logado'])) {
    include_once "../../../conexao.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    if (!empty($message)) {
        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, date_time)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', NOW())") or die();
        $sql_interaction = mysqli_query($conn, "UPDATE cadastro_clientes SET last_interaction=NOW() WHERE unique_id={$outgoing_id}");
    }
} else {
    header("location: ../../index.php");
}
