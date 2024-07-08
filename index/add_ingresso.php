<?php
include "../conn.php";

// Verifica se o id_evento foi passado via URL
if (isset($_GET['id_evento'])) {
    $id_evento = $_GET['id_evento'];

    // Verifica se o formulário foi submetido
    if (isset($_POST['salva'])) {
        // Captura os dados do formulário para ingressos
        $dt_liberacao = $_POST['dt_liberacao'];
        $dt_encerramento = $_POST['dt_encerramento'];
        $tipo_ingresso = $_POST['tipo_ingresso'];
        $valor = $_POST['valor'];
        $quantidade = $_POST['quantidade'];
        $valor_meia = $_POST['valor_meia'];
        $quant_meia = $_POST['quant_meia'];

        // Prepara e executa a consulta para salvar os ingressos
        $salva = $conn->prepare('INSERT INTO ingressos (dt_liberacao, dt_encerramento, ds_tipo, vl_ingresso, qt_ingresso, vl_meia, qt_meia, id_evento) VALUES (:dt_liberacao, :dt_encerramento, :tipo_ingresso, :valor, :quantidade, :valor_meia, :quant_meia, :id_evento)');
        $salva->bindValue(':dt_liberacao', $dt_liberacao);
        $salva->bindValue(':dt_encerramento', $dt_encerramento);
        $salva->bindValue(':tipo_ingresso', $tipo_ingresso);
        $salva->bindValue(':valor', $valor);
        $salva->bindValue(':quantidade', $quantidade);
        $salva->bindValue(':valor_meia', $valor_meia);
        $salva->bindValue(':quant_meia', $quant_meia);
        $salva->bindValue(':id_evento', $id_evento);

        if ($salva->execute()) {
            // Redireciona para add_banner.php com id_evento na URL
            header("Location: add_banner.php?id_evento=$id_evento");
            exit;
        } else {
            echo "Erro ao salvar o ingresso: " . $salva->error;
        }
    }
} else {
    echo "ID do evento não encontrado.";
}
include "../organizador/restrito_organizador.php";
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
      function atualizarMeiaEntrada() {
         // Obtém o valor do campo da entrada inteira
         const valorInteiraInput = document.getElementById("valor1");
         const valorInteira = valorInteiraInput.value.replace(/[^\d,]/g, '').replace(',', '.');

         // Calcula o valor da meia entrada
         const valorMeia = (parseFloat(valorInteira) / 2).toFixed(2);

         // Atualiza o campo da meia entrada
         const valorMeiaInput = document.getElementById("valor_meia1");
         if (!isNaN(valorMeia)) {
            valorMeiaInput.value = valorMeia.replace('.', ',');
         }
      }
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

            <form action="add_ingresso.php?id_evento=<?php echo $id_evento; ?>" method="POST">

               <div class="col-lg-6 col-md-12 col-sm-12">
                  <fieldset>
                     <div id="formulario">
                        <legend>Ingressos</legend>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col-6">
                                 <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">

                                 <label for="dt_liberacao" class="form-label">Data de liberação de venda:</label>
                                 <input name="dt_liberacao" type="date" class="form-control" id="dt_liberacao">
                              </div>
                              <div class="col-6">
                                 <label for="dt_encerramento" class="form-label">Data de encerramento de venda:</label>
                                 <input name="dt_encerramento" type="date" class="form-control" id="dt_encerramento">
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col">
                                 <label for="tipo_ingresso" class="form-label">*Tipo do ingresso:</label>
                                 <input name="tipo_ingresso" type="text" class="form-control" placeholder="Pista/Premium/Arquibancada" id="tipo_ingresso">
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-12">
                                 <label for="valor1" class="form-label">*Valor (Inteira):</label>
                                 <input name="valor" type="text" class="form-control" placeholder="00,00" id="valor1" oninput="atualizarMeiaEntrada()">
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12">
                                 <label for="quant1" class="form-label">*Quantidade:</label>
                                 <input name="quantidade" type="text" class="form-control" id="quant1">
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-12">
                                 <label for="valor_meia1" class="form-label">Valor (Meia-Entrada):</label>
                                 <input name="valor_meia" type="text" class="form-control" placeholder="00,00" id="valor_meia1" readonly>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-12">
                                 <label for="quant_meia1" class="form-label">Quantidade (Meia-Entrada)</label>
                                 <input type="text" class="form-control" id="quant_meia1" name="quant_meia">
                                 <div class="form-text" id="basic-addon4">Minimo 40% do total</div>
                              </div>
                           </div>
                        </div><br>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col">
                                 <button class="btn btn-outline-dark btn-sm" type="button" onclick="adicionarCampo()">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="auto" fill="currentColor" class="bi bi-plus img-fluid" viewBox="0 0 16 16">
                                       <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                    </svg>
                                    Adicionar
                                 </button>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col">
                                 <div class="d-grid gap-2 col-6 mx-auto">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                       Gravar
                                    </button>
                                 </div>
                                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                             Deseja realmente salvar?
                                          </div>
                                          <div class="modal-footer">
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                             <button name="salva" type="submit" class="btn btn-success">Sim</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </fieldset>
               </div>
               <script src="js/custom.js"></script>
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