<?php
include "../conn.php";
if (isset($_GET['exclusao'])) {
   $id_evento = $_GET['id'];
   $excluir = $conn->prepare("UPDATE `eventos` SET `ds_status_evt` = '0' WHERE `eventos`.`id_evento` = :id_evento;");
   $excluir->bindValue(":id_evento", $id_evento);
   $excluir->execute();
   header("Location: home_adm.php");
   exit();
}
if (isset($_GET['ativar'])) {
   $id_evento = $_GET['id'];
   $excluir = $conn->prepare("UPDATE `eventos` SET `ds_status_evt` = '1' WHERE `eventos`.`id_evento` = :id_evento;");
   $excluir->bindValue(":id_evento", $id_evento);
   $excluir->execute();
   header("Location: home_adm.php");
   exit();
}

$id_evento = $_GET['id'];

$info = $conn->prepare("SELECT e.nm_evento, e.dt_evento, e.ds_evento, e.nr_cep, e.nm_rua, e.ds_numero, e.nm_cidade, e.nm_bairro, e.nm_estado, e.nm_estabelecimento, e.ds_complemento, e.ds_status_evt, e.id_organizador, o.nm_organizador, a.nm_titulo, a.ds_url 
                        FROM eventos e 
                        JOIN arquivos a ON e.id_evento = a.id_evento 
                        JOIN organizadores o ON e.id_organizador = o.id_organizador 
                        WHERE e.id_evento = :id_evento");
$info->bindValue(':id_evento', $id_evento);
$info->execute();
$result = $info->fetch();



include "restrito_adm.php";
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
                  <a class="navbar-brand" href="home_adm.php">
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
               <img src="../index/<?php echo ($result['ds_url']); ?>" class="rounded mx-auto d-block" alt="<?php echo ($resultado['nm_titulo']); ?>" style="width: 18rem;">
            </div>
            <div class="col pt-5">
               <h2><?php echo $result['nm_evento']; ?> </h2>
               <table class="table table-borderless" id="dados">
                  <tr>
                     <td><?php echo $result['nm_estabelecimento'] . ' | ' . $result['nm_rua'] . ', ' . $result['ds_numero'] . ', ' . $result['nr_cep'] . ' ' . $result['nm_cidade']; ?></td>
                     <td>
                  </tr>
                  <tr>
                     <td>Organizador: <?php  echo htmlspecialchars($result['nm_organizador']);?></td>
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
                        <a href="#" class="link-danger" data-bs-toggle="modal" data-bs-target="#excluir">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                           </svg>
                           Excluir
                        </a>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <a href="#" class="link-success" data-bs-toggle="modal" data-bs-target="#ativar">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                              <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                           </svg>
                           Ativar
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
               <div class="modal fade" id="excluir" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           Tem certeza que deseja excluir o evento?
                        </div>
                        <div class="modal-footer">
                           <!-- Link de confirmação da exclusão -->
                           <a href="evento_adm.php?exclusao&id=<?php echo $id_evento;?>" class="btn btn-primary">Sim</a>
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Modal de ativação -->
               <div class="modal fade" id="ativar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header">
                           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                           Tem certeza que deseja ativar o evento?
                        </div>
                        <div class="modal-footer">
                           <!-- Link de confirmação da exclusão -->
                           <a href="evento_adm.php?ativar&id=<?php echo $id_evento; ?>" class="btn btn-primary">Sim</a>
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         <br>
         </div>
      </div>
   </div>
   </div>
   <br><br>

</html>