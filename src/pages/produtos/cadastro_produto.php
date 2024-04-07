<?php
    session_start();
    require_once('../../utils/conecta.php');

    // VALIDA SE O USUARIO NÃO ESTIVER LOGADO, RETORNE AO LOGIN
    
    // echo is_null($_SESSION['id']) ;
    if(!isset($_SESSION['adm_logado'])) {
        header("Location: ../admin/login.php");
        exit();
    };
    //RETORNA O METODO USADO PARA ACESSARA A PAGINA 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        // print_r($_POST);

        $nome = $_POST['nome'];
        $descricao  = $_POST['descricao'];
        $preco = $_POST['preco'];
        $url_imagem = $_POST['url_imagem'];
        
        $imagem_completa = $_FILES['imagem'];

        $imagem = $_FILES['imagem']['name'];

        $tearget_dir = "./uploads/";

        $tearget_file = $tearget_dir . basename($imagem);
        
        // GERAR URL DA IMAGEM
        $base_url = "http://localhost/Alpha/";

        $url_imagem = $base_url . "uploads/" . $imagem;
        
        // MOVER O ARQUIVO DA IMAGEM CARREGADO PARA O DIRETÓRIO DE DESTINO

        if(move_uploaded_file($_FILES['imagem']['tmp_name'], $tearget_file)){
            echo "<p>Imagem" , basename($imagem) . "foi carregada.";
        } else {
            echo "Falha ao carregar a imagem!";
        }

        try{
            $sql = "INSERT INTO produtos (nome, descricao, preco, imagem, url_imagem) VALUES (:nome, :descricao, :preco, :imagem, :url_imagem)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
            $stmt->bindParam(':imagem', $tearget_file, PDO::PARAM_STR);
            $stmt->bindParam(':url_imagem', $url_imagem, PDO::PARAM_STR);

            $stmt -> execute();

            echo "<p style='color: green'> Produto cadastrado com sucesso; </p>";

        } catch (PDOException $e){
            echo "<p style='color: red'> Erro ao cadastrar produto </p>" . $e;
        }
  
    }

?>

    <!DOCTYPE html>
    <html lang="en">    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Cadastro de produto </title>

        <style>
            *{
                margin: 0px;
                box-sizing: border-box;

                /* border: solid 1px red; */
            }
            body{
                display: flex;
                align-items: center;
                justify-content: center;
                flex-direction: column;
            }
            .form{
                margin-top: 10px;
                
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                
                width: 30em;
            }
            input{
                width: 10em;
                margin: 10px;
            }
        </style>
    </head>
    <body>
        <h2> Cadastro de Produto </h2>

        <div class="form">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for='nome'> Nome do produto </label>
            <input type="text" name="nome" id="nome" required/>

            <br>
            <label for='descricao'> Descricao do produto </label>
            <textarea name="descricao" id="descricao" required> </textarea>

            <br>
            <label for='preco'> Preço do produto </label>
            <input type="number" name="preco" id="preco" step='.5'required/>

            <br>
            <label for='imagem'> Foto do produto </label>
            <input type="file" name="imagem" id="imagem"/>
            
            <br>
            <label for='url_imagem'> Link Imagem </label>
            <input type="text" name="url_imagem" id="url_imagem"/>

            <br>
            <input type="submit" value="Cadastrar">

        </form>

        </div>
        <section>
            <a href="listar_produtos.php"> Listagem de produtos </a>
            <div></div>
            <a href="../admin/painel_admin.php"> Voltar ao painel </a>
            
        </section>
    </body>
    </html>
