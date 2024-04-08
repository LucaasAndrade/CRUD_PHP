<?php
    
    session_start();

    require_once('../../utils/conecta.php');

    if(!isset($_SESSION['adm_logado'])){
        header("Location: login.php");
        exit();
    }


    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
        $msg = '';

        try{
            $id = $_GET['id'];

            $stmt = $pdo->prepare('SELECT * FROM administrador WHERE id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            print_r($usuario);
        
        }catch(PDOException $e){
            $msg = "Erro ao consultar informações $e";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        try{
            $id = $_GET['id'];
        
            $adm_login = $_POST['adm_login'];
            $adm_pass = $_POST['adm_pass'];
            $adm_email = $_POST['adm_email'];
            $adm_ativo = isset($_POST['adm_ativo']) ? '1' : '';
    
            $stmt = $pdo->prepare('UPDATE administrador SET adm_login = :adm_login, adm_email = :adm_email, adm_pass = :adm_pass, adm_ativo = :adm_ativo WHERE id = :id');
    
            $stmt->bindParam(':adm_login', $adm_login, PDO::PARAM_STR);
            $stmt->bindParam(':adm_pass', $adm_pass, PDO::PARAM_STR);
            $stmt->bindParam(':adm_email', $adm_email, PDO::PARAM_STR);
            $stmt->bindParam(':adm_ativo', $adm_ativo, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
            $stmt->execute();
            
            header("Location: listar_usuarios.php");

        }catch(PDOException $e){
            echo "Errro ao alterar informações $e";
        }
    } else {
        echo "Erro ao consultar informações";
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Alpha: Alterar informações </title>
    </head>
    <body>
        <h2> Alterar informações </h2>

        <form action="" method="POST">
            <label for="id"> ID: </label>
            <input type='text'value=<?php echo $usuario['id']; ?> name="id" disabled>

            <br/>

            <label for="adm_login"> Login: </label>
            <input type='text'value=<?php echo $usuario['adm_login']; ?> name="adm_login" required>
            
            <br/>
            

            <label for="adm_pass"> Senha: </label>
            <input type='text'value=<?php echo $usuario['adm_pass']; ?> name="adm_pass" required>

            <br/>


            <label for="adm_email"> Email: </label>
            <input type='email' value=<?php echo (isset($usuario['adm_email']) == 1 ? $usuario['adm_email'] : "SEM_INFORMAÇÃO") ?> name="adm_email" required>

            <br/>

            <label for="adm_ativo"> Ativo: </label>
            <input type="checkbox" name="adm_ativo" <?php echo $usuario['adm_ativo'] == 1 ? 'checked' : '' ?>>

            <input type="submit" >

        </form>
    </body>
</html>