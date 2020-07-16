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
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="<?php echo base_url()?>/assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/libs/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url()?>/assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
       <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="/rentcar/home"><i class="fas fa-car"></i> RentCar App</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="fas fa-align-justify" aria-hidden="true"></i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        
                        <li class="nav-item">
                            <a class="nav-link">Bienvenido <?php echo $usuario; ?>!</a>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url()?>/assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">
                                    <?php echo $nombre.' '.$apellido; ?>
                                    </h5>
                                </div>
                                <!--
                                <a class="dropdown-item" href="/rentcar/configuracion"><i class="fas fa-user mr-2"></i>Configuración de Cuentas</a>
                                    <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Configuracion</a>-->
                                <a class="dropdown-item" href="/rentcar/seguridad/cerrarsesion"><i class="fas fa-power-off mr-2"></i>Cerrar Sesión</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
      <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Menú</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Tablero
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rentcar/home" aria-expanded="false"><i class="fas fa-tachometer-alt"></i>Tablero Principal </a>
                            </li>
                            <li class="nav-divider">
                                Gestion de Información
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1" aria-controls="submenu-1"><i class="fas fa-car"></i>Vehiculos <span class="badge badge-success">6</span></a>
                                <div id="submenu-1" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-1" aria-controls="submenu-1-1">Tipos</a>
                                            <div id="submenu-1-1" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/tipovehiculo/agregar">Agregar Tipo</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/tipovehiculo">Gestionar Tipos</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-2" aria-controls="submenu-1-2">Marcas</a>
                                            <div id="submenu-1-2" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/marcavehiculo/agregar">Agregar Marca</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/marcavehiculo">Gestionar Marcas</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-3" aria-controls="submenu-1-3">Modelos</a>
                                            <div id="submenu-1-3" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/modelovehiculo/agregar">Agregar Modelo</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/modelovehiculo">Gestionar Modelos</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-4" aria-controls="submenu-1-4">Combustibles</a>
                                            <div id="submenu-1-4" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/tipocombustible/agregar">Agregar Tipo de Combustible</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/tipocombustible">Gestionar Tipos de Combustible</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-1-5" aria-controls="submenu-1-5">Vehiculos</a>
                                            <div id="submenu-1-5" class="collapse submenu" style="">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/vehiculo/agregar">Agregar Vehiculo</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="/rentcar/vehiculo">Gestionar Vehiculos</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-users"></i>Clientes</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/rentcar/cliente/agregar">Agregar Cliente</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/rentcar/cliente">Gestionar Clientes</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-divider">
                                Actividades 
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-shipping-fast"></i>Rentar un Vehiculo </a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/rentcar/renta">Realizar Renta</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/rentcar/renta/detalle">Historico de Rentas</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rentcar/devolucion" aria-expanded="false"><i class="fas fa-calendar-check"></i>Devolucion de un Vehiculo </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rentcar/inspeccion" aria-expanded="false"><i class="fas fa-search"></i>Proceso de Inspeccion </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/rentcar/reporte" aria-expanded="false"><i class="fas fa-file"></i>Reportes</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                <!-- ============================================================== -->
                <!-- pageheader -->
                <!-- ============================================================== -->
                
