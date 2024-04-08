<?php

    session_start();
    require_once('../../utils/conecta.php');

    // VALIDA SE O USUARIO NÃO ESTIVER LOGADO, RETORNE AO LOGIN

    // echo is_null($_SESSION['id']) ;
    if(!isset($_SESSION['adm_logado'])) {
        header("Location: ../admin/login.php");
        exit();
    };

    
    if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])){
        $id = $_GET['id'];
        $msg = '';
        
        try{  
        $stmt = $pdo->prepare('DELETE FROM administrador WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if($stmt->rowCount() > 0){
            $msg = "Usuário excluido com sucesso!";
        } else {
            $msg = "Erro ao excluir registro!";
        };
        } catch( PDOException $e){
            $msg = "Erro ao carregar informações $e";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Alpha: Deletar Usuário </title>
</head>
<body>
    <h2> <?php echo $msg ?> </h2>
    <a href="listar_usuarios.php"> Voltar à listagem de usuários </a>
    <br/>
    <a href="painel_admin.php"> Painel admin </a>
</body>
</html>