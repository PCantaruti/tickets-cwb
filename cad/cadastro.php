<?php
include "../conn.php";
if(isset($_POST['grava'])){
  $email=$_POST['email'];
  $senha=md5($_POST['senha']);
  $nome=$_POST['nome'];
  $datanasc=$_POST['datanasc'];
  $cpf=$_POST['cpf'];
  $telefone=$_POST['telefone'];
  $cep=$_POST['cep'];
  $estado=$_POST['estado'];
  $cidade=$_POST['cidade'];
  $bairro=$_POST['bairro'];
  $rua=$_POST['rua'];
  $numero=$_POST['numero'];
  $grava=$conn->prepare('INSERT INTO `usuarios` (`id_usuario`, `nm_usuario`, `ds_email`, `ds_senha`, `dt_nascimento`, `nr_telefone`,
   `nr_cpf`, `nr_cep`, `nm_estado`, `nm_cidade`, `nm_bairro`, `nm_rua`, `ds_numero`) 
   VALUES (NULL, :nome, :email, :senha, :datanasc, :telefone, :cpf, :cep, :estado, :cidade, :bairro, :rua, :numero);');
  $grava->bindValue(':email' , $email);
  $grava->bindValue(':senha' , $senha);
  $grava->bindValue(':nome' , $nome);
  $grava->bindValue(':datanasc' , $datanasc);
  $grava->bindValue(':cpf' , $cpf);
  $grava->bindValue(':telefone' , $telefone);
  $grava->bindValue(':cep' , $cep);
  $grava->bindValue(':estado' , $estado);
  $grava->bindValue(':cidade' , $cidade);
  $grava->bindValue(':bairro' , $bairro);
  $grava->bindValue(':rua' , $rua);
  $grava->bindValue(':numero' , $numero);
  $grava->execute();
  header("Location: login.php");
}
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style_1.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
   integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
   crossorigin="anonymous"></script>
   <script>

      $(document).ready(function() {

          function limpa_formulário_cep() {
              // Limpa valores do formulário de cep.
              $("#rua").val("");
              $("#bairro").val("");
              $("#cidade").val("");
              $("#uf").val("");
              $("#ibge").val("");
          }
          
          //Quando o campo cep perde o foco.
          $("#cep").blur(function() {

              //Nova variável "cep" somente com dígitos.
              var cep = $(this).val().replace(/\D/g, '');

              //Verifica se campo cep possui valor informado.
              if (cep != "") {

                  //Expressão regular para validar o CEP.
                  var validacep = /^[0-9]{8}$/;

                  //Valida o formato do CEP.
                  if(validacep.test(cep)) {

                      //Preenche os campos com "..." enquanto consulta webservice.
                      $("#rua").val("...");
                      $("#bairro").val("...");
                      $("#cidade").val("...");
                      $("#uf").val("...");
                      $("#ibge").val("...");

                      //Consulta o webservice viacep.com.br/
                      $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                          if (!("erro" in dados)) {
                              //Atualiza os campos com os valores da consulta.
                              $("#rua").val(dados.logradouro);
                              $("#bairro").val(dados.bairro);
                              $("#cidade").val(dados.localidade);
                              $("#uf").val(dados.uf);
                              $("#ibge").val(dados.ibge);
                          } //end if.
                          else {
                              //CEP pesquisado não foi encontrado.
                              limpa_formulário_cep();
                              alert("CEP não encontrado.");
                          }
                      });
                  } //end if.
                  else {
                      //cep é inválido.
                      limpa_formulário_cep();
                      alert("Formato de CEP inválido.");
                  }
              } //end if.
              else {
                  //cep sem valor, limpa formulário.
                  limpa_formulário_cep();
              }
          });
      });

  </script>
</head>
<body>
    <div class="container-fluid menu" style="background-color: #000080;">
        <div class="container text-center">
           <div class="row">
              <div class=" col-xl-3 col-md-4 col-12 pb-2">
                 <a class="navbar-brand" href="../index.php">
                    <img src="../img/Group 49.png" height="60" width="auto">
                 </a>
              </div>
           </div>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
   <br>
   <br>  
    <div class="row">
      <div class="col"></div> 
      <div class="col-6" style="border-width: 2px; border-style: solid; border-color: #E0E6EB; border-radius: 10px; background-color: #fff;">
        <form action="cadastro.php" method="POST">
          <h2 style="display:flex;" >Cadastre-se</h2><br>
          <div class="form-floating mb-3">
            <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating mb-3">
            <input type="password" name="senha" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Senha</label>
          </div>

          <br>
          <h5 style="display: flex;" >Dados pessoais</h5><br>
          <div class="form-floating mb-3">
            <input type="text" name="nome" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Nome completo</label>
          </div>
          <div class="form-floating mb-3">
            <input type="date" name="datanasc" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Data de nascimento</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="cpf" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">CPF</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="telefone" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Telefone</label><br><br>
          </div>
      
          <h5 style="display: flex;" >Endereço</h5><br>
          <div class="form-floating mb-3">
            <input type="text" name="cep" class="form-control" id="cep" placeholder="name@example.com">
            <label for="cep">CEP</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name ="estado" class="form-control" id="uf" placeholder="name@example.com">
            <label for="uf">Estado</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="cidade" class="form-control" id="cidade" placeholder="name@example.com">
            <label for="cidade">Cidade</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="bairro" class="form-control" id="bairro" placeholder="name@example.com">
            <label for="bairro">Bairro</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="rua" class="form-control" id="rua" placeholder="name@example.com">
            <label for="rua">Rua</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" name="numero" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Numero</label>
          </div>
          <div class="d-grid gap-2 d-md-block">
            <button name="grava"  type="submit" class="btn btn-primary btn-lg"
              style="margin-top: 10%; margin-left: 28%; display: block; overflow: hidden; align-items: center;">
              Efetuar cadastro
            </button>
          </div>
        </form>
      </div>
      <div class="col"></div> 
    </div>
    <br><br><br>
</body>
</html>



