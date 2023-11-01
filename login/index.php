<?php
include("conexao.php");

if (isset($_POST['email']) || isset($_POST['senha'])) {
    if (strlen($_POST['email'] == 0)) {
        echo ("Preencha o seu email");
    } else if (strlen($_POST['senha'] == 0)) {
        echo ("Digite sua senha");
    }

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";

    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    $qtd = $sql_query->num_rows;

    if ($qtd == 1) {
        $usuario = $sql_query->fetch_assoc();

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['senha'] = $usuario['senha'];

        header("Location:painel.php");
    } else {
        echo ("Falha ao logar! E-mail ou senha incorretos!");
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <h1>Faça seu login na sua conta</h1>
    </center>
    <hr>

    <center>
        <div class="container" width=>
            <form nome="login" action="" method="POST">
                <label>E-mail:</label>
                <input type="text" name="email"> <br> <br>
                <label> senha:</label>
                <input type="password" name="senha" id="password"><br> <br>
                <button type="submit" name="entrar">Entrar</button>
            </form>
        </div>
    </center>





    <style>
        @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@10..48,200&family=Carlito:ital,wght@1,700&family=Poppins:wght@200;400&family=Roboto+Condensed&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@10..48,200&family=Carlito:ital,wght@1,700&family=Mukta:wght@200;300&family=Poppins:wght@200;400&family=Roboto+Condensed&display=swap');

        body {}

        h1 {
            font-family: 'Bricolage Grotesque';
        }

        form,
        button {
            font-family: 'Mukta';
            border-radius: 6px;

        }

        form {
            margin-top: 90px;

        }

        button {
            background-color: #468EC2;
            transition: 'background-color 0.3s ease-in-out';
            color: #fff;
            width:70px ;
            height: 30px;
        }

        button:hover {
            background-color: #0E5D96;
        }

        input {
            border-radius: 15px;
        }

        .container {
            width: 300px;
            height: 300px;
            border-radius: 15px;
            margin-top: 100px;
            background-color: #202020;
            color: #fff;
            display: flex;
            justify-content: center;

        }
    </style>

</body>

</html>