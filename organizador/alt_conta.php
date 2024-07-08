<?php
include "../conn.php";
include "restrito_organizador.php";
?>
<?php
if(isset($_POST['salvar'])){
   $id=$_POST['id'];
   $email=$_POST['email'];
   $nome=$_POST['nome'];
   $datanasc=$_POST['datanasc'];
   $cnpj=$_POST['cnpj'];
   $telefone=$_POST['telefone'];
   $cep=$_POST['cep'];
   $estado=$_POST['estado'];
   $cidade=$_POST['cidade'];
   $bairro=$_POST['bairro'];
   $rua=$_POST['rua'];
   $numero=$_POST['numero'];
   $alt=$conn->prepare("UPDATE organizadores SET nm_organizador = :nome, ds_email = :email, dt_nascimento = :datanasc, nr_telefone = :telefone,
   nr_cnpj = :cnpj, nr_cep = :cep, nm_estado = :estado, nm_cidade = :cidade, nm_bairro = :bairro, nm_rua = :rua, ds_numero = :numero
   WHERE id_organizador = :id; AND status_cad = 1;");
   $alt->bindValue(":nome",$nome);
   $alt->bindValue(":email",$email);
   $alt->bindValue(':datanasc' , $datanasc);
   $alt->bindValue(':cnpj' , $cnpj);
   $alt->bindValue(':telefone' , $telefone);
   $alt->bindValue(':cep' , $cep);
   $alt->bindValue(':estado' , $estado);
   $alt->bindValue(':cidade' , $cidade);
   $alt->bindValue(':bairro' , $bairro);
   $alt->bindValue(':rua' , $rua);
   $alt->bindValue(':numero' , $numero);
   $alt->bindValue(':id' , $id);
   $alt->execute();
   header ("Location: minha_conta_org.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" style="text/css" href="../style.css" />
   <link rel="stylesheet" style="text/css" href="../hover.css" />
   <title>Meus Dados</title>
</head>

<body>
   <nav>
      <div class="container-fluid menu" style="background-color: #000080;">
         <div class="container text-center" style="background-color: #000080;">
            <div class="row">
               <div class=" col-xl-3 col-md-4 col-12 pb-2">
                  <a class="navbar-brand" href="home_organizador.php">
                     <img src="../img/Group 49.png" height="60" width="auto">
                  </a>
               </div>
               <div class="pt-3 col-xl-6 col-md-4 col-12"></div>
               <div class="dropdown-center pt-3 col-xl-3 col-md-4 col-12">
                  <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-center" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" color="#F5F5F5">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                     </svg>
                     <?php
                     $cons_nome = $conn->prepare('SELECT * FROM organizadores WHERE id_organizador=:id');
                     $cons_nome->bindValue(':id', $_SESSION['login']);
                     $cons_nome->execute();
                     $row_nome = $cons_nome->fetch();
                     echo "<p>Olá, " . $row_nome['nm_organizador'] . "</P>";
                     ?>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="log_org.php">sair</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </nav>
   <div class="container-fluid" style="background-color: #000033; height: 40px; width: 100%;"></div>

   <div class="container-fluid">
      <div class="container">
         <div class="row">
            <div class="col-lg-4 col-sm-12 pt-5 ps-5">
               <div class="list-group">
                  <a href="#" class="list-group-item list-group-item-action  list-group-item-dark" aria-current="true">
                     MINHA CONTA
                  </a>
                  <a href="minha_conta_org.php" class="list-group-item list-group-item-action">Dados Pessoais</a>
                  <a href="log_org.php" class="list-group-item list-group-item-action">Sair</a>

               </div>
            </div>
            <div class="col-lg-8 col-sm-12 pt-5 ps-5">
               <form action="alt_conta.php?id=<?php echo $row_nome['id_organizador']; ?>" method="POST">
                  <ul class="list-group">
                     <li class="list-group-item list-group-item-dark">DADOS PESSOAIS</li>

                     <div class="row">
                        <div class="col mb-2 mt-2">
                           <input type="hidden" name="id" value="<?php echo $row_nome['id_organizador']; ?>" />
                           <label for="nome" class="form-label">Nome:</label>
                           <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row_nome['nm_organizador'] ?>">
                        </div>
                        <div class="col mb-2 mt-2">
                           <label for="cnpj" class="form-label">CNPJ:</label>
                           <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $row_nome['nr_cnpj'] ?>">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col mb-2">
                           <label for="datanasc" class="form-label">Data de nascimento:</label>
                           <input type="date" class="form-control" id="datanasc" name="datanasc" value="<?php echo $row_nome['dt_nascimento'] ?>">
                        </div>
                        <div class="col mb-2">
                           <label for="telefone" class="form-label">Telefone:</label>
                           <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $row_nome['nr_telefone'] ?>">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-6 ">
                           <label for="email" class="form-label">E-mail</label>
                           <input type="text" class="form-control" id="email" name="email" value="<?php echo $row_nome['ds_email'] ?>">
                        </div>
                     </div>
                     <br>

                  </ul>
                  <br>
                  <ul class="list-group">
                     <li class="list-group-item list-group-item-dark">ENDEREÇO</li>
                     <div class="row">
                        <div class="col mb-2 mt-2">
                           <label for="rua" class="form-label">Rua:</label>
                           <input type="text" class="form-control" id="rua" name="rua" value="<?php echo $row_nome['nm_rua'] ?>">
                        </div>
                        <div class="col-2 mb-2 mt-2">
                           <label for="nr" class="form-label">Numero:</label>
                           <input type="text" class="form-control" id="nr" name="numero" value="<?php echo $row_nome['ds_numero'] ?>">
                        </div>
                        <div class="col mb-2">
                           <label for="bairro" class="form-label">Bairro:</label>
                           <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $row_nome['nm_bairro'] ?>">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col mb-2">
                           <label for="cidade" class="form-label">Cidade::</label>
                           <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $row_nome['nm_cidade'] ?>">
                        </div>
                        <div class="col mb-2">
                           <label for="estado" class="form-label">Estado:</label>
                           <input type="text" class="form-control" id="estado" name="estado" value="<?php echo $row_nome['nm_estado'] ?>">
                        </div>
                        <div class="col-2 mb-2">
                           <label for="cep" class="form-label">CEP:</label>
                           <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $row_nome['nr_cep'] ?>">
                        </div>
                     </div>
                  </ul>
                  <br>
                  <a href="minha_conta_org.php" type="button" class="btn btn-secondary">Voltar</a>
                  <button name="salvar" type="submit" class="btn btn-success">Salvar</button>
               </form>
               <br><br>
            </div>
         </div>
      </div>
   </div>

</body>

</html>