<?php
//if (isset($_POST['email'])) {
 //   $email = $_POST['email'];

    // Inclua a configuração da conexão com o banco de dados
   // include "conn.php";

    // Verifique se o e-mail existe no banco de dados
  //  $stmt = $conn->prepare('SELECT * FROM `usuarios` WHERE `ds_email` = :email');
   // $stmt->bindValue(':email', $email);
   // $stmt->execute();

  //  if ($stmt->rowCount() > 0) {
   //     $user = $stmt->fetch();
  //      $reset_code = $user['ds_senha']; // Senha já criptografada em MD5

        // Enviar e-mail com a senha criptografada
   //     $to = $email;
   //     $subject = "Redefinição de Senha";
  //      $message = "Seu código de verificação é: $reset_code";
 //       $headers = "From: no-reply@seusite.com";
//
    //    mail($to, $subject, $message, $headers);

   //     echo "Um e-mail com o código de verificação foi enviado.";
  //  } else {
  //      echo "E-mail não encontrado.";
  //  }
//}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Redefinir Senha</h1>
        <form action="reset_password.php" method="POST">
            <div class="mb-3">
                <label for="reset_code" class="form-label">Código de Verificação</label>
                <input type="text" name="reset_code" class="form-control" id="reset_code" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Nova Senha</label>
                <input type="password" name="new_password" class="form-control" id="new_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Redefinir Senha</button>
        </form>
    </div>
</body>
</html>
<?php
if (isset($_POST['reset_code']) && isset($_POST['new_password'])) {
    $reset_code = $_POST['reset_code'];
    $new_password = md5($_POST['new_password']); // Usando md5 para fins de exemplo, mas recomenda-se bcrypt

    // Inclua a configuração da conexão com o banco de dados
    include "conn.php";

    // Verifique o código de verificação
    $stmt = $conn->prepare('SELECT * FROM `usuarios` WHERE `ds_senha` = :reset_code');
    $stmt->bindValue(':reset_code', $reset_code);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Atualizar a senha
        $stmt = $conn->prepare('UPDATE `usuarios` SET `ds_senha` = :new_password WHERE `ds_senha` = :reset_code');
        $stmt->bindValue(':new_password', $new_password);
        $stmt->bindValue(':reset_code', $reset_code);
        $stmt->execute();

        echo "Sua senha foi redefinida com sucesso.";
    } else {
        echo "Código de verificação inválido.";
    }
}
?>