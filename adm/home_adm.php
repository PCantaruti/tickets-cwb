<?php
include "../conn.php";
include "../organizador/restrito_organizador.php";

$cons_nome = $conn->prepare('SELECT * FROM organizadores WHERE id_organizador=:id');
$cons_nome->bindValue(':id', $_SESSION['login']);
$cons_nome->execute();
$row_nome = $cons_nome->fetch();
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
   <div class="container-fluid" style="background: linear-gradient(180deg, #003 0%, #000080 100%)">

      <div class="container align-itens-center">
         <div class="row">
            <div class="col-6 pt-3 pb-2">
               <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  <h6 style="color: #f5f5f5;" class="text-start">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                        <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z" />
                     </svg>
                     Filtrar
                  </h6>
               </a>
               <div class="collapse" id="collapseExample">
                  <div class="card card-body" style="background-color: transparent;">
                     <form>
                        <div class="mb-3">
                           <div class="row">
                              <div class="col-4">
                                 <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                       <option selected>Escolha</option>
                                       <option value="1">Curitiba</option>
                                       <option value="2">Pinhais</option>
                                       <option value="3">São José dos Pinhais</option>
                                       <option value="3">Piraquara</option>
                                       <option value="3">Colombo</option>
                                    </select>
                                    <label for="floatingSelect">Filtre por cidade</label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="internacional">
                              <label class="form-check-label" for="internacional">
                                 <p>Ingressos Disponíveis</p>
                              </label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="nacional">
                              <label class="form-check-label" for="nacional">
                                 <p>Ingressos Indisponíveis</p>
                              </label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="familia">
                              <label class="form-check-label" for="familia">
                                 <p>Evento Ativo</p>
                              </label>
                           </div>
                        </div>
                        <div class="mb-3">
                           <div class="form-check">
                              <input class="form-check-input" type="checkbox" value="" id="familia">
                              <label class="form-check-label" for="familia">
                                 <p>Evento Inativo</p>
                              </label>
                           </div>
                        </div>
                        <button class="btn btn-outline-light btn-sm" type="submit">
                           <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-funnel" viewBox="0 0 16 16">
                              <path d="M1.5 1.5A.5.5 0 0 1 2 1h12a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.128.334L10 8.692V13.5a.5.5 0 0 1-.342.474l-3 1A.5.5 0 0 1 6 14.5V8.692L1.628 3.834A.5.5 0 0 1 1.5 3.5v-2zm1 .5v1.308l4.372 4.858A.5.5 0 0 1 7 8.5v5.306l2-.666V8.5a.5.5 0 0 1 .128-.334L13.5 3.308V2h-11z" />
                           </svg>
                           Filtrar
                        </button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <br><br>

         <?php
         $exib = $conn->prepare("SELECT e.id_evento, e.nm_evento, e.dt_evento, e.ds_status_evt, e.nm_estabelecimento, a.nm_titulo, a.ds_url FROM eventos e JOIN arquivos a ON e.id_evento = a.id_evento");
         $exib->execute();
         $resultados = $exib->fetchAll(PDO::FETCH_ASSOC);
         ?> 
         <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($resultados as $resultado) : ?>
               <div class="col">
                  <a href="evento_adm.php?id=<?php echo htmlspecialchars($resultado['id_evento']); ?>">
                     <div class="card h-100" style="width: 18rem;">
                        <img src="<?php echo "../index/".($resultado['ds_url']); ?>" class="card-img-top" alt="<?php echo ($resultado['nm_titulo']); ?>">
                        <div class="card-body">
                           <p class="card-text">
                           </p>
                           <p class="card-text">
                              <?php echo htmlspecialchars($resultado['nm_evento']) . " | " . htmlspecialchars($resultado['nm_estabelecimento']) . " | " . date("d/m/Y", strtotime($resultado['dt_evento'])) . " | "; ?>
                              <?php echo ($resultado['ds_status_evt'] == 0) ? "Inativo" : "Ativo"; ?>
                           </p>
                        </div>
                     </div>
                  </a>
               </div>
            <?php endforeach; ?>
         </div>
      </div>
   </div>
   <footer>
      <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
   </footer>
</body>

</html>