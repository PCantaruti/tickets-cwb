<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TICKETS CWB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <!--Menu-->
    <nav>
        <div class="container-fluid menu" style="background-color: #000080;">
           <div class="container text-center" style="background-color: #000080;">
              <div class="row">
                 <div class=" col-xl-3 col-md-4 col-12">
                    <a class="navbar-brand" href="../index.php">
                       <img src="Logo.png" height="60" width="auto">
                    </a>
                 </div>
                 <div class="pt-3 col-xl-6 col-md-4 col-12">
                    <div class="container-fluid">
                       <div class="input-group mb-3">
                          <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Recipient's username" for="pesquisar">  
                             <button class="btn btn-light menu" type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                   <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                             </button>
                       </div>
                    </div>
                 </div>
                 <div class="pt-3 col-xl-3 col-md-4 col-12">
                    <a href="../PI/login.html">
                       <svg xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-center" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" color="#F5F5F5">
                          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                       </svg>
                    <p style="color: #f5f5f5; display: inline-flex;">Entre ou Cadastre-se</p>
                    </a>
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
      </div>
 <!--Voltar-->
 <section>
   <br/>
   <div class="bx3">
      <a href="../index.html">
      <svg xmlns="http://www.w3.org/2000/svg" width="30" height="32" fill="currentColor" class="VOLTAR" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" /> 
       </svg>
        <h8><b>Voltar</b></h8>
      </a>
   </div>
</section>

<!--Titulo-->
<div class="container-fluid menu">
   <div class="container">
       <div class="row">
           <div class="col-xl-6 col-md6 col-sm-12">
               <h1>Enviar  uma solicitação</h1>
               <br/>
               <h4>Formulário de contato Tickets cwb</h4>
           </div>
       </div>         
   </div>
</div><br/><br/>

<!--Formulario-->
<form>
   <div class="container-fluid menu">
       <div class="container">
          <div class="row">
             <div class=" col-xl-6 col-md-4 col-12">
               <div class="mb-3">
                   <label for="exampleFormControlInput1" class="form-label"><h5>Endereço de e-mail</h5></label>
                   <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail">
                 </div><br/><br/>

                 <div class="mb-3">
                   <label for="exampleFormControlInput1" class="form-label"><h5>Qual é o evento?</h5></label>
                   <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Evento">
                   <p>Isso nos ajuda a direcionar sua mensagem para o atendente mais adequado</p>
                 </div><br/><br/>

                 <div class="mb-3">
                   <label for="exampleFormControlInput1" class="form-label"><h5>Nome completo</h5></label>
                   <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Nome">
                   <p>Isso nos ajuda a localizar seu cadastro</p>
                 </div><br/><br/>


                 <div class="mb-3">
                   <label for="exampleFormControlInput1" class="form-label"><h5>E-mail cadastrado no site</h5></label>
                   <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail do site">
                   <p>Isso nos ajuda a localizar seu cadastro</p>
                 </div><br/><br/>

                 <div class="mb-3">
                   <label for="exampleFormControlInput1" class="form-label"><h5>CPF</h5></label>
                   <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="CPF">
                   <p>Isso nos ajuda a localizar seu cadastro</p>
                 </div><br/><br/>

                 <div class="mb-3">
                   <label for="exampleFormControlInput1" class="form-label"><h5>Qual é o assunto da sua solicitação?</h5></label>
                   <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Assunto">
                 </div><br/><br/>

                 <div class="mb-3">
                   <label for="exampleFormControlTextarea1" class="form-label"><h5>Descreva sua solicitação</h5></label>
                   <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                   <p>Caso esteja com alguma dificuldade, por favor explique em qual etapa você não consegue prosseguir e se aparece alguma mensagem de erro.</p>
                 </div><br/><br/>
                 <div class="mb-3">
                   <h5>Motivo do contato</h5>
                   <select class="form-select" aria-label="Default select example" style="background-color: #e2e3e5;">
                       <option selected><h1>_</h1></option>
                       <option value="1"><p><b>1. Cancelar minha compra</b></p></option>
                       <option value="2"><p><b>2. Cadastro e senha</b></p></option>
                       <option value="3"><p><b>3. Meia-entrada</b></p></option>
                       <option value="4"><p><b>4. Ingressos esgotados</b></p></option>
                       <option value="5"><p><b>5. Outros assuntos</b></p></option>
                     </select><br/><br/><br/>
                 </div>
             </div>
          </div>
       </div>
   </div>
</form><br/><br/><br/>

<!--Botão-->
<div class="container">
   <a href="#">
       <div class="btn-group" role="group" aria-label="Basic example">
           <button type="button" class="btnf"><b>ENVIAR</b></button>
       </div>
   </a>    
</div><br/><br/><br/>

<!--Rodapé-->
<section style="background-color: #000080; width: 100%; height: auto;">
   <div class="container-fluid">
      <div class="container">
         <div class="row">
            <div class="pt-4 col-md-12">
               <ul>
                  <li class="list-group-item">
                     <a href="atendimento.html">
                        <p style="color: #f5f5f5;">Atendimento ao Cliente</p>
                     </a>
                  </li>
                  <li class="list-group-item">
                     <a href="formpagamento.html">
                        <p style="color: #f5f5f5;">Formas de Pagamento</p>
                     </a>
                  </li>
                  <li class="list-group-item">
                     <a href="meiaentrada.html">
                        <p style="color: #f5f5f5;">Meia-entrada</p>
                     </a>
                  </li>
                  <li class="list-group-item">
                     <a href="../PI/login_organizador.html">
                        <p style="color: #f5f5f5;">Venda na Tickets CWB</p>
                     </a>
                  </li>
               </ul>
            </div>
         </div>
      </div>
   </div>
   <div class="container-fluid"  style="background-color: #000033; height: 60px; width: 100%;"></div>
</section>
</body>
</html>