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
    <!-- ============================================================== -->
    <!-- basic form  -->
    <!-- ============================================================== -->
    <div class="row justify-content-center">
        <?php if(isset($rentadevolucion)) : ?>
        <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card" id="detalleFactura">
                <div class="card-header p-4">
                    <div class="navbar-brand pt-1 d-inline-block" ><i class="fas fa-car"></i> RentCar App</div>
                    <div class="float-right"> 
                        <h3 class="mb-0">Ref #<?php echo $rentadevolucion->id ?></h3>
                        <?php
                            $dias = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
                            $mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                            echo $dias[date('w', strtotime($rentadevolucion->fecharenta))].", ".date('d', strtotime($rentadevolucion->fecharenta))." de ".$mes[date('m', strtotime($rentadevolucion->fecharenta))-1]." del ".date('Y', strtotime($rentadevolucion->fecharenta)); 
                        ?>
                        <br><a href="" onclick="printMe()" class="btn btn-sm btn-primary"><i class="far fa-file-pdf"></i> Descargar PDF</a>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($rentadevolucion->estado == "1") : ?>
                        <div class="alert alert-info">El cargo de la factura esta sujeto a cambios si el día de entrega del vehiculo es diferente a la establecida en este comprobante.</div>
                    <?php endif; ?>
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-1">Emisor:</h5>                                            
                            <h3 class="text-dark mb-1">Compañia RentCar</h3>
                            
                            <div>Av. Jacobo Majluta</div>
                            <div>Colinas del Arroyo II, No. 11</div>
                            <div>Santo Domingo Norte, R.D.</div>
                            <div>Atendido por: <?php echo $empleado->nombre." ".$empleado->apellido ?></div>
                        </div>
                        <div class="col-sm-6">
                            <h5 class="mb-1">Receptor:</h5>
                            <h3 class="text-dark mb-1"><?php echo $cliente->nombre." ".$cliente->apellido ?></h3>                                            
                            <div>Tipo de Persona: <?php echo ($cliente->tipopersona == "0")?"Física":"Jurídica"; ?></div>
                            <?php if($cliente->tipopersona == "1") : ?>
                            <div>Fecha de  <?php echo $cliente->cedula ?></div>
                            <?php endif; ?>
                            <div>Fecha de Renta: <?php echo date('d/m/Y', strtotime($rentadevolucion->fecharenta))?></div>
                            <div>Fecha de Entrega<?php echo ($rentadevolucion->estado=="1")?" (Provisional) ":"" ?>: <?php echo date('d/m/Y', strtotime($rentadevolucion->fechadevolucion)) ?></div>
                        </div>
                    </div>
                    
                    <?php if(($rentadevolucion->comentario !== "")&&($rentadevolucion->comentario !== NULL)) : ?>
                    <div class="alert alert-warning"><strong>Nota: </strong><?php echo $rentadevolucion->comentario?></div>
                    <?php endif; ?>
                    <div class="table-responsive-sm">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Vehiculo</th>
                                    <th>Combustible</th>
                                    <th class="">Tipo</th>
                                    <th class="">Placa</th>
                                    <th class="">Dias</th>
                                    <th class="">Precio x Dia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class=""><?php echo $vehiculo->marca." ".$vehiculo->modelo; ?></td>
                                    <td class=""><?php echo $vehiculo->tipocombustible; ?></td>
                                    <td class=""><?php echo $vehiculo->tipovehiculo; ?></td>
                                    <td class=""><?php echo $vehiculo->no_placa; ?></td>
                                    <td class=""><?php echo $rentadevolucion->cantidaddias; ?></td>
                                    <td class=""><?php echo "$".number_format(($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*18)), 2) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-sm-5">
                        </div>
                        <div class="col-lg-4 col-sm-5 ml-auto">
                            <table class="table table-clear">
                                <tbody>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Subtotal</strong>
                                        </td>
                                        <td class="right"><?php echo "$".number_format((($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*18))*$rentadevolucion->cantidaddias),2);?></td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">ITBIS (18%)</strong>
                                        </td>
                                        <td class="right"><?php echo "$".number_format(((($rentadevolucion->montopordia/118)*18)*$rentadevolucion->cantidaddias),2);?></td>
                                    </tr>
                                    <tr>
                                        <td class="left">
                                            <strong class="text-dark">Total</strong>
                                        </td>
                                        <td class="right">
                                            <strong class="text-dark"><?php echo "$".number_format(($rentadevolucion->montopordia*$rentadevolucion->cantidaddias),2); ?></strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <p class="pt-2 d-inline-block">Gracias por Preferirnos - RentCarApp <?php echo (new DateTime("today"))->format("Y");?></p>
                    <div class="float-right">
                        <a <?php echo ($rentadevolucion->estado == "1")?"href='/rentcar/devolucion'":"href='/rentcar/renta/detalle'";?> class="btn btn-primary">Volver Listado de Rentas <?php echo ($rentadevolucion->estado == "1")?"Provisionales":"Historico"; ?></a>
                    </div>
                </div>
            </div>
        </div>
        <?php else : ?>
            <p>Esta Factura No Existe<p>
        <?php endif; ?>
    </div>
    <!-- Reporte Hidden -->
    <div style="display: none">   
        <div id="rptPDF"> 
            <h1>RentCar APP</h1>
            <h3>Ref #<?php echo $rentadevolucion->id ?></h3>
            <?php
                $dias = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
                $mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                echo "<p>".$dias[date('w', strtotime($rentadevolucion->fecharenta))].", ".date('d', strtotime($rentadevolucion->fecharenta))." de ".$mes[date('m', strtotime($rentadevolucion->fecharenta))-1]." del ".date('Y', strtotime($rentadevolucion->fecharenta))."</p>"; 
                ?>
            <hr>    
                <h5>Emisor:</h5>                                            
                <h3>Compañia RentCar</h3>
                <p>Av. Jacobo Majluta</p>
                <p>Colinas del Arroyo II, No. 11</p>
                <p>Santo Domingo Norte, R.D.</p>
                <p>Atendido por: <?php echo $empleado->nombre." ".$empleado->apellido ?></p>
            <hr>
                <h5>Receptor:</h5>
                <h3><?php echo $cliente->nombre." ".$cliente->apellido ?></h3>                                            
                <p>Tipo de Persona: <?php echo ($cliente->tipopersona == "0")?"Física":"Jurídica"; ?></p>
                <?php if($cliente->tipopersona == "1") : ?>
                <p>Fecha de  <?php echo $cliente->cedula ?></p>
                <?php endif; ?>
                <p>Fecha de Renta: <?php echo date('d/m/Y', strtotime($rentadevolucion->fecharenta))?></p>
                <p>Fecha de Entrega<?php echo ($rentadevolucion->estado=="1")?" (Provisional) ":"" ?>: <?php echo date('d/m/Y', strtotime($rentadevolucion->fechadevolucion)) ?></p>
            <hr>
            <table border="1">
                <thead>
                    <tr>
                        <th>Vehiculo</th>
                        <th>Combustible</th>
                        <th>Tipo</th>
                        <th>Placa</th>
                        <th>Dias</th>
                        <th>Precio x Dia</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $vehiculo->marca." ".$vehiculo->modelo; ?></td>
                        <td><?php echo $vehiculo->tipocombustible; ?></td>
                        <td><?php echo $vehiculo->tipovehiculo; ?></td>
                        <td><?php echo $vehiculo->no_placa; ?></td>
                        <td><?php echo $rentadevolucion->cantidaddias; ?></td>
                        <td><?php echo "$".number_format(($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*18)), 2) ?></td>
                    </tr>
                    <tr>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td>
                            <stron>Subtotal</strong>
                        </td>
                        <td><?php echo "$".number_format((($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*18))*$rentadevolucion->cantidaddias),2);?></td>
                    </tr>
                    <tr>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td>
                            <strong>ITBIS (18%)</strong>
                        </td>
                        <td><?php echo "$".number_format(((($rentadevolucion->montopordia/118)*18)*$rentadevolucion->cantidaddias),2);?></td>
                    </tr>
                    <tr>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td style="visibility:hidden;"></td>
                        <td>
                            <strong>Total</strong>
                        </td>
                        <td>
                            <strong><?php echo "$".number_format(($rentadevolucion->montopordia*$rentadevolucion->cantidaddias),2); ?></strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            <p>Gracias por Preferirnos - RentCarApp <?php echo (new DateTime("today"))->format("Y");?></p>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
    <!-- ============================================================== -->
</div>
<script src="<?php echo base_url(); ?>assets/libs/js/jspdf.min.js"></script>
<script src="<?php echo base_url(); ?>assets/libs/js/html2canvas.js"></script>
<script>    
function printMe() {
    var element = document.getElementById("rptPDF");
     var printContent = element.innerHTML;
     var originalContent = window.document.body.innerHTML;
     window.document.body.innerHTML = printContent;
     window.print();
     window.document.body.innerHTML = originalContent;
}

</script>