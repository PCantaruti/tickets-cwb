<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Projeto</title>
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
            <div class="col-5" style="border-width: 2px; border-style: solid; border-color: #E0E6EB; border-radius: 10px; background-color: #fff;">

               <form action="login_organizador.php" method="POST">
                  <h1>Login</h1><br><br>
                  <?php
                  if (isset($_POST['logar'])) {
                     $login = $_POST['login'];
                     $senha = md5($_POST['senha']);
                     include "../conn.php";
                     $log = $conn->prepare('SELECT * FROM `organizadores` WHERE `ds_email` = :email AND `ds_senha` = :senha');
                     $log->bindValue(":email", $login);
                     $log->bindValue(":senha", $senha);
                     $log->execute();
                     if ($log->rowCount() == 0) {
                  ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>Login ou senha inaválido!</strong>
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                  <?php
                     } else {
                        $row = $log->fetch();
                        session_start();
                        $_SESSION['login'] = $row['id_organizador'];
                        header('location:../organizador/home_organizador.php');
                     }
                  }
                  ?>
                  <div class="form-floating mb-3">
                     <input type="email" name="login" class="form-control" id="floatingInput" placeholder="name@example.com">
                     <label for="floatingInput">Email</label>
                  </div>
                  <div class="form-floating">
                     <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Password">
                     <label for="floatingPassword">Senha</label>
                  </div>
                  <button type="submit" name="logar" class="btn btn-primary btn-lg" style="margin-top: 5%;">Entrar</button>
                  <br><br>
                  <a href="senha.php" target="_blank">
                     <p>Esqueceu sua senha?</p>
                  </a><br><br>
                  <p>Não tem uma conta ainda?</p>
                  <a href="cadastro_organizador.php" target="_blank">
                     <h6>Cadastre-se</h6>
                  </a>
               </form>
            </div>
            <div class="col"></div>
         </div>
      </div>
   </div>
   </div>
   <br>
   <br>
</body>

</html>