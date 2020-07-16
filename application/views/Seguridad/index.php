<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>RentCar - <?php echo $title ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center">
                <a class="navbar-brand" href="/rentcar/home">
                    <i class="fas fa-car"></i> RentCar App
                </a>
                <span class="splash-description">
                    Bienvenido al Sistema de Gestión de Renta de Vehiculos
                </span>
            </div>
            <div class="card-body">
                <?php echo form_open('seguridad'); ?>
                    <div class="form-group">
                        <?php echo form_error('usuario', '<div class="alert alert-danger">', '</div>'); ?>
                        <input class="form-control form-control-lg" id="usuario" name="usuario" type="text" placeholder="Usuario" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <?php echo form_error('clave', '<div class="alert alert-danger">', '</div>'); ?>
                        <input class="form-control form-control-lg" id="clave" name="clave" type="password" placeholder="Clave"><br>
                        <?php 
                            if (isset($error)){
                                echo "<div class='alert alert-danger'>$error</div>";
                            } 
                        ?>
                    </div>
                    <!--
                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                            </label>
                        </div>
                    -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Iniciar Sesión</button>

                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a id="olvidar" href="#">¿Olvido su contraseña?</a>
                    <!--
                        <a href="#" class="footer-link">Create An Account</a></div>
                        <div class="card-footer-item card-footer-item-bordered">
                            <a href="#" class="footer-link">Forgot Password</a>
                        </div>
                    -->
                    </div>
            </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?php echo base_url(); ?>/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script>
    $( document ).ready(function() {
        $("#olvidar").click(function() {
            alert("Pongase en contacto con el Administrador del Portal")
        }); 
    });
    </script>
</body>
 
</html>