<?php
    session_start();

    if(isset($_SESSION['usuario'])){
        if(!isset($_SESSION['rol'])){
            header('Location: ./index.php');
        }else{
            if($_SESSION['rol'] != 'admin'){
                header('Location: ./index.php');
            }
        }
    }else{
        header('Location: ./index.php');
    }
    
    $id =$_SESSION['id'];
    $user= $_SESSION['usuario'];
    $rol = $_SESSION['rol'];
    $phone = $_SESSION['phone'];
    $email = $_SESSION['email'];
    $separador = " ";
    $inicial = explode($separador, $user);
    $firstname = $inicial[0];
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
    <title>Dashboard</title>
</head>
<body class="dashboard">
    <!-- #HEADER -->

    <header class="header" data-header>
        <div class="container">

            <h1><a href="#" class="logo">LOGO</a></h1>

            <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
                <span class="material-symbols-rounded  icon">menu</span>
            </button>

            <nav class="navbar">
                <div class="container">

                    <ul class="navbar-list">
                        <li>
                            <a href="#" class="navbar-link active icon-box">
                                <span class="material-symbols-rounded  icon">grid_view</span>
                                <span>Home</span>
                            </a>
                        </li>

                        <li>
                            <a href="#product" class="navbar-link icon-box">
                                <span class="material-symbols-rounded  icon">Inventory</span>
                                <span>Productos</span>
                            </a>
                        </li>

                        <li>
                            <a href="#task" class="navbar-link icon-box">
                                <span class="material-symbols-rounded  icon">list</span>
                                <span>Pedidos</span>
                            </a>
                        </li>
                    </ul>

                    <!-- user profile -->
                    <ul class="user-action-list">
                        <li>
                            <a href="#" class="header-profile">
                                <figure class="profile-avatar">
                                    <img src="./assets/img/user.png" alt="user" width="32" height="32">
                                </figure>

                                <div>
                                    <p class="profile-title" id="profile-name"><?php echo $firstname ?></p>
                                    <p class="profile-subtitle" id='profile-rol'><?php echo $rol ?></p>
                                </div>
                            </a>
                        </li>

                        <li>
                            <a id="logout" class="notification icon-box" value="logout">
                                <span class="material-symbols-rounded  icon">Logout</span>
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>
        </div>
    </header>





    <main>
        <article class="container article">

            <h2 class="h2 article-title">Hola <?php echo $user ?></h2>
            <p class="article-subtitle">Bienvenido al Dashboard!</p>

        <!--  #HOME -->
        <section class="home" id="home">
            <div class="card profile-card">
                <!-- profile card  -->
                <div class="profile-card-wrapper">
                    <figure class="card-avatar">
                        <img src="./assets/img/user.png" alt="User" width="48" height="48">
                    </figure>

                    <div>
                        <p class="card-title"><?php echo $user ?></p>
                        <p class="card-subtitle"><?php echo $rol ?></p>
                    </div>

                </div>

                <ul class="contact-list">

                    <li>
                        <a href="#" class="contact-link icon-box">
                            <span class="material-symbols-rounded  icon">mail</span>
                            <p class="text"><?php echo $email ?></p>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="contact-link icon-box">
                            <span class="material-symbols-rounded  icon">call</span>
                            <p class="text"><?php echo $phone ?></p>
                        </a>
                    </li>

                </ul>

                <div class="divider card-divider"></div>

                <ul class="revenue-list">
                    <li class="revenue-item icon-box">
                        <span class="material-symbols-rounded  icon  green">People</span>
                        <div>
                            <data class="revenue-item-data" value="15">150</data>
                            <p class="revenue-item-text">Usuarios</p>
                        </div>
                    </li>

                    <li class="revenue-item icon-box">
                        <span class="material-symbols-rounded  icon green">List_Alt</span>
                        <div>
                            <data class="revenue-item-data" value="10">100</data>
                            <p class="revenue-item-text">Pedidos</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="card profile-card">
                <div>
                    <h2 class="section-title">Usuarios</h2>
                </div>
                <div class="divider card-divider"></div>
                <table id="last-orders">
                    <thead>
                        <tr>
                            <td scope="col">id</td>
                            <td scope="col">nombre</td>
                            <td scope="col">email</td>
                            <td scope="col">telefono</td>
                            <td scope="col">rol</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            
        </section>

        <!--  #PRODUCTOS -->
        <section class="product" id="product">
            <div class="section-title-wrapper">
                <h2 class="section-title">Productos</h2>

                <button class="btn btn-link icon-box button" id="one">
                    <span>Nuevo Producto</span>
                    <span class="material-symbols-rounded  icon" aria-hidden="true">Add</span>
                </button>
            </div>

            <div class="product-gallery" id="product-gallery"></div>
        </section>

        <!-- PEDIDOS -->
        <section class="tasks" id="task">
            <div class="section-title-wrapper">
                <h2 class="section-title">Pedidos</h2>
            </div>

            <div class="task_table">
                <table id="task_table">
                    <thead>
                        <tr>
                            <td scope="col">id</td>
                            <td scope="col">cliente</td>
                            <td scope="col">email</td>
                            <td scope="col">telefono</td>
                            <td scope="col">producto</td>
                            <td scope="col">descripción</td>
                            <td scope="col">modelo</td>
                            <td scope="col">estado</td>
                            <td scope="col">Opcion</td>
                        </tr>
                    </thead>
                    <tbody class="table_body" id="table_body">
                        
                    </tbody>
                </table>
                
            </div>
            

        </section>


    </main>


    <!-- Modal Agregar Productos -->
    <?php include_once "./templates/product.php" ?>

     <!-- Modal Agregar Productos -->
     <?php include_once "./templates/updest.php" ?>

    <!-- Jquery link -->
    <script src="./includes/js/jquery.js"></script>

    <!-- custom js link -->
    <script src="./includes/js/main.js"></script>

  
</body>
</html>