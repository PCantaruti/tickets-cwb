<?php
session_start(); //Iniciar a sessao
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Tickets CWB</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../style.css"/>
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







    <h1>Editar Usuários</h1>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <form method="POST" action="processa.php">

        <div id="formulario">
            <input type="hidden" name="qnt_campo" id="qnt_campo" />
            <div class="form-group">
                <span id="msgAlerta1"></span>
                <label class="form-label"> CPF: </label>
                <input class="form-control"  type="text" name="cpf1" id="cpf1"/>        

            

               
                <label class="form-label">Nome: </label>
                <input class="form-control" type="text" name="nome1" id="nome1" placeholder="Nome do usuário" />

                <label class="form-label">E-mail: </label>
                <input class="form-control" type="text" name="email1" id="email1" placeholder="E-mail do usuário" />
                
                <input class="form-control" type="hidden" name="id1" id="id1" />

                <button type="button" onclick="adicionarCampo()"> + </button>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" value="Salvar" name="EditUsuario">
        </div>

    </form>

    <script src="js/custom.js"></script>
</body>

</html>