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
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 col-xl-offset-2">
        <div class="card">
            <h5 class="card-header">Marcas de Vehiculo</h5>
            <div class="card-body">
                <div class="table-responsive ">
                    <table id="example" class="table table-bordered" style="">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($datashow))
                                {
                                    if (count($datashow) > 0)
                                    {
                                        foreach ($datashow as $value) {
                                            echo "<tr>";
                                            echo "<td>".$value->nombre."</td>";
                                            echo "<td align='right'>";
                                            echo "<div class='btn-group'>";
                                            echo "<a class='btn btn-sm btn-outline-light' href='/rentcar/marcavehiculo/actualizar/".$value->id."'>Actualizar</a>";
                                            echo "<a class='btn btn-sm btn-outline-light' href='/rentcar/marcavehiculo/eliminar/".$value->id."' onclick='return confirm(`¿Esta seguro que desea eliminar este registro?`);'>";
                                            echo "<i class='far fa-trash-alt'></i>";
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
                                <th>Nombre</th>
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
                        columns: [0]
                    }
            },
            {
                extend: 'excelHtml5',
                footer: false,
                exportOptions: {
                        columns: [0]
                    }
            },
            {
                extend: 'csvHtml5',
                footer: false,
                exportOptions: {
                        columns: [0]
                    }
            },
            {
                extend: 'pdfHtml5',
                footer: false,
                exportOptions: {
                        columns: [0]
                    }
            }         
        ]  
    } );
} );
</script>
</body>
 
</html>           
           