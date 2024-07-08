<!DOCTYPE html>
<html lang="-pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Tickets CWB</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="style.css"/>
    </head>
<body>
    <div class="container-fluid" style="background-color: blue;">
        <h2>tickets cwb</h2>
        <input class="form-control" type="text" placeholder="Pesquisar" aria-label="pesquisar">
    </div>    
    <h1>Cadastre sua organização</h1>
    <form class="row g-3 needs-validation" novalidate>
        <div class="col-md-4">
          <label for="validationCustom01" class="form-label">Escolha uma URL para sua organização</label>
          <input type="text" class="form-control" id="validationCustom01" value="URL" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationCustom02" class="form-label">Nome:</label>
          <input type="text" class="form-control" id="validationCustom02" value="Tickets CWB" required>
          <div class="valid-feedback">
            Looks good!
          </div>
        </div>
        <div class="col-md-4">
          <label for="validationCustomUsername" class="form-label">Nome de usuário:</label>
          <div class="input-group has-validation">
            <span class="input-group-text" id="inputGroupPrepend">@</span>
            <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
            <div class="invalid-feedback">
              Please choose a username.
            </div>
          </div>
        </div>
        <div class="col-md-6">
            <label for="validationCustom03" class="form-label">CNPJ:</label>
          <input type="text" class="form-control" id="validationCustom03" required>
          <div class="invalid-feedback">
            Please provide a valid city.
          </div>
        </div>
        <div class="col-md-3">
          <label for="validationCustom04" class="form-label">Estado:</label>
          <select class="form-select" id="validationCustom04" required>
            <option selected disabled value="">Escolher</option>
            <option>...</option>
          </select>
          <div class="invalid-feedback">
            Please select a valid state.
          </div>
        </div>
        <div class="col-md-3">
          <label for="validationCustom05" class="form-label">Telefone:</label>
          <input type="text" class="form-control" id="validationCustom05" required>
          <div class="invalid-feedback">
            Please provide a valid zip.
          </div>
        </div>
        <div class="col-12">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Concorde com os termos e condições
            </label>
            <div class="invalid-feedback">
                Concorde com os termos e condições
            </div>
          </div>
        </div>
        <div class="col-12">
          <button class="btn btn-primary" type="submit">Enviar formulário</button>
        </div>
      </form>
    </br>
      <footer>
        <div class="container-fluid" style="background-color: rgb(0, 0, 112);">
           <div class="container">
              <div class="row">
                 <div class="pt-4 col-md-12">
                    <ul>
                       <li class="list-group-item">
                          <a href="#">
                             <p>Atendimento ao Cliente</p>
                          </a>
                       </li>
                       <li class="list-group-item">
                          <a href="#">
                             <p>Formas de Pagamento</p>
                          </a>
                       </li>
                       <li class="list-group-item">
                          <a href="#">
                             <p>Meia-entrada</p>
                          </a>
                       </li>
                       <li class="list-group-item">
                          <a href="#">
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