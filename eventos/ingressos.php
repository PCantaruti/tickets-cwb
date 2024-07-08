<?php
session_start();
include "../conn.php";

if (isset($_SESSION['login'])) {
    $cons_nome = $conn->prepare('SELECT * FROM usuarios WHERE id_usuario=:id');
    $cons_nome->bindValue(':id', $_SESSION['login']);
    $cons_nome->execute();
    $row_nome = $cons_nome->fetch();
}


$id_evento = $_GET['id_evento'];

$info = $conn->prepare("SELECT e.nm_evento, e.dt_evento, e.ds_evento, e.nr_cep, e.nm_rua, e.ds_numero, e.nm_cidade, e.nm_bairro, e.nm_estado, e.nm_estabelecimento, e.ds_complemento, e.ds_status_evt, e.id_organizador, a.nm_titulo, a.ds_url, i.id_ingresso, i.ds_tipo, i.vl_ingresso, i.vl_meia, i.qt_ingresso, i.qt_meia, i.ds_tipo, i.vl_ingresso, i.vl_meia FROM eventos e LEFT JOIN arquivos a ON e.id_evento = a.id_evento LEFT JOIN ingressos i ON e.id_evento = i.id_evento WHERE e.id_evento = :id_evento");
$info->bindValue(':id_evento', $id_evento);
$info->execute();
$result = $info->fetch();


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TICKETS CWB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body>
    <!--Menu-->
    <nav>
        <div class="container-fluid menu" style="background-color: #000080;">
            <div class="container text-center" style="background-color: #000080;">
                <div class="row">
                    <div class=" col-xl-3 col-md-4 col-12">
                        <a class="navbar-brand" href="../index.php?id=<?php echo htmlspecialchars($row_nome['id_usuario']) ?>">
                            <img src="../img/Group 49.png" height="60" width="auto">
                        </a>
                    </div>
                    <div class="pt-3 col-xl-6 col-md-4 col-12">
                        <div class="container-fluid">
                            <div class="input-group mb-3">
                                <input style="background-color: #e2e3e5;" type="text" class="form-control" placeholder="Pesquisar" aria-label="Recipient's username" for="pesquisar">
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
                            if (!isset($_SESSION['login'])) {
                                echo "<p>Entre ou Cadastre-se</p>";
                            ?>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="../cad/login.php">Entre</a></li>
                           <li><a class="dropdown-item" href="../cad/cadastro.php">Cadastre-se</a></li>
                           <li><a class="dropdown-item" href="../cad/login_organizador.php">*Organizador</a></li>
                           <li><a class="dropdown-item" href="../cad/login_adm.php">*Adm</a></li>
                                </ul>
                                <?php
                            } else {
                                // Verifique se $row_nome está definido e contém um nome de usuário válido
                                if (isset($row_nome) && isset($row_nome['nm_usuario'])) {
                                    echo "<p>Olá, " . htmlspecialchars($row_nome['nm_usuario']) . "</p>";
                                ?>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="../usuario/minha_conta.php">Minha Conta</a></li>
                                    <li><a class="dropdown-item" href="../log.php">Sair</a></li>
                                    </ul>
                            <?php
                                }
                            }
                            ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;">
    </div>

    <!--Conteudo-->
    <div class="container-fluid" style="background-color: #000033;">
        <div class="container">
            <div class="bx1" style="background-color: #000033;  height: auto;">
                <div class="bx2" style="background-color: #000033;"><br>
                    <h2><?php echo strtoupper(htmlspecialchars($result['nm_evento'])) ?></h2>
                    <h2><?php echo strtoupper(htmlspecialchars($result['nm_cidade'])) ?></h2>
                    <p>
                        <?php
                        setlocale(LC_TIME, 'pt_BR.utf8', 'pt_BR', 'pt_BR.utf-8', 'portuguese');
                        // Suponha que $result['dt_evento'] contém a data no formato 'YYYY-MM-DD HH:MM:SS'
                        $timestamp = strtotime($result['dt_evento']);
                        // Obtém o texto formatado com strftime
                        $dataFormatada = strftime('%A, %d/%m/%Y | %H:%M', $timestamp);
                        // Transforma a string para caixa alta
                        $dataFormatadaMaiuscula = strtoupper($dataFormatada);
                        // Exibe a data formatada em caixa alta
                        echo $dataFormatadaMaiuscula;
                        ?>
                    </p>
                    <p><?php echo $result['nm_estabelecimento'] . ' | ' . $result['nm_rua'] . ', ' . $result['ds_numero'] . ', ' . $result['nr_cep'] . ' ' . $result['nm_cidade'] . " - " . $result['nm_estado']; ?></p>
                </div>
                <div class="bx2" style="background-color: #000033; height: auto;">
                    <img src="<?php echo "../index/" . ($result['ds_url']); ?>" class="rounded mx-auto d-block" alt="<?php echo ($result['nm_titulo']); ?>" style="width: 18rem;">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="background-color: #000033;">
        <div class="container" style="background-color: #e9cc80;">
            <ul>
                <li>
                    <p style="color:#000033;">Se um evento, preço ou setor estiver marcado como “indisponivel no momento” , significa que todos os ingressos daquele setor ou tipo <br />
                        de preço foram vendidos ou estão em processo de compra. Caso a compra não seja concluída ou finalizada os ingressos ficam disponiveis para venda<br />
                        novamente. Nossa sugestão é que você sempre fique de olho no site.</p><br />
                </li>
            </ul>
        </div>
        <br><br>
    </div>
    <div class="container-fluid" style="background-color: #000033;">
        <!--Pista-->
        <div class="container" style="background-color: #000033">
            <?php
            $exib = $conn->prepare("SELECT e.id_evento, i.id_ingresso, i.ds_tipo, i.vl_ingresso, i.vl_meia, i.qt_ingresso, i.qt_meia, i.ds_tipo, i.vl_ingresso, i.vl_meia FROM eventos e JOIN ingressos i ON e.id_evento = i.id_evento");
            $exib->execute();
            $resultados = $exib->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php foreach ($resultados as $evento) : ?>
                <div class="P1">
                    <div class="col-12">
                        <h2 class="pst" style="color:#f5f5f5;"><?php echo $evento['ds_tipo'] ?></h2>
                    </div>
                    <table class=" table table-dark" style="color: #000033;  --bs-table-bg: #000033;">
                        <tbody>
                            <tr>
                                <td>INTEIRA</td>
                                <td><b><?php echo "R$ " . $evento['vl_ingresso'] ?></b></td>
                                <td>
                                    <button type="button" class="btn btn-outline-light" onclick="decrementarNumero('inteira_<?php echo $evento['id_ingresso'] ?>')">-</button>
                                </td>
                                <td>
                                    <input style="" type="text" id="inteira_<?php echo $evento['id_ingresso'] ?>" class="numero" value="0" readonly />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" onclick="incrementarNumero('inteira_<?php echo $evento['id_ingresso'] ?>', <?php echo $evento['qt_ingresso'] ?>)">+</button>
                                </td>
                            </tr>
                            <tr>
                                <td>MEIA ENTRADA</td>
                                <td><b><?php echo "R$ " . $evento['vl_meia'] ?></b></td>
                                <td>
                                    <button type="button" class="btn btn-outline-light" onclick="decrementarNumero('meia_<?php echo $evento['id_ingresso'] ?>')">-</button>
                                </td>
                                <td>
                                    <input type="text" id="meia_<?php echo $evento['id_ingresso'] ?>" class="numero" value="0" readonly />
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary" onclick="incrementarNumero('meia_<?php echo $evento['id_ingresso'] ?>', <?php echo $evento['qt_meia'] ?>)">+</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
            <a href="../usuario/carrinho.php" class="btn btn-light">Comprar</a>


            <script>
                function incrementarNumero(idInput, quantidadeMaxima) {
                    var inputNumero = document.getElementById(idInput);
                    var numeroAtual = parseInt(inputNumero.value, 10);

                    if (numeroAtual < quantidadeMaxima) {
                        inputNumero.value = numeroAtual + 1;
                    } else {
                        alert('Quantidade máxima atingida para este tipo de ingresso!');
                    }
                }

                function decrementarNumero(idInput) {
                    var inputNumero = document.getElementById(idInput);
                    var numeroAtual = parseInt(inputNumero.value, 10);

                    if (numeroAtual > 0) {
                        inputNumero.value = numeroAtual - 1;
                    }
                }
            </script>
        </div>
        <br />
        <br />
        <br />
        <br />
    </div>
    <!--Rodapé-->
    <section style="background-color: #000080; width: 100%; height: auto;">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    <div class="pt-4 col-md-12">
                        <ul>
                            <li class="list-group-item">
                                <a href="atendimento.html">
                                    <p style="color: #f5f5f5;">Atendimento ao Cliente</p>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="formpagamento.html">
                                    <p style="color: #f5f5f5;">Formas de Pagamento</p>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="meiaentrada.html">
                                    <p style="color: #f5f5f5;">Meia-entrada</p>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="../PI/login_organizador.html">
                                    <p style="color: #f5f5f5;">Venda na Tickets CWB</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background-color: #000033; height: 60px; width: 100%;"></div>
    </section>
</body>

</html>