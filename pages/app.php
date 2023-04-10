<?php
include_once("../conexao.php");
@session_start();
if (!isset($_SESSION['cliente_logado'])) :
	header('Location: index.php');
endif;

$id_cliente = $_SESSION['id_cliente'];
$sql = "SELECT * FROM cadastro_cliente WHERE id = '$id_cliente'";
$resultado = mysqli_query($conn, $sql);
while($dados = mysqli_fetch_array($resultado)){
    $clientes[] = $dados;
}

?>
<!DOCTYPE html>

<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>VB - Cliente</title>
    <link rel="icon" href="img/logo_vb.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="manifest" href="../manifest.json">
    <link rel="stylesheet" href="../css/style_app.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/7a8d54eabc.js" crossorigin="anonymous"></script>
    <script>
        if (typeof navigator.serviceWorker !== 'undefined'){
            navigator.serviceWorker.register('../pwabuilder-sw.js')
        }
    </script>
</head>

<!-- Evento de loading (animacao pós login) -->
<script>
function carregar() {
    document.getElementById("teste").style.display="block";
    document.getElementById("loading-content").style.display="none";
}
</script>


<body style="background-color: #F2F2F2;" onLoad="setTimeout(carregar, 8000);">
    <div id="loading-content" style="height: 100vw">
        <div class="anima-truck" style="height: 65vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;">
            <img style="width: 22rem;"src="../img/truck.gif" alt="">
        </div>
        <div class="logo-vb" style="display: flex;
            align-items: center;
            justify-content: center;"> 
            <div style="justify-items:center"> 
            <img style="width:7rem;margin-left: 1rem;" src="../img/vblogo-e.png" alt="">
            <div class="progress-loader">
                <div class="progress"></div>
            </div>
            
            <!-- <p style="font-family: 'Alkatra', cursive;text-align: center; color: orange;font-weight: bold;font-size: 18px;">Vai Bem, Vem Bem!</p> -->
        </div>
        </div>
    </div>
    <div ID="teste" style="display:none;"> 
    <nav>
        <div class="logo-name">
            <div class="logo-image">
            <img src="../img/logo_vb.png" alt="">

            </div>
            <span class="logo_name">Cliente</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboards</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Ticket</span>
                </a></li>
                <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Histórico</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Elogios e Reclamações</span>
                </a></li> -->
                <li><a href="#">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Fale Conosco</span>
                </a></li>
                <!-- <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Share</span>
                </a></li> -->
            </ul>
            
            <ul class="logout-mode">
                <li><a href="../logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Sair</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="chat-baloon">
            <img src="" alt="">
        </div>
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Procure aqui...">
            </div>
        </div>

        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-tachometer-fast-alt"></i>
                    <span class="text">Dashboard</span>
                </div>

                <div class="boxes">
                    <div class="box box1">
                        <i class="fas fa-truck"></i>
                        <span class="text">Total de Entregas:</span>
                        <span class="number">23</span>
                    </div>
                    <div class="box box2">
                        <i class="fas fa-coins"></i>
                        <span class="text">VB Cash:</span>
                        <span class="number">458 Pontos</span>
                    </div>
                    <div class="box box3">
                        <i class="fas fa-map-marker-alt"></i>
                        <span class="text">Rastreio:</span>
                        <span class="number">Acompanhar</span>
                        <span id="text-rastreio" class="text">02 Entregas em Rota</span>
                    </div>
                </div>
            </div>

            <div class="activity">
                <div class="title">
                    <i class="uil uil-clock-three"></i>
                    <span class="text">Últimas Postagens:</span>
                </div>

                <div class="activity-data">
                    <div class="data email">
                        <span class="data-title">Produto</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                        <span class="data-list">Produto Que foi Enviado</span>
                         
                    </div>
                    <div class="data names">
                        <span class="data-title">Nota Fiscal</span>
                        <span class="data-list">123321</span>
                        <span class="data-list">123321</span>
                        <span class="data-list">123321</span>
                        <span class="data-list">123321</span>
                        <span class="data-list">123321</span>
                        <span class="data-list">123321</span>
                        <span class="data-list">123321</span>
                    </div>
                
                    <div class="data joined">
                        <span class="data-title">Postagem</span>
                        <span class="data-list">2023-02-12</span>
                        <span class="data-list">2023-02-12</span>
                        <span class="data-list">2023-02-13</span>
                        <span class="data-list">2023-02-13</span>
                        <span class="data-list">2023-02-14</span>
                        <span class="data-list">2023-02-14</span>
                        <span class="data-list">2023-02-15</span>
                    </div>
                    <div class="data joined">
                        <span class="data-title">Entregue</span>
                        <span class="data-list">2023-02-12</span>
                        <span class="data-list">2023-02-12</span>
                        <span class="data-list">2023-02-13</span>
                        <span class="data-list">2023-02-13</span>
                        <span class="data-list">2023-02-14</span>
                        <span class="data-list">2023-02-14</span>
                        <span class="data-list">2023-02-15</span>
                    </div>
                    <div class="data status">
                        <span class="data-title">Status</span>
                        <span style="color: #00b500c7" class="data-list">No Prazo</span>
                        <span style="color: #ff0000c2"class="data-list">Atrasado</span>
                        <span style="color: #00b500c7" class="data-list">No Prazo</span>
                        <span style="color: #00b500c7"class="data-list">No Prazo</span>
                        <span style="color: #ff0000c2"class="data-list">Atrasado</span>
                        <span style="color: #00b500c7"class="data-list">No Prazo</span>
                        <span style="color: #00b500c7"class="data-list">No Prazo</span>
                    </div>
                </div>
            </div>
            <div class="activity">
                <div class="title">
                    <i class="fas fa-map-marked-alt"></i>
                <div class="text-orders">
                    <span class="text">Rastreio:</span>
                    <small id="subtext-titles" class="text">Itens em Rota</small>
                </div>
                </div>

                <div class="activity-data">
                    <div class="md-stepper-horizontal orange">
                        <div class="md-step active done">
                          <div class="md-step-circle"><span>1</span></div>
                          <div class="md-step-title">Postado</div>
                          <div class="md-step-optional">Item recebido</div>
                          <div class="md-step-bar-left"></div>
                          <div class="md-step-bar-right"></div>
                        </div>
                        <div class="md-step active editable">
                          <div class="md-step-circle"><span>2</span></div>
                          <div class="md-step-title">Em Trânsito</div>
                          <div class="md-step-optional">Para a base mais próxima</div>
                          <div class="md-step-bar-left"></div>
                          <div class="md-step-bar-right"></div>
                        </div>
                        <div class="md-step active">
                          <div class="md-step-circle"><span> <i class="fas fa-truck-loading"></i></span></div>
                          <div class="md-step-title">Chegou na Base</div>
                          <div class="md-step-bar-left"></div>
                          <div class="md-step-bar-right"></div>
                        </div>
                        <div class="md-step">
                          <div class="md-step-circle"><span><i class="fas fa-shipping-fast"></i></span></div>
                          <div class="md-step-title">Saiu para Entrega</div>
                          <div class="md-step-bar-left"></div>
                          <div class="md-step-bar-right"></div>
                        </div>
                        <div class="md-step">
                            <div class="md-step-circle"><span><i class="fas fa-check"></i></span></div>
                            <div class="md-step-title">Entregue</div>
                            <div class="md-step-bar-left"></div>
                            <div class="md-step-bar-right"></div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <script src="../js/app.js"></script>
</body>
</html>
