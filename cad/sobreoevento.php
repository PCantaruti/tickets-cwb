<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
   <nav>
    <div class="container-fluid menu" style="background-color: #000080;">
        <div class="container text-center" style="background-color: #000080;">
           <div class="row">
              <div class=" col-xl-3 col-md-4 col-12 pb-2">
                 <a class="navbar-brand" href="../adm/home_adm.php">
                    <img src="../img/Group 49.png" height="60" width="auto">
                 </a>
              </div>
           </div>
        </div>
    </div>
   </nav>
    <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"> 
        <div class="container">
           <div class="row">
              <div class="pt-3 col-md-12">
                 
              </div>
           </div>           
        </div>
     </div><br><br>
    <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-4 col-sm-12">
            <img src="../img/banner/banner_redhot.png" class="rounded mx-auto d-block" alt="">
          </div>
          <div class="col-lg-8 col-md-8 col-sm-12">
            <h2>RED HOT CHILI PEPPERS</h2>
            <table class="table table-borderless">
               <tr>
                  <td>Estádio Couto Pereira | Rua Ubaldino do Amaral, 37, 80060-195 CURITIBA</td>
               </tr>
               <tr>
                  <td>Segunda-feira, 12/01/2023 | 21:00</td>
               </tr>
               <tr>
                  <td >RED HOT CHILI PEPPERS TRAZ SUA UNLIMITED LOVE TOUR PARA CINCO CIDADES DO BRASIL EM 2024</td>
               </tr>
               <tr>
                  <td >Organizador: Eventos Brasil LTDA</td>
               </tr>
               <tr>
                  <td >Cadastrado em: 01/06/2023</td>
                  
               </tr>
               <tr>
                  <td>Ínicio de Vendas: 10/06/2023 | Encerramento de Vendas: 12/01/2023</td>
               </tr>
               <tr>
                  <td>
                     <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#bloquear">Bloquear evento</button>
                     <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#liberar">Liberar Pagamento</button>
                  </td>
                  
               </tr>
            </table>
          </div>
        </div>
        <div class="modal fade" id="bloquear" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <h1 style="color: #000;"class="modal-title fs-5" id="exampleModalLabel">Tem certeza que deseja bloquear este evento?</h1>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Sim</button>
               <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Não</button>
             </div>
           </div>
         </div>
       </div>
       <div class="modal fade" id="liberar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
           <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
               <h1 style="color: #000;"class="modal-title fs-5" id="exampleModalLabel">Tem certeza que deseja liberar o pagamento?</h1>
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Sim</button>
               <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Não</button>
             </div>
           </div>
         </div>
       </div>
    </div>
      </div><br>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="col ps-5 ms-5">
                  <table class="table table-borderless">
                     <tr>
                        <th>Capacidade Total: 14.500</th>
                     </tr>
                     <tr>
                        <td>Pista: 7.000</th>
                     </tr>
                     <tr>
                        <td>Pista Premium: 7.000</th>
                     </tr>
                     <tr>
                        <td>Camarote: 500</th>
                     </tr>
                  </table>
                  <table class="table">
                    
                     <tr>
                       <th scope="col">-</th>
                       <th scope="col">Inteira</th>
                       <th scope="col">Meia-entrada</th>
                       <th scope="col">Total</th>
                       <th scope="col">Percentual de venda</th>
                     </tr>
                   
                     <tr>
                       <th scope="row">Pista</th>
                       <td>1000</td>
                       <td>750</td>
                       <td>1750</td>
                       <td>25%</td>
                     </tr>
                     <tr>
                       <th scope="row">Pista Premium</th>
                       <td>1735</td>
                       <td>1765</td>
                       <td>3500</td>
                       <td>25%</td>
                     </tr>
                     <tr>
                       <th scope="row">Camarote</th>
                       <td>230</td>
                       <td>105</td>
                       <td>335</td>
                       <td>67%</td>
                     </tr>
                     <tr  class="table-secondary">
                      <th scope="row">Total</th>
                       <td>5585</td>
                       <td>38,5%</td>
                       <td></td>
                       <td></td>
                     </tr>
                  
                 </table>
               </div>
            </div>
         </div>
      </div>
      <br><br>
      
     <!--Rodapé-->
    <footer>
        <div class="container-fluid"  style="background-color: #000033; height: 60px; width: 100%;"></div>
  </footer>
</body>
</html>