<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="page-header">
            <h2 class="pageheader-title"><?php echo $title ?> </h2>
            <div class="page-breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb"></ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- end pageheader -->
<!-- ============================================================== -->
<div>
    <div class="ecommerce-widget">
        <div class="row">
            <!-- ============================================================== -->
            <!-- sales  -->
            <!-- ============================================================== -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Ventas Totales</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">$<?php echo $ventasTotales; ?></h1>
                        </div>
                        <!--
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                            </div>
                        -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end sales  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- new customer  -->
            <!-- ============================================================== -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Numero de Rentas Realizadas</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1"><?php echo $numeroRentas; ?></h1>
                        </div>
                        <!--
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                            </div>
                        -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end new customer  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- visitor  -->
            <!-- ============================================================== -->
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Pendientes por Recaudar</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">$<?php echo $pendienteRecaudacion; ?></h1>
                        </div>
                        <!--
                            <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                            </div>
                        -->
                        </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end visitor  -->
            <!-- ============================================================== -->
        </div>
        <div class="row">
            <!-- ============================================================== -->
            <!-- recent orders  -->
            <!-- ============================================================== -->
            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Rentas Completadas más Recientes</h5>
                    <div class="card-body p-0">
                        <div class="table-responsive ">
                            <table id="example" class="table table-bordered" style="">
                                <thead>
                                    <tr>
                                        <th>Vehiculo</th>
                                        <th>Placa</th>
                                        <th>Cliente</th>
                                        <th>Empleado</th>
                                        <th>Fecha Renta</th>
                                        <th>Fecha Devolucion</th>
                                        <th>Monto Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($datashow))
                                        {
                                            if (count($datashow) > 0)
                                            {
                                                foreach ($datashow as $fila) 
                                                {
                                                    echo "<tr>";
                                                    echo "<td>".$fila->vehiculo->marca." ".$fila->vehiculo->modelo."</td>";
                                                    echo "<td>".$fila->vehiculo->no_placa."</td>";
                                                    echo "<td>".$fila->cliente->nombre." ".$fila->cliente->apellido."</td>";
                                                    echo "<td>".$fila->empleado->nombre." ".$fila->empleado->apellido."</td>";
                                                    echo "<td>".((new DateTime($fila->rentadevolucion->fecharenta))->format("d/m/Y"))."</td>";
                                                    echo "<td>".((new DateTime($fila->rentadevolucion->fechadevolucion))->format("d/m/Y"))."</td>";
                                                    echo "<td> $".number_format(($fila->rentadevolucion->montopordia*$fila->rentadevolucion->cantidaddias), 2)."</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<td colspan='2' align='center'>Sin Registros</td> ";
                                            }
                                            
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="9"><a href='/rentcar/renta/detalle' class="btn btn-outline-light float-right">Ir al Historico</a></td>
                                    </tr>
                                    <tr>
                                        <!--
                                        <th>Vehiculo</th>
                                        <th>Placa</th>
                                        <th>Cliente</th>
                                        <th>Empleado</th>
                                        <th>Fecha Renta</th>
                                        <th>Fecha Devolucion</th>
                                        <th>Monto Total</th>
                                        <th>Accion</th>
                                        -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end recent orders  -->
            <!-- ============================================================== -->
            <!-- total sale  -->
            <!-- ============================================================== -->
            <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <h5 class="card-header">Vehiculos más Rentados</h5>
                    <div class="card-body">
                        <canvas id="total-sale" width="220" height="155"></canvas>
                        <div class="chart-widget-list">
                            <?php foreach($vehiculosMasRentados as $key): ?>
                            <p>
                                <span class="fa-xs text-info mr-1 legend-title"></span> <span class="legend-text"> <?php echo $key->marca." ".$key->modelo ?></span>
                                <span class="float-right"><?php echo ($key->cantidad == 1)?$key->cantidad." vez":$key->cantidad." veces"; ?></span>
                            </p>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end total sale  -->
            <!-- ============================================================== -->
        </div>
    </div>
</div>
<?php 
    $strMarcaVehiculo = "";
    $quantity = "";
    foreach ($vehiculosMasRentados as $key) 
    {
        $strMarcaVehiculo = $strMarcaVehiculo."'".$key->marca." ".$key->modelo."',";
        $quantity = $quantity.$key->cantidad.",";
    }       
    ?>
</div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- 
                ============================================================== 
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            -->
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end main wrapper -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/libs/js/main-js.js"></script>
    <!-- chartjs js-->
    <script src="assets/vendor/charts/charts-bundle/Chart.bundle.js"></script>
        <script src="assets/vendor/charts/charts-bundle/chartjs.js"></script>
    <!-- ============================================================== -->
    <script>
    $(function() {
        "use strict";

        var ctx = document.getElementById("total-sale").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                
                data: {
                    labels: [<?php echo substr(trim($strMarcaVehiculo), 0, -1); ?>],
                    datasets: [{
                        backgroundColor: [
                            "#5969ff",
                            "#ff407b",
                            "#25d5f2",
                            "#ffc750",
                            "#70c24a"
                        ],
                        data: [<?php echo substr(trim($quantity), 0, -1);?>]
                    }]
                },
                options: {
                    legend: {
                        display: false

                    }
                }

            });
    });
    </script>
</body>
 
</html>

           