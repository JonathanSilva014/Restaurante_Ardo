<?php
    session_start();

    if(isset($_SESSION['loggedIN'])){
        header('Location:gestao_reserva.php');
        exit();
    }
    if(isset($_POST['login'])) {
        $connection = new mysqli('localhost','root','','restaurante');
        $username = $connection->real_escape_string($_POST['username']);
        $password = $connection->real_escape_string($_POST['password']);

        $data = $connection->query("SELECT funcionario_id FROM funcionario WHERE username='$username' AND password='$password'");
        if($data->num_rows > 0) {
            $_SESSION['loggedIN'] = '1';
            $_SESSION['username'] = $username;
            exit('success');
        }
        else{
            exit('failed');
        }
    }
    
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>ORDO</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- jQuery e Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <!-- Nosso CSS e JS -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    
<nav id="barra_navegacao" class="navbar navbar-inverse">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="#">Gerência</a></li>
        </ul>
    </div>
</nav>

<div id="container_login">
    <h1 style="align-self: center;">Log-In</h1>
    <form id="form_login" method="POST" action="login.php">
        <input type="text" id="username" placeholder="Insira o username...">
        <input type="password" id="password" placeholder="Insira a password...">
        <input type="button" value="Log In" id="login">
        <h3 id="resposta"></h3>
    </form>
    </div>
</body>

<script>

$(document).ready(function(){
    $("#login").on('click', function () {
        var username = $("#username").val();
        var password = $("#password").val();
        if(username== "" || password == "")
        {
            
            alert("Por favor preencha todos os campos");
        }
        else{
            $.ajax({
            url: 'login.php',
            method: 'POST',
            data:{login:1,username:username,password:password},
            success: function(data){
                $("#resposta").html(data);
                if(data.indexOf('success' >= 0))
                {             
                    window.location = 'gestao_reserva.php';
                }
            },
            dataType: 'text'
            });
        }
    })
});

</script>
