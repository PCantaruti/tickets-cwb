<?php
include "../conn.php";
include "../restrito.php";
$cons_nome=$conn->prepare('SELECT * FROM usuarios WHERE id_usuario=:id');
$cons_nome->bindValue(':id',$_SESSION['login']);
$cons_nome->execute();
$row_nome=$cons_nome->fetch();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
   <link rel="stylesheet" style="text/css" href="../style.css"/>
   <title>Minha conta</title>
</head>
<body>
   <nav>
      <div class="container-fluid menu" style="background-color: #000080;">
         <div class="container text-center" style="background-color: #000080;">
            <div class="row">
               <div class=" col-xl-3 col-md-4 col-12">
               <a class="navbar-brand" href="../index.php?id=<?php echo $row_nome['id_usuario']?>">
                     <img src="../img/Group 49.png" height="60" width="auto">
                  </a>
               </div>
               <div class="pt-3 col-xl-6 col-md-4 col-12">
                  <div class="container-fluid">
                     <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Recipient's username" for="pesquisar">  
                           <button class="btn btn-light" type="submit">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                 <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                              </svg>
                           </button>
                     </div>
                  </div>
               </div>
               <div class="dropdown-center pt-3 col-xl-3 col-md-4 col-12">
                  
                     <svg xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-center" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" color="#F5F5F5">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                     </svg>
                     <?php
                           
                         
                           echo "<p>Olá, ".$row_nome['nm_usuario']."</P>";
                        ?>
                 
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="../index.php">Sair</a></li>
                   </ul>
                  </a>
               </div>
         </div>
      </div>
   </nav>
   <div class="container-fluid"  style="background-color: #000033; height: 40px; width: 100%;"></div>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col-lg-4 col-sm-12 pt-5 ps-5">
               <div class="list-group"> 
                     <a href="#" class="list-group-item list-group-item-action  list-group-item-dark" aria-current="true">
                     MINHA CONTA
                     </a>
                     <a href="minha_conta.php" class="list-group-item list-group-item-action">Meus Pedidos</a>
                     <a href="meus_dados.php" class="list-group-item list-group-item-action">Meus Dados</a>
                     <a href="../log.php" class="list-group-item list-group-item-action">Sair</a>
                  
                  </div>      
               </div>
               <div class="col-lg-8 col-sm-12 pt-5 ps-5">
                  <table class="table table-primary table-borderless table-hover">
                     <thead>
                        <tr class="text-center">
                           <th scope="col" class="col-11">RED HOT CHILI PEPPERS | COUTO PEREIRA</th>
                           <th class="col-1">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#redhot" aria-expanded="true" aria-controls="flush-collapseThree">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="auto" fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                  </svg>
                               </button>
                           </th>
                        </tr>
                     </thead>
                  </table>
                  <div id="redhot" class="accordion-collapse collapse show"  data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
                        <table class="table table-borderless">
                           <thead>
                              <tr class="">
                                 <th scope="row" >NÚMERO DO PEDIDO:</th>
                                 <th>1279852559752364</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="2">Estádio Couto Pereira | Rua Ubaldino do Amaral, 37, 80060-195 CURITIBA</td>
                              </tr>
                              <tr>
                                 <td colspan="2">Segunda-feira, 12/01/2024 | 21:00</td>
                              </tr>
                              <tr>
                                 <td>1. Ingresso Pista - Inteira</td>
                                 <td>R$225,50</td>
                              </tr>
                              <tr>
                                 <td>1. Ingresso Pista - Meia-entrada</td>
                                 <td>R$112,50</td>
                              </tr>
                              <tr>
                                 <td>Taxa Administrativa</td>
                                 <td>R$50,00</td>
                              </tr>
                              <tr class="table-primary">
                                 <td>TOTAL</td>
                                 <td>R$388,00</td>
                              </tr>
                              <tr>
                                 <th scope="row">INGRESSOS:</th>
                                 <td>
                                    <a href="ingresso.html" target="_blank"><button type="button" class="btn btn-primary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Imprimir
                                    </button></a>
                                 </td>
                              </tr>   
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <table class="table table-secondary table-borderless table-hover">
                     <thead>
                        <tr class="text-center">
                           <th scope="col" class="col-11">EVANESCENCE - LIVE</th>
                           <th class="col-1">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#evanescence" aria-expanded="false" aria-controls="flush-collapseThree">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="auto" fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                  </svg>
                               </button>
                           </th>
                        </tr>
                     </thead>
                  </table>
                  <div id="evanescence" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
                        <table class="table table-borderless">
                           <thead>
                              <tr class="">
                                 <th scope="row" >NÚMERO DO PEDIDO:</th>
                                 <th>1110852559752364</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="2">Live Curitiba |  R. Itajubá, 143, 81050-040 CURITIBA</td>
                              </tr>
                              <tr>
                                 <td colspan="2">Quinta-Feira, 19/10/2023 | 20:00</td>
                              </tr>
                              <tr>
                                 <td>1. Ingresso Pista - Inteira</td>
                                 <td>R$300,00</td>
                              </tr>
                              <tr>
                                 <td>Taxa Administrativa</td>
                                 <td>R$50,00</td>
                              </tr>
                              <tr class="table-secondary">
                                 <td>TOTAL</td>
                                 <td>R$350,00</td>
                              </tr>
                              <tr>
                                 <th scope="row">INGRESSOS:</th>
                                 <td>
                                    <a href="ingresso.html" target="_blank"><button type="button" class="btn btn-dark" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Imprimir
                                    </button></a>
                                 </td>
                              </tr>   
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <table class="table table-secondary table-borderless table-hover">
                     <thead>
                        <tr class="text-center">
                           <th scope="col" class="col-11">EVIL INVADERS - BELVEDERE</th>
                           <th class="col-1">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#evilinvaders" aria-expanded="false" aria-controls="flush-collapseThree">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="auto" fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                    <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                  </svg>
                               </button>
                           </th>
                        </tr>
                     </thead>
                  </table>
                  <div id="evilinvaders" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                     <div class="accordion-body">
                        <table class="table table-borderless">
                           <thead>
                              <tr class="">
                                 <th scope="row" >NÚMERO DO PEDIDO:</th>
                                 <th>1124852559752364</td>
                              </tr>
                           </thead>
                           <tbody>
                              <tr>
                                 <td colspan="2">Belvedere |  R. Inácio Lustosa, 496, 80510-000 CURITIBA</td>
                              </tr>
                              <tr>
                                 <td colspan="2">Terça-Feira, 30/05/2023 | 20:00</td>
                              </tr>
                              <tr>
                                 <td>1. Ingresso</td>
                                 <td>R$60,00 + 1kg de Alimento</td>
                              </tr>
                              <tr>
                                 <td>Taxa Administrativa</td>
                                 <td>-</td>
                              </tr>
                              <tr>
                                 <td colspan="2">*Deve ser entregue na portaria</td>
                              </tr>
                              <tr class="table-secondary">
                                 <td>TOTAL</td>
                                 <td>R$60,00</td>
                              </tr>
                              <tr>
                                 <th scope="row">INGRESSOS:</th>
                                 <td>
                                     <a href="ingresso.html" target="_blank"> <button type="button" class="btn btn-dark" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">
                                    Imprimir
                                    </button></a>
                                 </td>
                              </tr>   
                           </tbody>
                        </table>
                     </div>
                  </div>
            </div>
         </div>
      </div>
      <br><br>
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
      <div class="container-fluid"  style="background-color: #000033; height: 60px; width: 100%;"></div>
   </footer>
</body>
</html>