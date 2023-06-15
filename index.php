<?php
require_once 'conexao.php';

session_start();
@$cnpj_cpf_final = preg_replace("/\D+/", "", $_POST['cnpj_cpf']); //Retira todas as strings não numéricas

if (isset($_POST['btn-entrar'])) {
  $erros = array();
  @$cnpj_cpf = mysqli_escape_string($conn, $cnpj_cpf_final);
  $senha = mysqli_escape_string($conn, $_POST['senha']);

  if (empty($cnpj_cpf) or empty($senha)) {
    $erros[] = "<center>Os Campos precisam ser preenchidos!</center>";
  } else {
    // Pesquisa se o usuário é cliente
    $sql_cliente = "SELECT * FROM cadastro_clientes WHERE cnpj_cpf = '$cnpj_cpf' AND status_ativacao <> 0";
    $result_cliente = mysqli_query($conn, $sql_cliente);

    // Pesquisa se o usuário é Administrador
    $sql_adm = "SELECT * FROM usuarios WHERE cpf = '$cnpj_cpf' AND status <> 0";
    $result_adm = mysqli_query($conn, $sql_adm);

    // CLIENTE
    if (mysqli_num_rows($result_cliente) > 0) {
      $row = mysqli_fetch_assoc($result_cliente);
      $user_pass = md5($senha);
      $enc_pass = $row['senha'];


      if ($user_pass === $enc_pass) {
        $_SESSION['cliente_logado'] = true;
        $_SESSION['id_cliente'] = $row['id'];
        $_SESSION['unique_id'] = $row['unique_id'];
        header('Location: pages/app.php');
      } else {
        $erros[] = "<center>Login Inválido!</center>";
      }

      // ADMINISTRADOR
    } elseif (mysqli_num_rows($result_adm) > 0) {

      $row = mysqli_fetch_assoc($result_adm);
      $user_pass = $senha;
      $adm_pass = $row['senha'];
      if ($user_pass === $adm_pass) {
        $_SESSION['adm_logado'] = true;
        $_SESSION['id_adm'] = $row['id'];
        $_SESSION['unique_id'] = $row['id'];
        header('Location: pages/chat/users.php');
      } else {
        $erros[] = "<center>Login Inválido!</center>";
      }
    } else {
      $erros[] = "<center>Login Inválido!</center>";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>VB Cliente | Login</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.css'>
  <link rel="stylesheet" href="css/style_login.css">
  <link rel="icon" sizes="16x16" href="assets/img/logo_vb_branca.png">
</head>

<body>

  <div class="login-container">
    <div class="login-form">
      <div class="login-form-inner">
        <div class="logo">
          <img src="assets/img/login-img.jpg" alt="">
        </div>



        <div class="sign-in-seperator">
          <span><img id="img-logo" src="assets/img/logo_vb.png" alt=""> Mobile</span>
        </div>
        <form action="" name="loginform" method="post">
          <div class="login-form-group">
            <label for="email">CNPJ/CPF: <span class="required-star">*</span></label>
            <input name="cnpj_cpf" placeholder="CNPJ ou CPF do cliente" id="myInput" maxlength="18" required>
            <input id="cnpj" style="display: none">
            <input id="cpf" style="display: none">
          </div>

          <div class="login-form-group">
            <label for="pwd">Senha: <span class="required-star">*</span></label>
            <input required name="senha" autocomplete="off" type="password" placeholder="Senha do cliente" id="pwd">
          </div>

          <div class="login-form-group single-row">
            <div class="custom-check">
              <input autocomplete="off" type="checkbox" checked id="remember"><label for="remember">Lembrar Login</label>
            </div>

          </div>
          <input name="btn-entrar" type="submit" class="rounded-button login-cta" value="Login">

          <?php
          if (!empty($erros)) :
            foreach ($erros as $erro) :
              echo $erro;
            endforeach;
          endif;
          ?>

        </form>

        <div class="register-div">
          <p>Não consegue logar?</p> <a href="#" class="link create-account">Clique aqui</a>
        </div>
      </div>

    </div>
    <div class="onboarding">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide color-1">
            <div id="different-slide" class="slide-image">
              <img id="slide-img-1" src="assets/img/suporte.gif" loading="lazy" alt="" />
            </div>
            <div class="slide-content">
              <h2>Atendimento especializado 💬</h2>
              <p>Informações e sugestões com atendimento focado nas necessidades do cliente.</p>
            </div>
          </div>
          <div class="swiper-slide color-1">
            <div id="different-slide" class="slide-image">
              <img id="slide-img-1" src="assets/img/suporte2.gif" loading="lazy" alt="" />
            </div>
            <div class="slide-content">
              <h2>Avalie seus serviços VB 🥇</h2>
              <p>Avalie sua experiência ao final de cada entrega, com ela podemos melhorar ainda mais</p>
            </div>
          </div>

          <div class="swiper-slide color-1">
            <div id="different-slide" class="slide-image">
              <img id="slide-img-1" src="assets/img/suporte3.gif" loading="lazy" alt="" />
            </div>
            <div class="slide-content">
              <h2>Agendamento hábil de coletas 🚚</h2>
              <p>Agende suas coletas de forma rápida e simplificada, tenha o controle na palma da mão.</p>
            </div>
          </div>
        </div>
        <!-- Paginação -->
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </div>
  <!-- scripts e libs -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.0/js/swiper.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
  <script src="js/carousel-log.js"></script>
  <script src="js/mask-cnpj-cpf.js"></script>

</body>

</html>