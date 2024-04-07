<?php 

    session_start();

    require_once('../../utils/conecta.php');
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
            <a href="../produtos/cadastro_produto.php"> Cadastro de produto </a>
        </div>
        <div>
            <a href="../produtos/listar_produtos.php"> Listar produtos </a>
        </div>
        <div>
            <a href="cadastro_administrador.php"> Cadastrar Usuario </a>
        </div>
        <a href="listar_usuarios.php"> Listar usuários </a> 

    </section>
</body>
</html>