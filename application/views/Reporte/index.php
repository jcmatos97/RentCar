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
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <?php echo form_open_multipart('reporte/'); ?>
            <div class="card">
                <h5 class="card-header">
                    Usar Parametros de Busqueda
                    <div class="switch-button switch-button-xs">
                        <input type="checkbox" onchange="handleChange(this)" name="isEnabledSearch" id="isEnabledSearch" <?php echo ($isEnabledSearch == "1")?"checked":"" ?>>
                        <span><label for="isEnabledSearch"></label></span>
                    </div>            
                </h5>
                <div id="formFiltroReporte" <?php echo ($isEnabledSearch == "1")?"style='display: '":"style='display: none'" ?>>
                <div class="card-body">
                        <div class="form-row">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="vehiculo">Vehiculo</label>
                                <?php echo form_error('vehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" style="text-align: ;" class="form-control" id="vehiculo" name="vehiculo" <?php if(isset($fieldsSearched->vehiculo)){echo "value='".$fieldsSearched->vehiculo."'";}?> placeholder="Digite un Marca o Modelo de Vehiculo" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="no_placa">No. Placa</label>
                                <?php echo form_error('no_placa', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" style="text-align: ;" class="form-control" id="no_placa" name="no_placa" <?php if(isset($fieldsSearched->no_placa)){echo "value='".$fieldsSearched->no_placa."'";}?> placeholder="Digite un Numero de placa" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="cliente">Cliente</label>
                                <?php echo form_error('cliente', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" style="text-align: ;" class="form-control" id="cliente" name="cliente" <?php if(isset($fieldsSearched->cliente)){echo "value='".$fieldsSearched->cliente."'";}?>  placeholder="Digite el Nombre de un Cliente" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="empleado">Empleado</label>
                                <?php echo form_error('empleado', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" style="text-align: ;" class="form-control" id="empleado" name="empleado" <?php if(isset($fieldsSearched->empleado)){echo "value='".$fieldsSearched->empleado."'";}?>  placeholder="Digite el Nombre de un Empleado" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="montototalmin">Monto Total Minimo</label>
                                <?php echo form_error('montototalmin', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="number" style="text-align: right;" class="form-control" id="montototalmin" name="montototalmin" <?php if(isset($fieldsSearched->montototalmin)){echo "value='".$fieldsSearched->montototalmin."'";}?> placeholder="Introduzca un Monto Minimo" autocomplete="off">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="montototalmax">Monto Total Maximo</label>
                                <?php echo form_error('montototalmax', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="number" style="text-align: right;" class="form-control" id="montototalmax" name="montototalmax" <?php if(isset($fieldsSearched->montototalmax)){echo "value='".$fieldsSearched->montototalmax."'";}?> placeholder="Introduzca un Monto Maximo" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="fecharentamin">Fecha Renta Desde</label>
                                <?php echo form_error('fecharentamin', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="date" style="text-align: right;" class="form-control" id="fecharentamin" name="fecharentamin" <?php if(isset($fieldsSearched->fecharentamin)){echo "value='".$fieldsSearched->fecharentamin."'";}?> placeholder="" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="fecharentamax">Fecha Renta Hasta</label>
                                <?php echo form_error('fecharentamax', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="date" style="text-align: right;" class="form-control" id="fecharentamax" name="fecharentamax" <?php if(isset($fieldsSearched->fecharentamax)){echo "value='".$fieldsSearched->fecharentamax."'";}?> placeholder="" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="fechadevoluciondmin">Fecha Devolucion Desde</label>
                                <?php echo form_error('fechadevoluciondmin', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="date" style="text-align: right;" class="form-control" id="fechadevoluciondmin" name="fechadevoluciondmin" <?php if(isset($fieldsSearched->fechadevoluciondmin)){echo "value='".$fieldsSearched->fechadevoluciondmin."'";}?>  placeholder="" autocomplete="off">
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mb-2">
                                <label for="fechadevoluciondmax">Fecha Devolucion Hasta</label>
                                <?php echo form_error('fechadevoluciondmax', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="date" style="text-align: right;" class="form-control" id="fechadevoluciondmax" name="fechadevoluciondmax" <?php if(isset($fieldsSearched->fechadevoluciondmax)){echo "value='".$fieldsSearched->fechadevoluciondmax."'";}?>  placeholder="" autocomplete="off">
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Buscar</button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 col-xl-offset-2">
            <div class="card">
                <h5 class="card-header">Historico de Rentas</h5>
                <div class="card-body">
                    <div class="table-responsive ">
                        <table id="example" class="table table-bordered" style="">
                            <thead>
                                <tr>
                                    <th>Ref</th>
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
                                                echo "<td>".$fila->id."</td>";
                                                echo "<td>".$fila->vehiculo."</td>";
                                                echo "<td>".$fila->placa."</td>";
                                                echo "<td>".$fila->cliente."</td>";
                                                echo "<td>".$fila->empleado."</td>";
                                                echo "<td>".((new DateTime($fila->fecharenta))->format("d/m/Y"))."</td>";
                                                echo "<td>".((new DateTime($fila->fechadevolucion))->format("d/m/Y"))."</td>";
                                                echo "<td> $".number_format(($fila->montototal), 2)."</td>";
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
            },
            {
                extend: 'excelHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
            },
            {
                extend: 'csvHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
            },
            {
                extend: 'pdfHtml5',
                footer: false,
                exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]
                    }
            }         
        ]  
    } );
} );   

function handleChange(checkbox) 
{
    if(checkbox.checked == true)
    {
        //alert("prendido");
        document.getElementById("formFiltroReporte").style.display = "";
    }
    else
    {
        //alert("apagado");
        document.getElementById("formFiltroReporte").style.display = "none";
    }
}
</script>
</body>
 
</html>           
           
           