<?php
    require_once '../conexao.php';

	  session_start();
    
    if(isset($_POST['btn-entrar'])):
        $erros = array();
        @$cnpj_cpf = mysqli_escape_string($conn, $_POST['cnpj_cpf']);
        $senha = mysqli_escape_string($conn, $_POST['senha']);
		        
        if(empty($cnpj_cpf) or empty($senha)):
            $erros[] = "<center>Os Campos precisam ser preenchidos!</center>";
        else:    
            $sql = "SELECT cnpj_cpf FROM cadastro_clientes WHERE cnpj_cpf = '$cnpj_cpf' AND status <> 0";
            $resultado = mysqli_query($conn, $sql);
            
            if(mysqli_num_rows($resultado) > 0):
                $sql = "SELECT * FROM cadastro_clientes WHERE cnpj_cpf = '$cnpj_cpf' AND senha = '$senha'";
                $resultado = mysqli_query($conn, $sql);
                
                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['cliente_logado'] = true;
                    $_SESSION['id_cliente'] = $dados['id'];
					          header('Location: index.php');
				        else:
                    $erros[] = "<center>Login Inválido!<p></p></center>";
                endif;    
            else:
                $erros[] = "center><Login Inválido!</center>";
            endif;    
        endif;
    endif;  
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <link rel="shortcut icon" href="img/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VB Cliente | Login</title>
  </head>
  <body>
  <form name="loginform" method="post" action="">
    <input required name ="cnpj_cpf" type="number" placeholder="CNPJ / CPF"/>
    <input required name="senha" type="password" placeholder="Senha" />
    <input name="btn-entrar" type="submit" value="Entrar"/>
            
    <?php
      if(!empty($erros)):
            foreach($erros as $erro):
                      echo $erro;
              endforeach;
      endif;    
    ?>
  </form>
      
</body>
</html>
