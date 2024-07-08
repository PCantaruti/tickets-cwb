<?php
session_start();
include "../conn.php";
if(isset($_SESSION['login'])){

$cons_nome = $conn->prepare('SELECT * FROM usuarios WHERE id_usuario=:id');
$cons_nome->bindValue(':id', $_SESSION['login']);
$cons_nome->execute();
$row_nome = $cons_nome->fetch();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" style="text/css" href="../style.css"/>
   <title>Carrinho</title>
</head>
<body>
   <nav>
      <div class="container-fluid menu" style="background-color: #000080;">
         <div class="container text-center" style="background-color: #000080;">
            <div class="row">
               <div class="col-xl-3 col-md-4 col-12">
                  <a class="navbar-brand" href="../index.php">
                     <img src="../img/Group 49.png" height="60" width="auto">
                  </a>
               </div>
               <div class="pt-3 pb-2 col-xl-6 col-md-4 col-12"></div>
               <div class="pt-3 pb-2 col-xl-3 col-md-4 col-12">
               <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-center" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" color="#F5F5F5">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                     </svg>
                     <?php
                     if (!isset($_SESSION['login'])) {
                        echo "<p>Entre ou Cadastre-se</p>";
                     ?>
                        <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="../cad/login.php">Entre</a></li>
                           <li><a class="dropdown-item" href="../cad/cadastro.php">Cadastre-se</a></li>
                           <li><a class="dropdown-item" href="../cad/login_organizador.php">*Organizador</a></li>
                           <li><a class="dropdown-item" href="../cad/login_adm.php">*Adm</a></li>
                        </ul>
                        <?php
                     } else {
                        // Verifique se $row_nome está definido e contém um nome de usuário válido
                        if (isset($row_nome) && isset($row_nome['nm_usuario'])) {
                           echo "<p>Olá, " . htmlspecialchars($row_nome['nm_usuario']) . "</p>";
                        ?>
                           <ul class="dropdown-menu">
                           <li><a class="dropdown-item" href="../usuario/minha_conta.php">Minha Conta</a></li>
                           <li><a class="dropdown-item" href="../log.php">Sair</a></li>
                           </ul>
                     <?php
                        }
                     }
                     ?>
                  </a>
               </div>
         </div>
      </div>
      <div class="container-fluid"  style="background-color: #000033; height: 60px; width: 100%;"></div>
   </nav>
      <div class="container-fluid" style="background-color: #fff;">
         <div class="container">
            <div class="row">
               <div class="col pt-4 pb-3">
                  <h5>
                     MEU CARRINHO
                  </h5>
               </div>
            </div>
         </div>
      </div>
      <br>
      <div class="container-fluid">
         <div class="container text-center">
            <div class="row">
               <div class="col">
                  <h5 style="color:#000033">Parabéns! O seu pedido foi realizado com sucesso.</h5>
                  <br><br>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid">
         <div class="container text-center">
            <div class="row">
               <div class="col">
                  <table class="table table-hover">
                     <thead>
                        <tr class="table-secondary">
                           <th scope="col">NÚMERO DO PEDIDO</th>
                           <th scope="col">FORMA DE PAGAMENTO</th>
                           <th scope="col">VALOR TOTAL</th>
                           <th scope="col">INGRESSOS</th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>1279852559752364</td>
                           <td>Pix</td>
                           <td>R$388,00</td>
                           <td>
                              <a href="ingresso.html">Imprimir</a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <br><br><br><br><br>
   <footer class="fixed-bottom">
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-md-12 pt-4">
                  <ul>
                     <li class="list-group-item">
                        <a href="../Pi_1/atendimento.html">
                           <p>Atendimento ao Cliente</p>
                        </a>
                     </li>
                     <li class="list-group-item">
                        <a href="../Pi_1/formpagamento.html">
                           <p>Formas de Pagamento</p>
                        </a>
                     </li>
                     <li class="list-group-item">
                        <a href="../Pi_1/meiaentrada.html">
                           <p>Meia-entrada</p>
                        </a>
                     </li>
                     <li class="list-group-item">
                        <a href="../PI/login_organizador.html">
                           <p>Venda na Tickets CWB</p>
                        </a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="container-fluid"  style="background-color: #000033; height: 60px; width: 100%;"></div>
   </footer>
   
</body>
</html>