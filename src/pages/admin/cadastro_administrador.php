<?php 

    session_start();

    require_once('../../utils/conecta.php');
    // VALIDA SE O USUARIO NÃO ESTIVER LOGADO, RETORNE AO LOGIN
    if(!isset($_SESSION['adm_logado'])) {
        header("Location: login.php");
        exit();
    };



    if($_SERVER['REQUEST_METHOD'] == "POST"){
        error_reporting(0);
        $adm_login = $_POST['adm_login'];
        $adm_pass = $_POST['adm_pass'];
        $adm_ativo = $_POST['adm_ativo'];
        $adm_email = $_POST['adm_email'];
        // print_r($_POST);
        try{
            $sql = "INSERT INTO ADMINISTRADOR (adm_login, adm_pass, adm_ativo, adm_email) VALUES (:adm_login, :adm_pass, :adm_ativo, :adm_email);";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':adm_login', $adm_login, PDO::PARAM_STR);
            $stmt->bindParam(':adm_pass', $adm_pass, PDO::PARAM_STR);
            $stmt->bindParam(':adm_ativo', $adm_ativo, PDO::PARAM_BOOL);
            $stmt->bindParam(':adm_email', $adm_email, PDO::PARAM_STR);

            isset($adm_ativo) ? '' : $adm_ativo = 0;
            $stmt->execute();
            

            echo "<p style='color: green'> Usuario $adm_login cadastrado com sucesso! </p>";
        } catch (PDOException $e) {
            echo "<p style='color: red'> Erro ao cadastrar </p>";
            echo "OPS " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Alpha: Cadastro de usuário </title>
    </head>
    <body>
        <h1> Cadastro de Usuários </h1>

        <form action="cadastro_administrador.php" method="POST">
        <label for="adm_login"> Login: </label>
        <input type="text" name="adm_login" id="adm_login" required>

        <label for="adm_pass"> Senha: </label>
        <input type="password" name="adm_pass" id="adm_pass" required>

        <label for="adm_email"> Email: </label>
        <input type="email" name="adm_email" id="adm_email" required>

        <label for="adm_ativo"> Ativo: </label>
        <input type="checkbox" name="adm_ativo" id="adm_ativo">

        <label for="enviar"> </label>
        <input type="submit" name="enviar" id="enivar">

        </form>

        <div>
            <a href="painel_admin.php"> Painel admin </a> 
            </br>
            <a href="listar_usuarios.php"> Listar usuários </a> 
        </div>
    </body>
</html>

