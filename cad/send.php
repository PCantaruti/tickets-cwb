<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    // Validar dados
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Substitua pelo seu servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'cantaruti2@gmail.com'; // Substitua pelo seu usuário SMTP
        $mail->Password = 'cbtezrolepksufui'; // Substitua pela sua senha SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remetente e destinatário
        $mail->setFrom($email);
        $mail->addAddress($email); // Substitua pelo e-mail do destinatário

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Recuperar senha - TicketCWB';
        $mail->Body    = "<html><body>
                            <h2>Recuperar Senha TicketCWB</h2>
                            <p><strong>Sua nova senha é:</strong> $novasenha</p>
                          </body></html>";
        $mail->AltBody = "E-mail: $email";

        $mail->send();
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Você receberá um e-mail com a nova senha.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
        <?php
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
