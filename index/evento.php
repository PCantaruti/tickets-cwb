<?php
include "../conn.php";

if (isset($_GET['exclusao'])) {
   $id_evento = $_GET['id'];
   $excluir = $conn->prepare("UPDATE `eventos` SET `ds_status_evt` = '0' WHERE `eventos`.`id_evento` = :id_evento;");
   $excluir->bindValue(":id_evento", $id_evento);
   $excluir->execute();
   header("Location: ../organizador/home_organizador.php");
   exit();
}

$id_evento = $_GET['id'];

$info = $conn->prepare("SELECT e.nm_evento, e.dt_evento, e.ds_evento, e.nr_cep, e.nm_rua, e.ds_numero, e.nm_cidade, e.nm_bairro, e.nm_estado, e.nm_estabelecimento, e.ds_complemento, e.ds_status_evt, e.id_organizador, a.nm_titulo, a.ds_url FROM eventos e JOIN arquivos a ON e.id_evento = a.id_evento WHERE e.id_evento = :id_evento");
$info->bindValue(':id_evento', $id_evento);
$info->execute();
$result = $info->fetch();

if (isset($_POST['salvar'])) {
   $id_evento = $_POST['id_evento'];
   $evento = $_POST['evento'];
   $estabelecimento = $_POST['estabelecimento'];
   $cep = $_POST['cep'];
   $estado = $_POST['estado'];
   $cidade = $_POST['cidade'];
   $bairro = $_POST['bairro'];
   $rua = $_POST['rua'];
   $numero = $_POST['numero'];
   $complemento = $_POST['complemento'];
   $data = $_POST['data'] . ' ' . $_POST['hora'];
   $sobre = $_POST['sobre'];

   // Verifica se um novo arquivo foi enviado
   if ($_FILES['arquivo']['error'] == UPLOAD_ERR_OK) {
      $uploadDir = 'arquivos/';
      $uploadFile = $uploadDir . basename($_FILES['arquivo']['name']);
      if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadFile)) {
         $bannerUrl = $uploadFile;
      } else {
         echo "Falha ao carregar a imagem.";
         exit;
      }
   } else {
      $bannerUrl = $result['ds_url'];
   }

   // Atualiza evento
   $alt = $conn->prepare("UPDATE eventos SET 
           nm_evento = :evento, 
           dt_evento = :data, 
           ds_evento = :sobre, 
           nr_cep = :cep, 
           nm_rua = :rua, 
           ds_numero = :numero, 
           nm_cidade = :cidade, 
           nm_bairro = :bairro, 
           nm_estado = :estado, 
           nm_estabelecimento = :estabelecimento, 
           ds_complemento = :complemento
           WHERE id_evento = :id_evento");
   $alt->bindValue(":evento", $evento);
   $alt->bindValue(":estabelecimento", $estabelecimento);
   $alt->bindValue(':cep', $cep);
   $alt->bindValue(':estado', $estado);
   $alt->bindValue(':cidade', $cidade);
   $alt->bindValue(':bairro', $bairro);
   $alt->bindValue(':rua', $rua);
   $alt->bindValue(':numero', $numero);
   $alt->bindValue(':complemento', $complemento);
   $alt->bindValue(':data', $data);
   $alt->bindValue(':sobre', $sobre);
   $alt->bindValue(":id_evento", $id_evento);
   $alt->execute();

   // Atualiza o URL do banner
   $updBanner = $conn->prepare("UPDATE arquivos SET ds_url = :banner WHERE id_evento = :id_evento");
   $updBanner->bindValue(":banner", $bannerUrl);
   $updBanner->bindValue(":id_evento", $id_evento);
   $updBanner->execute();

   header("Location: evento.php?id=$id_evento");
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
                     <li><a class="dropdown-item" href="../organizador/minha_conta_org.html">Minha Conta</a></li>
                     <li><a class="dropdown-item" href="../index.html">Sair</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
   </nav>
   <div class="container-fluid">
      <div class="container">
         <div class="row">
            <div class="col-4">
               <br>
               <img src="<?php echo ($result['ds_url']); ?>" class="rounded mx-auto d-block" alt="<?php echo ($resultado['nm_titulo']); ?>" style="width: 18rem;">
            </div>
            <div class="col pt-5">
               <h2><?php echo $result['nm_evento']; ?> </h2>
               <table class="table table-borderless" id="dados">
                  <tr>
                     <td><?php echo $result['nm_estabelecimento'] . ' | ' . $result['nm_rua'] . ', ' . $result['ds_numero'] . ', ' . $result['nr_cep'] . ' ' . $result['nm_cidade']; ?></td>
                     <td>
                  </tr>
                  <tr>
                     <td>
                        <?php setlocale(LC_TIME, 'pt_BR.utf8', 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                        $timestamp = strtotime($result['dt_evento']);
                        echo strftime('%A, %d/%m/%Y | %H:%M', $timestamp);
                        ?>
                     </td>
                  </tr>
                  <tr>
                     <td><?php echo $result['ds_evento']; ?></td>
                  </tr>
                  <tr>
                     <td>
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#editar" aria-expanded="true" aria-controls="flush-collapseThree">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="auto" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                           </svg> Editar
                        </button>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <a href="#" class="link-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                           </svg>
                           Excluir
                        </a>
                     </td>
                  </tr>
               </table>
            </div>

         </div>
      </div>
   </div>
   <div class="container-fluid">
      <div class="container">
         <div class="row">
            <div class="col pt-5">
                       <!-- Modal de exclusão -->
               <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           Tem certeza que deseja excluir?
                        </div>
                        <div class="modal-footer">
                           <!-- Link de confirmação da exclusão -->
                           <a href="evento.php?exclusao&id=<?php echo $id_evento; ?>" class="btn btn-primary">Sim</a>
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div id="editar" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
               <div class="accordion-body">
                  <br>
                  <p style="color: #C71818">**Alteração permitida com até 72 horas de antecedência do evento**</p>
                  <br>
                  <p style="color: #C71818">**Toda alteração será notificada aos consumidores via e-mail**</p>
                  <br> <br>
                  <form action="evento.php?id=<?php echo $id_evento ?>" method="POST" enctype="multipart/form-data">
                     <fieldset>
                        <div class="mb-3">
                           <div class="row">
                              <input type="hidden" name="id_evento" value="<?php echo $id_evento; ?>">
                              <div class="col-lg-7 col-md-7 col-sm-12">
                                 <div class="form-floating mb-3">
                                    <input name="evento" type="text" class="form-control" id="evento" value="RED HOT CHILI PEPPERS">
                                    <label for="evento">EVENTO</label>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="estabelecimento" type="text" class="form-control" id="estabelecimento" value="<?php echo ($result['nm_estabelecimento']); ?>">
                                       <label for="estabelecimento">Nome do Estabelecimento:</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="cep" type="text" class="form-control" id="cep" value="<?php echo ($result['nr_cep']); ?>">
                                       <label for="cep">CEP:</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="rua" type="text" class="form-control" id="rua" value="<?php echo ($result['nm_rua']); ?>">
                                       <label for="rua">Endereço:</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="numero" type="text" class="form-control" id="numero" value="<?php echo ($result['ds_numero']); ?>">
                                       <label for="numero">Número:</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-7 col-md-7 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="complemento" type="text" class="form-control" id="complemento" value="<?php echo ($result['ds_complemento']); ?>">
                                       <label for="complemento">Complemento:</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="bairro" type="text" class="form-control" id="bairro" value="<?php echo ($result['nm_bairro']); ?>">
                                       <label for="bairro">Bairro:</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="cidade" type="text" class="form-control" id="cidade" value="<?php echo ($result['nm_cidade']); ?>">
                                       <label for="cidade">Cidade:</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-2 col-md-2 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="estado" type="text" class="form-control" id="estado" value="<?php echo ($result['nm_estado']); ?>">
                                       <label for="estado">Estado:</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <hr>
                           <div class="mb-3">
                              <div class="row">
                                 <div class="col-lg-4 col-md-4 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="data" type="date" class="form-control" id="data">
                                       <label for="data">Data:</label>
                                    </div>
                                 </div>
                                 <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="form-floating mb-3">
                                       <input name="hora" type="time" class="form-control" id="hora" value="21:00">
                                       <label for="hora">Hora:</label>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <div class="col-lg-7 col-md-7 col-sm-12">
                                 <div class="form-floating mb-3">
                                    <input name="sobre" type="textarea" class="form-control" id="sobre" value="RED HOT CHILI PEPPERS TRAZ SUA UNLIMITED LOVE TOUR PARA CINCO CIDADES DO BRASIL EM 2024">
                                    <label for="sobre">Sobre o evento:</label>
                                 </div>
                              </div>
                           </div>
                           <div class="mb-3">
                              <div class="col-lg-7 col-md-7 col-sm-12">
                                 <label for="arquivo" class="form-label">Banner:</label>
                                 <input name="arquivo" type="file" class="form-control" aria-label="file example" id="arquivo">
                              </div>
                           </div>
                           <button name="salvar" type="submit" class="btn btn-outline-primary">Salvar</button>
                     </fieldset>
                  </form>
               </div>
            </div>
            <hr><br>
         </div>
      </div>
   </div>
   </div>
   <br><br>

</html>