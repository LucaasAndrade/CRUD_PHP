<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Alpha Code - Login </title>
    </head>
    <body>
        <nav>
            Login Page
        </nav>
        <section>
            <form action="processar_login.php" method="post">

                <label> Login </label>
                <input name="user_login" required>
                
                <label> Password </label>
                <input name="user_pass" required> 

                <button type="submit"> Login </button>

                <?php
                if(isset($_GET["erro"])){
                    echo "<p style='color:red'> Login ou senha inválidos! </p>";
                }
                ?>
            </input>
        </section>
</html>