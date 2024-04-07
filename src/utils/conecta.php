<?php
    // IMPORTANDO AS INFROMAÇÕES DO BANCO DE DADOS
    require_once 'serverconfig.php';

    // TRATAMENTO DE ERRO
    try{
        // INSTACIÂNDO UM NOVO OBJETO PDO
        $pdo = new PDO("mysql:host=$servername;dbname=$database", $username, $password);

    }catch(PDOException $e) {
        echo "Erro ao conectar no banco de dados: $e";
    }



?>