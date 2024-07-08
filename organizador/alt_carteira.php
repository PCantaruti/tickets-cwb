<?php
include "../conn.php";
include "restrito_organizador.php";
?>
<?php
if(isset($_POST['salvar'])){
   $id=$_POST['id'];
   $nome=$_POST['nome'];
   $cnpj=$_POST['cnpj'];
   $conta=$_POST['conta'];
   $digito=$_POST['digito'];
   $agencia=$_POST['agencia'];
   $alt=$conn->prepare("UPDATE financeiros SET nr_conta = :conta, nr_digito = :digito, nr_agencia = :agencia, 
   nr_cnpj = :cnpj, nm_titular = :nome WHERE id_financeiro = :id");
   $alt->bindValue(":nome",$nome);
   $alt->bindValue(':id' , $id);
   $alt->bindValue(":cnpj",$cnpj);
   $alt->bindValue(":conta",$conta);
   $alt->bindValue(":digito",$digito);
   $alt->bindValue(":agencia",$agencia);
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

               <?php
               $cons_cart = $conn->prepare('SELECT * FROM financeiros WHERE id_organizador=:id');
               $cons_cart->bindValue(':id', $_SESSION['login']);
               $cons_cart->execute();
               $row_cart = $cons_cart->fetch();
               ?>
               <form action="alt_carteira.php?id=<?php echo $row_cart['id_financeiro']; ?>" method="POST">
                  <ul class="list-group">
                     <li class="list-group-item list-group-item-dark">CARTEIRA</li>
                     <div class="row">
                        <div class="col mb-2 mt-2">
                           <input type="hidden" name="id" value="<?php echo $row_nome['id_organizador']; ?>" />
                           <input type="hidden" name="id" value="<?php echo $row_cart['id_financeiro']; ?>" />
                           <label for="nome" class="form-label">Nome:</label>
                           <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $row_cart['nm_titular'] ?>">
                        </div>
                        <div class="col mb-2 mt-2">
                           <label for="cnpj" class="form-label">CNPJ:</label>
                           <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?php echo $row_cart['nr_cnpj'] ?>">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col mb-2">
                           <label for="conta" class="form-label">Número conta:</label>
                           <input type="date" class="form-control" id="conta" name="conta" value="<?php echo $row_cart['nr_conta'] ?>">
                        </div>
                        <div class="col mb-2">
                           <label for="digito" class="form-label">Digíto:</label>
                           <input type="text" class="form-control" id="digito" name="digito" value="<?php echo $row_cart['nr_digito'] ?>">
                        </div>
                        <div class="col mb-2">
                           <label for="agencia" class="form-label">Agência:</label>
                           <input type="text" class="form-control" id="agencia" name="agencia" value="<?php echo $row_cart['nr_agencia'] ?>">
                        </div>
                     </div>
                     <br>

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