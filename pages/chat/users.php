<?php
session_start();
include_once "../../conexao.php";
if (!isset($_SESSION['adm_logado'])) {
  header("location: ../app.php");
}
?>
<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php
          $sql = mysqli_query($conn, "SELECT * FROM usuarios WHERE id = {$_SESSION['unique_id']}");
          if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
          }
          ?>
          <div id="details-atendant" class="details">
            <div class="data-user">
            <span><img src="../../img/sac.jpg" alt=""></span>
            <span><?php echo $row['nome'] ?></span>
            </div>
            <div class="exit-div">
            <a href=""><button><i id="exit-icon" class="fas fa-door-open"> Sair</i></button></a>
            </div>
          </div>
        </div>
      </header>
      <div class="search">
        <span class="text">Selecione um usuário para entrar no chat</span>
        <input type="text" placeholder="Pesquise um cliente">
        <button><i class="fas fa-search"></i></button>
      </div>
      <div class="users-list">

      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>

</html>