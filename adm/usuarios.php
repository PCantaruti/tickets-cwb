<?php
include "../conn.php";
include "../organizador/restrito_organizador.php";

$cons_nome = $conn->prepare('SELECT * FROM organizadores WHERE id_organizador=:id');
$cons_nome->bindValue(':id', $_SESSION['login']);
$cons_nome->execute();
$row_nome = $cons_nome->fetch();

if (isset($_GET['exclusao'])) {
   $id_usuario = $_GET['id'];
   $excluir = $conn->prepare("UPDATE `usuarios` SET `ds_status_cad` = '0' WHERE `id_usuario` = :id_usuario;");
   $excluir->bindValue(":id_usuario", $id_usuario);
   $excluir->execute();
   header("Location: usuarios.php");
   exit();
}

if (isset($_GET['ativar'])) {
   $id_usuario = $_GET['id'];
   $excluir = $conn->prepare("UPDATE `usuarios` SET `ds_status_cad` = '1' WHERE `id_usuario` = :id_usuario;");
   $excluir->bindValue(":id_usuario", $id_usuario);
   $excluir->execute();
   header("Location: usuarios.php");
   exit();
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
   <link rel="stylesheet" style="text/css" href="../hover.css" />
   <title>Home</title>
</head>

<body>
   <nav>
      <div class="container-fluid menu" style="background-color: #000080;">
         <div class="container " style="background-color: #000080;">
            <div class="row">
               <div class=" col-xl-3 col-md-4 col-12 text-center">
                  <a class="navbar-brand" href="home_adm.php">
                     <img src="../img/Group 49.png" height="60" width="auto">
                  </a>
               </div>
               <div class="pt-3 col-xl-2 col-md-3 col-12 mt-1">
                  <div class="container-fluid">
                     <a class="nav-link active" aria-current="page" href="home_adm.php">
                        <p>Todos os eventos</p>
                     </a>
                  </div>
               </div>
               <div class="pt-3 col-xl-2 col-md-3 col-12 mt-1">
                  <div class="container-fluid">
                     <a class="nav-link" data-bs-toggle="dropdown" aria-expanded="false" aria-current="page" href="#">
                        <p>Cadastros</p>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="organizadores.php">Organizadores</a></li>
                        <li><a class="dropdown-item" href="usuarios.php">Usuários</a></li>
                        <li><a class="dropdown-item" href="add_adm.php">Adicionar Adm</a></li>
                     </ul>
                  </div>
               </div>
               <div class="pt-3 col-xl-3 col-md-3 col-12 text-center">
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
               <div class="dropdown-center pt-3 col-xl-2 col-md-4 col-12 text-center ">
                  <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                     <svg xmlns="http://www.w3.org/2000/svg" class="d-inline-block align-text-center" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" color="#F5F5F5">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                     </svg>
                     <p>Olá, <?php echo $row_nome['nm_organizador'] ?> </p>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="dropdown-item" href="log.php">Sair</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </nav>
   <div class="container-fluid" style="background-color: #000033; height: 40px; width: 100%;"></div>
   <?php
   $exib = $conn->prepare("SELECT * FROM usuarios");
   $exib->execute();
   $resultados = $exib->fetchAll(PDO::FETCH_ASSOC);
   ?>
   <div class="container-fluid">
      <div class="container">
         <div class="row">
            <div class="col">
               <br>
               <h2>Organizadores</h2>
               <table class="table table-striped table-hover table-borderless table-sm">
                  <thead>
                     <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CNPJ</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($resultados as $resultado) : ?>
                        <tr>
                           <th scope="row"><?php echo htmlspecialchars($resultado['id_usuario']); ?></th>
                           <td><?php echo htmlspecialchars($resultado['nm_usuario']); ?></td>
                           <td><?php echo htmlspecialchars($resultado['nr_cpf']); ?></td>
                           <td><?php echo htmlspecialchars($resultado['ds_email']); ?></td>
                           <td><?php echo htmlspecialchars($resultado['ds_status_cad'] == 0) ? "Inativo" : "Ativo"; ?></td>
                           <td>
                              <a href="#" class="link-dark link-underline" data-bs-toggle="modal" data-bs-target="#excluir_<?php echo $resultado['id_usuario']; ?>">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                                 </svg>
                              </a>
                              <!-- Modal de exclusão -->
                              <div class="modal fade" id="excluir_<?php echo $resultado['id_usuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body">
                                          Tem certeza que deseja excluir o usuário <?php echo $resultado['nm_usuario']; ?>
                                       </div>
                                       <div class="modal-footer">
                                          <!-- Link de confirmação da exclusão -->
                                          <a href="usuarios.php?exclusao&id=<?php echo $resultado['id_usuario']; ?>" class="btn btn-danger">Sim</a>
                                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                           <td>
                              <a href="#" class="link-dark link-underline" data-bs-toggle="modal" data-bs-target="#ativar_<?php echo $resultado['id_usuario']; ?>">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0" />
                                 </svg>
                                 <!-- Modal de ativação -->
                                 <div class="modal fade" id="ativar_<?php echo $resultado['id_usuario']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                          </div>
                                          <div class="modal-body">
                                             Tem certeza que deseja ativar o usuário <?php echo $resultado['nm_usuario']; ?>
                                          </div>
                                          <div class="modal-footer">
                                          <a href="usuarios.php?ativar&id=<?php echo $resultado['id_usuario']; ?>" class="btn btn-success">Sim</a>
                                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <a>
                           </td>
                          
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   <br><br><br><br><br><br><br><br><br><br><br><br>
   <footer>
      <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
   </footer>
</body>

</html>