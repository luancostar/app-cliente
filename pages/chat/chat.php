<?php
session_start();
include_once "../../conexao.php";
if (!isset($_SESSION['cliente_logado']) && !isset($_SESSION['adm_logado'])) {
  header("location: ../index.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="chat-area">
      <header>
        <?php
        if (isset($_SESSION['cliente_logado'])) {
          $sql = "SELECT id FROM usuarios WHERE acesso_app_cliente <> 0";
          $result = abrirBanco()->query($sql);
          while ($row = $result->fetch_assoc()) {
            $administradores[] = $row['id'];
          }
          $adm = array_rand($administradores);

          $user_id = mysqli_real_escape_string($conn, $administradores[$adm]);
          $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = {$user_id}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          } else {
            header("location: ../app.php");
          }
        } elseif (isset($_SESSION['adm_logado'])) {
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $sql = mysqli_query($conn, "SELECT * FROM cadastro_clientes WHERE unique_id = {$user_id}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          } else {
            header("location: users.php");
            exit();
          }
        }
        if (isset($_SESSION['cliente_logado'])) { ?>
          <a href="../app.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <?php } else { ?>
          <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <?php } ?>
        <div class="details">
          <span>
            <?php
            if (isset($_SESSION['cliente_logado'])) {
              echo "VB Express";
            } elseif (isset($_SESSION['adm_logado'])) {
              echo $row['fname'] . " " . $row['lname'];
            }
            ?>
          </span>
        </div>
      </header>
      <div class="chat-box">

      </div>
      <div class="input-form">
      <form action="#" class="typing-area">
        <input type="hidden" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>">
        <input type="text" name="message" class="input-field" placeholder="Escreva a mensagem aqui" autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
      </div>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>

</html>