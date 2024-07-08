<?php
include "../conn.php";
include "restrito_organizador.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" style="text/css" href="../style.css"/>
   <link rel="stylesheet" style="text/css" href="../hover.css"/>
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
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                     </svg>
                     <?php
                        $cons_nome=$conn->prepare('SELECT * FROM organizadores WHERE id_organizador=:id');
                        $cons_nome->bindValue(':id',$_SESSION['login']);
                        $cons_nome->execute();
                        $row_nome=$cons_nome->fetch();
                        echo "<p>Olá, ".$row_nome['nm_organizador']."</P>";
                     ?>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="log_org.php">Sair</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </nav>
   <div class="container-fluid" style="background-color: #000033; height: 40px; width: 100%;"> </div>
   
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
               <ul class="list-group ">
                  <li class="list-group-item list-group-item-dark">DADOS PESSOAIS</li>
                  <li class="list-group-item">Nome: <?php  echo $row_nome['nm_organizador']."<br>CNPJ: "
                  .$row_nome['nr_cnpj']."<br>Data de nascimento: ".$row_nome['dt_nascimento']."<br>Telefone: ".$row_nome['nr_telefone'].
                  "<br>E-mail:: ".$row_nome['ds_email'];?></li>      
               </ul> <br>
               <div class="d-grid gap-2 d-md-flex justify-content-md-start">
               <a type="button" class="btn btn-secondary " href="alt_conta.php">Editar
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                     <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                     <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg></a>
               </div><br>
               <?php
                $cons_cart=$conn->prepare('SELECT * FROM financeiros WHERE id_organizador=:id');
                $cons_cart->bindValue(':id',$_SESSION['login']);
                $cons_cart->execute();
                $row_cart=$cons_cart->fetch();
               ?>
               
               <ul class="list-group ">
                  <li class="list-group-item list-group-item-dark">CARTEIRA</li>
                  <li class="list-group-item">Nome: <?php  echo $row_cart['nm_titular']."<br>CNPJ: "
                  .$row_cart['nr_cnpj']."<br>Conta e digito: ".$row_cart['nr_conta']." - ".$row_cart['nr_digito'].
                  "<br>Agencia: ".$row_cart['nr_agencia'];?></li>      
               </ul> <br>

               <div class="d-grid gap-2 d-md-flex justify-content-md-start">
               <a type="button" class="btn btn-secondary " href="alt_carteira.php">Editar
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                     <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                     <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                  </svg></a>
               </div>
               
               <br>
                 
            </div>
         </div>
      </div>
   </div>
</body>
</html>