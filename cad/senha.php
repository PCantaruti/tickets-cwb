<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>senha</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" type="text/css" href="style_1.css">
</head>

<body>
   <div class="container-fluid menu" style="background-color: #000080;">
      <div class="container text-center" style="background-color: #000080;">
         <div class="row">
            <div class=" col-xl-3 col-md-4 col-12 pb-2">
               <a class="navbar-brand" href="../index.php">
                  <img src="../img/Group 49.png" height="60" width="auto">
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;">
      <div class="container">
         <div class="row">
            <div class="pt-3 col-md-12">
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid login">
      <div class="container text-center">
         <div class="row">
            <div class="col"></div>
            <div class="col-5 " style="border-width: 2px; border-style: solid; border-color: #E0E6EB; border-radius: 10px; background-color: #fff;"><br><br>
               <?php
               include "../conn.php";

               if (isset($_POST['email'])) {
                  $email = $_POST['email'];

                  // Consulta para buscar o id_usuario na tabela usuarios
                  $cons_usuarios = $conn->prepare('SELECT id_usuario, ds_email FROM usuarios WHERE ds_email = :email');
                  $cons_usuarios->bindValue(':email', $email);
                  $cons_usuarios->execute();
                  $row_usuarios = $cons_usuarios->fetch();

                  // Se o email não foi encontrado na tabela usuarios, busca na tabela organizadores
                  if ($cons_usuarios->rowCount() == 0) {
                     $cons_organizadores = $conn->prepare('SELECT id_organizador AS id_usuario, ds_email FROM organizadores WHERE ds_email = :email');
                     $cons_organizadores->bindValue(':email', $email);
                     $cons_organizadores->execute();
                     $row_organizadores = $cons_organizadores->fetch();

                     if ($cons_organizadores->rowCount() == 0) {
                        // Email não encontrado em nenhuma das tabelas
               ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>E-mail não encontrado!</strong> O e-mail que você solicitou a recuperação<br>de senha não consta em nossa base de dados.
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
               <?php
                     } else {
                        // Email encontrado na tabela organizadores
                        $id_usuario = $row_organizadores['id_usuario'];
                        $ds_email = $row_organizadores['ds_email'];

                        // Gerar nova senha
                        function gerarSenha($tamanho = 10)
                        {
                           $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_';
                           $caracteresEmbaralhados = str_shuffle($caracteres);
                           $senha = substr($caracteresEmbaralhados, 0, $tamanho);
                           return $senha;
                        }
                        $novasenha = gerarSenha();

                        // Atualizar senha na tabela organizadores
                        $grava_senha = $conn->prepare('UPDATE organizadores SET ds_senha = :senha WHERE id_organizador = :id_usuario');
                        $grava_senha->bindValue(':senha', md5($novasenha));
                        $grava_senha->bindValue(':id_usuario', $id_usuario);
                        $grava_senha->execute();

                        // Enviar nova senha por e-mail
                        include "send.php";
                     }
                  } else {
                     // Email encontrado na tabela usuarios
                     $id_usuario = $row_usuarios['id_usuario'];
                     $ds_email = $row_usuarios['ds_email'];

                     // Gerar nova senha
                     function gerarSenha($tamanho = 10)
                     {
                        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()-_';
                        $caracteresEmbaralhados = str_shuffle($caracteres);
                        $senha = substr($caracteresEmbaralhados, 0, $tamanho);
                        return $senha;
                     }
                     $novasenha = gerarSenha();

                     // Atualizar senha na tabela usuarios
                     $grava_senha = $conn->prepare('UPDATE usuarios SET ds_senha = :senha WHERE id_usuario = :id_usuario');
                     $grava_senha->bindValue(':senha', md5($novasenha));
                     $grava_senha->bindValue(':id_usuario', $id_usuario);
                     $grava_senha->execute();

                     // Enviar nova senha por e-mail
                     include "send.php";
                  }
               }
               ?>

               <form action="senha.php" method="POST">
                  <h4>Esqueceu sua senha?</h4><br>
                  <p>Por favor, insira seu e-mail e enviaremos as instruções para redefinir a senha.</p><br>
                  <div style="display: block; margin-left: 8%; overflow: hidden; align-items: center;" class="form-floating mb-3">
                     <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                     <label for="floatingInput">Email</label>
                  </div>
                  <button style="margin-top: 5%;" type="submit" class="btn btn-primary btn-lg">Recuperar senha</button><br><br>


            </div>
            </form>

            <div class="col"></div>
         </div>
      </div>
   </div><br><br>
   <!--Rodapé-->
   <footer>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="pt-4 col-md-12">
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
      <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
   </footer>
</body>

</html>