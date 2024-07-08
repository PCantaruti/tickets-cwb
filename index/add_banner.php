<?php
include "../conn.php";
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
</head>
<?php
if (isset($_GET['id_evento'])) {
   $id_evento = $_GET['id_evento'];
   $cons_evento = $conn->prepare('SELECT * FROM eventos WHERE id_evento=:id');
   $cons_evento->bindValue(':id', $id_evento);
   $cons_evento->execute();
   if ($cons_evento->rowCount() == 0) {
      echo "Evento não encontrado.";
      exit;
   } else {
      $row_evento = $cons_evento->fetch();
   }
} else {
   echo "ID do evento não especificado na URL.";
   exit;
}

if (isset($_POST['upload'])) {
   $pasta = "arquivos/";
   $tamanho = 1024 * 1024 * 2; // 2MB
   $extensoes = array('jpg', 'jpeg', 'png');
   $renomear = true;

   $titulo = $_POST['titulo'];

   // Verificar se um arquivo foi selecionado
   if (!isset($_FILES['arquivo']) || !is_uploaded_file($_FILES['arquivo']['tmp_name'])) {
      echo "Por favor, selecione um arquivo.";
      exit;
   }

   // Verificar a extensão do arquivo
   $extensao = strtolower(pathinfo($_FILES['arquivo']['name'], PATHINFO_EXTENSION));
   if (!in_array($extensao, $extensoes)) {
      echo "Extensão não permitida. Por favor, envie um arquivo JPG, JPEG ou PNG.";
      exit;
   }

   // Verificar o tamanho do arquivo
   if ($_FILES['arquivo']['size'] > $tamanho) {
?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
         <strong>Arquivo muito grande.</strong> Tamanho máximo permitido é de 2MB.
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>

<?php
      exit;
   }

   // Gerar nome final do arquivo
   if ($renomear) {
      $nome_final = md5(time() . $_FILES['arquivo']['name']) . ".$extensao";
   } else {
      $nome_final = $_FILES['arquivo']['name'];
   }

   // Caminho completo do arquivo
   $caminho = $pasta . $nome_final;

   // Mover o arquivo para o diretório de destino
   if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho)) {
      $url = $caminho;
      $grava = $conn->prepare('INSERT INTO arquivos (id_arquivo, id_evento, nm_titulo, ds_url) VALUES (NULL, :id_evento, :titulo, :url)');
      $grava->bindValue(":titulo", $titulo);
      $grava->bindValue(":url", $url);
      $grava->bindValue(":id_evento", $id_evento);
      $grava->execute();
      header("Location: ../organizador/home_organizador.php");
   } else {
      echo "Erro ao mover o arquivo para o diretório.";
   }
}
?>
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
            <div class="col-lg-4 col-md-12 col-sm-12">
               <form action="add_banner.php?id_evento=<?php echo $id_evento; ?>" method="POST" enctype="multipart/form-data">
                  <fieldset>
                     <div id="formulario">
                        <legend>
                           <h2>Banner</h2>
                        </legend>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col">
                                 <label for="titulo" class="form-label">Título da Imagem:</label>
                                 <input type="text" class="form-control" id="titulo" name="titulo" required>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="col">
                              <label for="arquivo" class="form-label">Escolha um arquivo:</label>
                              <input type="file" class="form-control" id="arquivo" name="arquivo" required>
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
                                          <button name="upload" type="submit" class="btn btn-success">Sim</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </fieldset>
               </form>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
               <h2>Resumo do Evento</h2>
               <table class="table table-borderless" id="dados">
                  <tr>
                     <td><?php echo $row_evento['nm_evento'] ?></td>
                  </tr>
                  <tr>
                     <td><?php echo $row_evento['nm_estabelecimento'] . "  |  " . $row_evento['nm_rua'] . ", " . $row_evento['ds_numero'] . ", " . $row_evento['nm_bairro'] . " - " . $row_evento['nm_cidade'] . " - " . $row_evento['nm_estado'] . " - " . $row_evento['nr_cep'] . " " . $row_evento['ds_complemento'] ?></td>
                  </tr>
                  <tr>
                     <td>Data do evento: <?php echo $row_evento['dt_evento'] ?></td>
                  </tr>
                  <tr>
                     <td><?php echo $row_evento['ds_evento'] ?></td>
                  </tr>
               </table>

            </div>
         </div>
      </div>
   </div>
   </div>
   </div>
   <br><br><br><br>
</body>

</html>