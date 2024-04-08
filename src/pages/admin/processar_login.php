<?php

    //INICIANDO SESSÃO NO PHP
    session_start();

    // "IMPORTANADO" O CONECTA
    require_once('../../utils/conecta.php');

    
    
    // TRATAMENTO DE ERRO
    // try{
        // PEGANDO AS VARIÁVEIS DE ACESSO
        
        $login = $_POST['user_login'];
        $senha = $_POST['user_pass'];

        

        //COMANDO SQL
        $sql = "SELECT * FROM administrador WHERE adm_login = :login  AND adm_pass = :senha  AND adm_ativo = 1";
        // : LOGIN : SENHA SÃO TRATAMENTOS DE SEGURANÇA PARA ESSAS VARIÁVEIS, EVITANDO SQL INJECTION E AFINS.
        
        $query = $pdo->prepare($sql);

        // TRATANDO VARIÁVEIS
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->bindParam(':senha', $senha, PDO::PARAM_STR);

        // EXECUTANDO COMANDO  ALTERANDO OS : PELOS DADOS JÁ TRATADOS.
        $query->execute();



        //VALIDAÇÕES PARA ALTERAR PARA O HOME
        if($query->rowCount() > 0){
            // SE O RETORNO DA QUERY FOR MAIOR QUE 1
            $_SESSION['adm_logado'] = true;
            $_SESSION['nome'] = $login;
            
            // SE O RETORNO DA QUERY FOR MAIOR QUE 1, MUDE PARA O HOME
            header("Location: painel_admin.php");
        }else{
            // SE NÃO, RETORN ESSE ERRO
            // echo "<p style='color:red'> Login ou senha inválidos! </p>";
            header("Location: login.php?erro");
        };

    // }catch(PDOException $e){

        // TRATAMENTO DE ERRO
        // echo "Erro ao consultar informações: $e";
    // }

?>