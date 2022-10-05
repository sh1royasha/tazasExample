<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        if($_SESSION['rol'] != 'admin'){
            header('Location: ./dashboard.php');
        }else{
            header('Location: ./admin.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@400;500;600;900&display=swap" rel="stylesheet">

    <!-- material icon link -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />

    <!-- estilos dahsboard -->
    <link rel="stylesheet" href="./includes/css/style.css">
    
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Document</title>
</head>
<body>
    <main class="container-login">
        <div class="container-login_content">
            <div class="container_form">
                <div class="change">
                    <a class="active" id="btn-login" >Login</a>
                    <a id="btn-register">Register</a>
                </div>
                <form method="POST" id="form_login" class="form_login" autocomplete="off">
                    <div class="form_login_item">
                        <label for="">Correo:</label>
                        <input type="email" name="email" id="LogEmail">
                    </div>
                    <div class="form_login_item">
                        <label for="">Contraseña:</label>
                        <input type="password" name="password" id="LogPassword">
                    </div>
                    <div class="form_login_ingresar">
                        <button type="submit">Ingresar</button>
                    </div>
                    <input type="hidden" name="action" value="login">
                </form>
                
                <form method="POST" id="form_register" class="form_register disabled" autocomplete="off">
                    <div class="form_register_item">
                        <label for="">Nombre</label>
                        <input type="text" name="name" id="name">
                    </div>
                    <div class="form_register_item">
                        <label for="">Correo</label>
                        <input type="email" name="email" id="email">
                    </div>
                    <div class="form_register_item">
                        <label for="">Contraseña</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <div class="form_register_item">
                        <label for="">Telefono</label>
                        <input type="number" name="phone" id="phone">
                    </div>
                    <div class="form_register_ingresar">
                        <button type="submit" id="reg">Registrarse</button>
                    </div>
                    <input type="hidden" name="action" value="users">
                </form>
            </div>
            <div class="img">
                <figure>
                    <img src="./assets/img/shop.svg" alt="">
                </figure>
            </div>
        </div>
    </main>

    <script src="./includes/js/jquery.js"></script>
    <script src="./includes/js/main.js"></script>

</body>
</html>