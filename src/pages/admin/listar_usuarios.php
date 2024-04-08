<?php
session_start();

require_once('../../utils/conecta.php');

if (!isset($_SESSION['adm_logado'])) {
   header("Location: login.php");
   exit;
}


try {
   $stmt = $pdo->prepare("SELECT * FROM administrador;");
   $stmt->execute();

   $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // print_r($usuarios);
} catch (PDOException $e) {
   echo "<p style='color: red'> Erro ao consultar dados: $e </p>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title> Alpha: Usuários </title>

   <style>
      table{
         width: 50%;
      }
      td {
         height: 30px;
         width: 40vh;

         align-items: center;
         justify-content: center;
         text-align: center;
      }

      th {
         height: 30px;
         width: 100vh;
      }
      body, .lista_usuarios{
         display: flex;
         justify-content: center;
         align-items: center;
         flex-direction: column;
      }
   </style>
</head>

<body>
   <h1> Usuários </h1>

   <div class="lista_usuarios">
      <table border="1">
         <tr>
            <th> Login </th>
            <th> Email </th>
            <th> Ativo </th>
         </tr>
         <?php foreach ($usuarios as $usuario) : ?>
            <tr>
               <td> <?php echo $usuario['adm_login'] ?> </td>
               <td> <?php echo $usuario['adm_email'] ?> </td>
               <td> <?php echo ($usuario['adm_ativo'] == '0' ? "<p style='color: red'> Não ativo </p> " : "<p style='color: green'> Ativo </p>") ?> </td>
               <td> <a href=<?php echo "remover_usuario.php?id=" . $usuario['id']?>> Excluir </a></td>
               <td> <a href=<?php echo "editar_usuario.php?id=" . $usuario['id']?>> Editar </a></td>
            </tr>
         <?php endforeach; ?>
      </table>
   </div>
   <a href="listar_usuarios.php"> Voltar à listagem de usuários </a>
    <br/>
    <a href="painel_admin.php"> Painel admin </a>
</body>

</html>