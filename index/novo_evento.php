<?php
include "../conn.php";
include "../organizador/restrito_organizador.php";
?>
<?php
if (isset($_POST['salva'])) {
  $id = $_POST['id'];
  $nome = $_POST['nome'];
  $data = $_POST['data'] . ' ' . $_POST['hora'];
  $sobre = $_POST['sobre'];
  $nome_local = $_POST['nome_local'];
  $cep = $_POST['cep'];
  $estado = $_POST['estado'];
  $cidade = $_POST['cidade'];
  $bairro = $_POST['bairro'];
  $endereco = $_POST['endereco'];
  $numero = $_POST['numero'];
  $complemento = $_POST['complemento'];
  $salva = $conn->prepare('INSERT INTO `eventos` (`id_evento`, `nm_evento`, `dt_evento`, `ds_evento`, `nr_cep`, `nm_rua`, `ds_numero`, `nm_cidade`, `nm_bairro`, `nm_estado`, `nm_estabelecimento`, `ds_complemento`, `id_organizador`, `ds_status_evt`) VALUES (NULL, :nome, :data, :sobre, :cep, :endereco, :numero, :cidade, :bairro, :estado, :nome_local, :complemento, :id, 1);');
  $salva->bindValue(':id', $id);
  $salva->bindValue(':nome', $nome);
  $salva->bindValue(':data', $data);
  $salva->bindValue(':sobre', $sobre);
  $salva->bindValue(':nome_local', $nome_local);
  $salva->bindValue(':cep', $cep);
  $salva->bindValue(':estado', $estado);
  $salva->bindValue(':cidade', $cidade);
  $salva->bindValue(':bairro', $bairro);
  $salva->bindValue(':endereco', $endereco);
  $salva->bindValue(':numero', $numero);
  $salva->bindValue(':complemento', $complemento);
  $salva->execute();

  // Recupera o ID do evento inserido
  $id_evento = $conn->lastInsertId();

  // Redireciona para add_ingresso.php com o id_evento na URL
  header("Location: add_ingresso.php?id_evento=$id_evento");
}
?>
<!DOCTYPE html>
<html lang="-pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tickets CWB</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../style.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
          if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#rua").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#uf").val("...");
            $("#ibge").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

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
  <nav>
    <div class="container-fluid menu" style="background-color: #000080;">
      <div class="container text-center" style="background-color: #000080;">
        <div class="row">
          <div class=" col-xl-3 col-md-4 col-12">
            <a class="navbar-brand" href="../organizador/home_organizador.php">
              <img src="../img/Group 49.png" height="60" width="auto">
            </a>
          </div>
          <div class="pt-3 col-xl-6 col-md-4 col-12">
            <div class="container-fluid">
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar" aria-label="Recipient's username" for="pesquisar">
                <button class="btn btn-light" type="submit">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
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
              <li><a class="dropdown-item" href="../organizador/minha_conta_org.php">Minha Conta</a></li>
              <li><a class="dropdown-item" href="../organizador/log_org.php">Sair</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
  </nav>
  <br>


  <div class="container-fluid">
    <div class="container">
      <div class="row">


        <form action="novo_evento.php" method="POST">
          <div class="col-lg-6 col-md-12 col-sm-12">
            <fieldset>
              <legend>Cadastre seu evento aqui</legend>
              <div class="mb-3">
                <div class="row">
                  <div class="col col-md-12">
                    <input type="hidden" name="id" value="<?php echo $row_nome['id_organizador']; ?>" />
                    <label for="nome" class="form-label">Nome do Evento:</label>
                    <input name="nome" type="text" class="form-control" id="nome">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-lg-6 col-sm-12">
                    <label for="data" class="form-label">Data:</label>
                    <input name="data" type="date" class="form-control" id="data">
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <label for="hora" class="form-label">Hora:</label>
                    <input name="hora" type="text" class="form-control" id="hora">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="sobre" class="form-label">Sobre o evento:</label>
                    <textarea name="sobre" id="sobre" class="form-control" aria-label="With textarea"></textarea>
                  </div>
                </div>
              </div>
              <legend>Endereço:</legend>
              <div class="mb-3">
                <div class="row">
                  <div class="col-lg-8 col-sm-12">
                    <label for="nome_local" class="form-label">Nome do Estabelecimento:</label>
                    <input name="nome_local" type="text" class="form-control" id="nome_local">
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <label for="cep" class="form-label">CEP:</label>
                    <input name="cep" type="text" class="form-control" id="cep" size="10">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-lg-8 col-sm-12">
                    <label for="endereco" class="form-label">Endereço:</label>
                    <input name="endereco" type="text" class="form-control" id="endereco">
                  </div>
                  <div class="col-lg-4 col-sm-12">
                    <label for="numero" class="form-label">Número:</label>
                    <input name="numero" type="text" class="form-control" id="numero">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <label for="bairro" class="form-label">Bairro:</label>
                    <input name="bairro" type="text" class="form-control" id="bairro">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <label for="cidade" class="form-label">Cidade:</label>
                    <input name="cidade" type="text" class="form-control" id="cidade">
                  </div>
                  <div class="col-lg-4 col-md-6 col-sm-12">
                    <label for="estado" class="form-label">Estado:</label>
                    <input name="estado" type="text" class="form-control" id="uf">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input name="complemento" type="text" class="form-control" id="complemento">
                  </div>
                </div>
              </div>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal">
                Salvar evento
              </button>

              <!-- Modal -->
              <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Deseja realmente salvar este evento?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                      <button name ="salva" type="submit" class="btn btn-success">Sim</button>
                    </div>
                  </div>
                </div>
              </div>

            </fieldset>
          </div>
        </form>
      </div>
    </div>
  </div>
  <br><br><br><br>
  
  <footer>
    <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
  </footer>
</body>

</html>