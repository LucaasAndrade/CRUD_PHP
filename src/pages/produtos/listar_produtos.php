<?php
    session_start();

    require_once('../../utils/conecta.php');

    if(!isset($_SESSION['adm_logado'])){
        header("Location: ../admin/login.php");
        exit();
    }

    try{
        $stmt = $pdo->prepare(("SELECT * FROM PRODUTOS"));
        $stmt->execute();

        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch( PDOException $e) {
        echo "<p style='color: red'> Erro ao consultar produtos ". $e->getMessage()."</p>";
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Listagem de Produtos </title>

        <style>
            .imagem_produto{
                width: 3em;
                size: 3em;
            } td{
                height: 30px;
                width: 100vh;

                align-items: center;
                justify-content: center;
                text-align: center;
            } th{
                height: 30px;
                width: 100vh;
            }

        </style>
    </head>
    <body>
        <h1> Lista de produtos </h1>

        <main>
            <table border="1 2">
                <tr>    
                    <th> ID </th>
                    <th> Nome </th>
                    <th> Descrição </th>
                    <th> Preço </th>
                    <th> Imagem </th>
                </tr>
                <?php foreach($produtos as $produto): ?>
                <tr>
                   <td><?php echo $produto['id'] ?> </td>
                   <td><?php echo $produto['nome'] ?> </td>
                   <td><?php echo $produto['descricao'] ?> </td>
                   <td><?php echo $produto['preco'] ?> </td>
                   <td><img src=<?php echo $produto['imagem'] ?> alt="sem imagem" class="imagem_produto"> </td>
                    <td> <a href="remover_produto.php?id=<?php echo $produto['id'] ?>"> Remover </a> </td>
                    <td> <a href="editar_produto.php?id=<?php echo $produto['id'] ?>"> Editar </a> </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </main>

        <div>
            <a href="../admin/painel_admin.php"> Retornar ao painel </a>
            <br>
            <a href="cadastro_produto.php"> Cadastro de produtos </a>
        </div>
    </body>
    </html>
