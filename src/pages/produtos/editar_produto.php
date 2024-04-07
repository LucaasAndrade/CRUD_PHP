<?php

    session_start();
    require_once('../../utils/conecta.php');

    // VALIDA SE O USUARIO NÃO ESTIVER LOGADO, RETORNE AO LOGIN

    // echo is_null($_SESSION['id']) ;
    if(!isset($_SESSION['adm_logado'])) {
        header("Location: ../admin/login.php");
        exit();
    };
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        if(isset($_GET['id'])){
            $id = $_GET['id'];

            try{
                $stmt = $pdo->prepare("SELECT * FROM produtos WHERE id = :id");
                $stmt ->bindParam(':id', $id, PDO::PARAM_INT);

                $stmt ->execute();

                $produto = $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Erro: " . $e;
            }
        } else {
            // header("Location:listar_produtos.php");
            // exit();

            echo "Não foi possível consultar o produto! Por favor, tente novamente."; 
            echo "<br>";
            echo "<a href='listar_produto.php'> Voltar a lista de produtos </a>";
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $url_imagem = $_POST['url_imagem'];

        
        try{
            $stmt = $pdo->prepare("UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, url_imagem = :url_imagem WHERE id = :id");

            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_INT);
            $stmt->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);
            $stmt->execute();
            
            
            header('Location:listar_produtos.php');
            exit();
        } catch (PDOException $e){
            echo "Erro: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alpha: Editar produto </title>
</head>
<body>
    <h2> Editar Produtos </h2>
    <form action="editar_produto.php" method="post">
        <input type='hidden' name="id" value="<?php echo $produto['id']; ?>">
        
        <label for="nome"> Nome: </label>
        <input type="text" name="nome" id="nome" value="<?php echo $produto['nome'];?>" > <br>
        
        <label> Descrição: </label>
        <textarea name="descricao" id="descricao" value="<?php echo $produto['
        '];?>" ></textarea><br>

        <label for="preco"> Preço: </label>
        <input type="number" id="preco" name="preco" value="<?php echo $produto['preco'];?>"> <br>

        <label for="imagem"> Imagem </label>
        <input type="text" id="imagem" name="imagem" value="<?php echo $produto['url_imagem'];?>"> <br>

        <input type="submit" value="Atualizar Produto">
    </form>
    <a href="listar_produtos.php"> Voltar à lista de produtos </a>
</body>
</html>