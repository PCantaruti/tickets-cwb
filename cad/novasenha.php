<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style_1.css">
</head>
<body>
    <div class="container-fluid menu" style="background-color: #000080;">
        <div class="container text-center" style="background-color: #000080;">
           <div class="row">
              <div class=" col-xl-3 col-md-4 col-12 pb-2">
                 <a class="navbar-brand" href="../index.php">
                    <img src="Group 49.png" height="60" width="auto">
                 </a>
              </div>
           </div>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"> 
        <div class="container">
           <div class="row">
              <div class="pt-3 col-md-12">
              </div>
           </div>           
        </div>
     </div>
   <br><br>
     <div class="container-fluid login">
        <div class="container text-center">
   
            <div class="row">
            <div class="col"></div>
               <div class="col-5" style="border-width: 2px; border-style: solid; border-color: #E0E6EB; border-radius: 10px; background-color: #fff;"><br><br>


               <h4>Redefinir Senha</h4><br>
               <form action="reset_password.php" method="POST">
                  <div class="mb-3">
                     <label for="reset_code" class="form-label">Código de Verificação</label>
                     <input type="text" name="codigo" class="form-control" id="reset_code" required>
                  </div>
                  <div class="mb-3">
                     <label for="new_password" class="form-label">Nova Senha</label>
                     <input type="password" name="novasenha" class="form-control" id="new_password" required>
                  </div>
                  <div class="mb-3">
                     <label for="new_password" class="form-label">Confirmar nova senha</label>
                     <input type="password" name="novasenha" class="form-control" id="new_password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Redefinir Senha</button>
               </form>
               <br><br>
               </div>
                <div class="col"></div>

            </div>
        </div>
    </div><br><br>
    <br><br>
    <br><br>
      
   
</body>
</html>




