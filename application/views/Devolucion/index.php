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
<div class="row justify-content-center">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 col-xl-offset-2">
        <div class="card">
            <h5 class="card-header">Facturas de Renta Provisionales</h5>
            <div class="card-body">
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
                                <th>Accion</th>
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
                                            echo "<td align='center'>";
                                            echo "<div class='btn-group'>";
                                            echo "<a class='btn btn-sm btn-outline-light' href='/rentcar/devolucion/proceso/".$fila->rentadevolucion->id."'>";
                                            echo "Devolucion";
                                            echo "</a>";
                                            echo "<a class='btn btn-sm btn-outline-light' href='/rentcar/renta/detalle/".$fila->rentadevolucion->id."'>";
                                            echo "<i class='fa fa-search'></i>";
                                            echo "</a>";
                                            echo "</div>";
                                            echo "</td>";
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
                            <!--
                            <tr>
                                <th>Vehiculo</th>
                                <th>Placa</th>
                                <th>Cliente</th>
                                <th>Empleado</th>
                                <th>Fecha Renta</th>
                                <th>Fecha Devolucion</th>
                                <th>Monto Total</th>
                                <th>Accion</th>
                            </tr>
                            -->
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!------------------------------------------------------------------------------>

</div>
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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: 
        [
            {
                extend: 'copyHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
            },
            {
                extend: 'excelHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
            },
            {
                extend: 'csvHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
            },
            {
                extend: 'pdfHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
            }         
        ]  
    } );
} );
</script>
</body>
 
</html>           
           
           