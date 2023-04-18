<?php
session_start();
if (isset($_SESSION['cliente_logado'])) {
    include_once "../../../conexao.php";
    $outgoing_id = $_SESSION['unique_id'];
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN cadastro_clientes ON cadastro_clientes.unique_id = messages.outgoing_msg_id
                WHERE incoming_msg_id = {$outgoing_id}
                OR outgoing_msg_id = {$outgoing_id} ORDER BY msg_id";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] != $incoming_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                                </div>';
            }
        }
    } else {
        $output .= '<div class="text">Nenhuma mensagem está disponível. Depois de enviar a mensagem, elas aparecerão aqui.</div>';
    }
    echo $output;
} else {
    header("location: ../../index.php");
}
