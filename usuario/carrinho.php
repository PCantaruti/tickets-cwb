<?php
session_start();
include "../conn.php";
if (isset($_SESSION['login'])) {

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
   <link rel="stylesheet" style="text/css" href="../style.css" />
   <title>Carrinho</title>
</head>

<body>
   <nav>
      <div class="container-fluid menu" style="background-color: #000080;">
         <div class="container text-center" style="background-color: #000080;">
            <div class="row">
               <div class="col-xl-3 col-md-4 col-12">
                  <a class="navbar-brand" href="../index.php?id=<?php echo htmlspecialchars($row_nome['id_usuario']) ?>">
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
         <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
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
   <div class="container-fluid" style="background-color: #fff;">
      <div class="container">
         <div class="row">
            <div class="col-lg-8 col-sm-12">
               <table class="table table-borderless">
                  <thead>
                     <tr class="table-primary">
                        <th scope="col-6">DADOS PESSOAIS</th>
                        <th scope="col-6" class="text-end"><a href="meus_dados.html" class="link-dark link-offset-2">EDITAR</a></th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td colspan="2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                              <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z" />
                           </svg>
                           pamelacantaruti@hotmail.com
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z" />
                           </svg>
                           Pamela Cantaruti
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                              <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511z" />
                           </svg>
                           (41) 99835-1534
                        </td>
                     </tr>
                     <tr>
                        <td colspan="2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-credit-card-2-front" viewBox="0 0 16 16">
                              <path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h12zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2z" />
                              <path d="M2 5.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1zm0 3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                           </svg>
                           11.111.111-11
                        </td>
                     </tr>
                  </tbody>
               </table>
               <br>
               <table class="table table-borderless">
                  <thead>
                     <tr class="table-primary">
                        <th scope="col">PAGAMENTO</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Escolha uma forma de pagamento:</td>
                     </tr>
                     <tr>
                        <td>
                           <div class="accordion" id="pagamento">
                              <div class="accordion-item">
                                 <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#pix" aria-expanded="false" aria-controls="pix">
                                       Pix
                                    </button>
                                 </h2>
                                 <div id="pix" class="accordion-collapse collapse" data-bs-parent="#pagamento">
                                    <div class="accordion-body" style="text-align: center;">
                                       <img src="../img/logo-pix-png-icone-520x520 1.png">
                                       <h6 style="color:#000033">Pagamento via Pix</h6>
                                       <p style="color:#000033">Pagar com o Pix é rápido e prático. O pagamento é instantâneo e confirmado em poucos segundos.</p>
                                       <br>
                                       <img src="../img/qrcode.png" width="250px" height="auto">
                                       <br>
                                       <div class="d-grid gap-2 col-6 mx-auto">
                                          <button class="btn btn-primary" type="button">Copiar código Pix</button>
                                       </div>
                                       <p style="color:#000033">Código válido para pagamento por 3 horas </p>
                                    </div>
                                 </div>
                              </div>
                              <div class="accordion-item">
                                 <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cartao" aria-expanded="false" aria-controls="cartao">
                                       Cartão de Crédito / Débito
                                    </button>
                                 </h2>
                                 <div id="cartao" class="accordion-collapse collapse" data-bs-parent="#pagamento">
                                    <div class="accordion-body">
                                       <form>
                                          <fieldset>
                                             <legend>Dados do Cartão</legend>
                                             <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="ncartao" placeholder="">
                                                <label for="ncatao">Número do Cartão</label>
                                             </div>
                                             <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="nomecartao" placeholder="">
                                                <label for="nomecartao">Nome Impresso no Cartão</label>
                                             </div>
                                             <div class="row mb-3">
                                                <div class="col-sm-6">
                                                   <div class="form-floating mb-3">
                                                      <input type="text" class="form-control" id="datavencimento" placeholder=>
                                                      <label for="datavencimento">Data de Vencimento</label>
                                                   </div>
                                                </div>
                                                <div class="col-sm-6">
                                                   <div class="form-floating mb-3">
                                                      <input type="text" class="form-control" id="CCV" placeholder=Nome>
                                                      <label for="CCV">CCV</label>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="salvarcartao">
                                                <label class="form-check-label" for="salvarcartao">Salvar este cartão para compras futuras</label>
                                             </div>
                                          </fieldset>
                                          <br>
                                          <fieldset>
                                             <legend>Selecione o número de parcelas:</legend>
                                             <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="1parcela">
                                                <label class="form-check-label" for="1parcela">
                                                   R$388,00 1x sem juros
                                                </label>
                                             </div>
                                             <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="2parcela">
                                                <label class="form-check-label" for="2parcela">
                                                   R$194,00 2x sem juros
                                                </label>
                                             </div>
                                             <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="3parcela">
                                                <label class="form-check-label" for="3parcela">
                                                   R$129,33 3x sem juros
                                                </label>
                                             </div>
                                          </fieldset>
                                       </form>
                                    </div>
                                 </div>
                              </div>
                              <div class="accordion-item">
                                 <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#boleto" aria-expanded="false" aria-controls="boleto">
                                       Boleto
                                 </h2>
                                 <div id="boleto" class="accordion-collapse collapse" data-bs-parent="#pagamento">
                                    <div class="accordion-body" style="text-align:center;">
                                       <h6 style="color:#000033">Faça o pagamento do seu boleto para finalizar seu pedido</h6>
                                       <img src="../img/codigo_de_barras.png">
                                       <div class="d-grid gap-2 col-6 mx-auto pt-3">
                                          <button class="btn btn-primary" type="button">Copiar código de barras</button>
                                       </div>
                                       <br>
                                       <p style="color:#000033">Prazo de pagamento de 24 horas</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <br>
                           <a href="compra_finalizada.php"><button class="btn btn-outline-dark">Finalizar Compra</button></a>
                        </td>
                  </tbody>
               </table>
            </div>
            <div class="col-lg-4 col-sm-12">
               <table class="table table-borderless">
                  <thead>
                     <tr class="table-primary">
                        <th colspan="2">RESUMO DO PEDIDO</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Red Hot Chili Peppers - Curitiba</td>
                     </tr>
                     <tr>
                        <td colspan="2">Sexta-feira, 12/01/2024 | 21:01</td>
                     </tr>
                     <tr>
                        <td colspan="2">Estádio Couto Pereira | Rua Ubaldino do Amaral, 37, 80060-195 CURITIBA</td>
                     </tr>
                     <tr>
                        <td>1. Ingresso Pista - Inteira </td>
                        <td>R$225,50</td>
                     </tr>
                     <tr>
                        <td>1. Ingresso Pista - Meia-entrada </td>
                        <td>R$112,50</td>
                     </tr>
                  </tbody>
               </table>
               <br>
               <table class="table table-borderless">
                  <thead>
                     <tr class="table-primary">
                        <th colspan="2">RESUMO DA COMPRA</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Subtotal</td>
                        <td>R$338,00</td>
                     </tr>
                     <tr>
                        <td>Taxa Adm</td>
                        <td>R$50,00</td>
                     </tr>
                     <tr class="table-secondary">
                        <td>TOTAL</td>
                        <td>R$388,00</td>
                     </tr>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <footer>
      <div class="container-fluid">
         <div class="container">
            <div class="row">
               <div class="pt-4 col-md-12">
                  <ul>
                     <li class="list-group-item">
                        <a href="../Pi_1/atendimento.php">
                           <p>Atendimento ao Cliente</p>
                        </a>
                     </li>
                     <li class="list-group-item">
                        <a href="../Pi_1/formpagamento.php">
                           <p>Formas de Pagamento</p>
                        </a>
                     </li>
                     <li class="list-group-item">
                        <a href="../Pi_1/meiaentrada.php">
                           <p>Meia-entrada</p>
                        </a>
                     </li>
                     <li class="list-group-item">
                        <a href="../PI/login_organizador.php">
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