<?php 

    session_start();

    require_once('conecta.php');
    // VALIDA SE O USUARIO NÃO ESTIVER LOGADO, RETORNE AO LOGIN
    if(!isset($_SESSION['adm_logado'])) {
        header("Location: login.php");
        exit();
    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha: home</title>
</head>
<body>
    <?php
        
        echo "Bem vindo, " . $_SESSION['nome'];
    ?>
    <section>
        <div>
            <a href="cadastro_produto.php"> Cadastro de produto </a>
        </div>
        <a href="listar_produtos.php"> Listar produtos </a>

    </section>
</body>
</html>