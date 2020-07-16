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
        <?php if(isset($rentadevolucion)) : ?>
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-xl-offset-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-flex justify-content-between align-items-center mb-0">
                        <span class="text-muted">Detalle del Proceso de Renta</span>
                        <!--
                            <span class="badge badge-secondary badge-pill">3</span>
                        -->
                    </h4>
                </div>
                <div class="card-body">
                    <?php echo form_open('devolucion/proceso/'.$rentadevolucion->id); ?>  
                    <div class="alert alert-warning">Esta accion es irreversible una vez se complete.</div>
                    <?php echo form_error('idRenta', '<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo form_error('comentario', '<div class="alert alert-danger">', '</div>'); ?>

                    <ul class="list-group mb-3">
                        <input class="" style="" type="text" id="idRenta" name="idRenta" value="<?php echo $rentadevolucion->id ?>" placeholder="" readonly hidden>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0">Vehiculo</h6>
                                <h6 class="my-0">(Precio/Día al Momento de la Renta)</h6>
                                <small class="text-muted"><?php echo $vehiculo->marca." ".$vehiculo->modelo ?></small>
                            </div>
                            <span class="">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="montopordia_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: right;" type="text" id="montopordia" name="montopordia" aria-describedby="montopordia_groupprepend"  value="<?php echo number_format(($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*18)),2) ?>" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="">
                                <h6 class="my-0">Dias Transcurridos</h6>
                                <div>
                                    <input style="width: 90%" class="form-control" type="text" id="cantidaddias" name="cantidaddias" value="<?php
                                        $fechahoy = new DateTime('today', new DateTimeZone('America/Caracas'));
                                        $fechaseleccionada = new DateTime($rentadevolucion->fecharenta, new DateTimeZone('America/Caracas'));
                                        $segundosdiferencia = (strtotime($fechahoy->format('Y-m-d')))-(strtotime($fechaseleccionada->format('Y-m-d')));
                                        $cantidaddias = ($segundosdiferencia/86400 == 0)?1:$segundosdiferencia/86400; 
                                        echo $cantidaddias;
                                     ?>" readonly>
                                </div>
                            </span>
                            <span class="">
                                <div>
                                    <h6 class="my-0">Fecha de Renta</h6>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fechalimite_groupprepend"><i class="fas fa-calendar-alt"></i></span>
                                        </div>
                                        <input style="" class="form-control" type="date" id="fecharenta" name="fecharenta" value="<?php echo (new DateTime($rentadevolucion->fecharenta, new DateTimeZone('America/Caracas')))->format('Y-m-d');?>" aria-describedby="fecharenta_groupprepend"  placeholder="" readonly>
                                    </div>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="">  
                                <h6 class="my-0">Fecha de Hoy</h6>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="fechalimite_groupprepend"><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <input style="" class="form-control" type="date" id="fechalimite" name="fechalimite" value="<?php echo (new DateTime('today', new DateTimeZone('America/Caracas')))->format('Y-m-d');?>" aria-describedby="fechalimite_groupprepend"  placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="">  
                                <h6 class="my-0">Cliente</h6>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="cliente_groupprepend"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: left;" type="text" id="cliente" name="cliente" aria-describedby="cliente_groupprepend"  value="<?php echo $cliente->nombre.' '.$cliente->apellido.' - '.$cliente->cedula; ?>" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item">
                            <span class="">  
                                <h6 class="my-0">Atendido por:</h6>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="cliente_groupprepend"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: left;" type="text" id="cliente" name="cliente" aria-describedby="cliente_groupprepend"  value="<?php echo $empleado->nombre.' '.$empleado->apellido; ?>" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0">Subtotal</h6>
                                <small class="text-muted">Cantidad de días x Precio por Dia</small>
                            </div>
                            <span class="text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="subtotal_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: right;" type="text" id="subtotal" name="subtotal" aria-describedby="subtotal_groupprepend"  value="<?php echo number_format((($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*18))*$cantidaddias),2) ?>" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <div class="text-muted">
                                <h6 class="my-0">Impuesto Total</h6>
                                <small>ITBIS (18%)</small>
                            </div>
                            <span class="text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="impuesto_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: right;" type="text" id="impuesto" name="impuesto" aria-describedby="impuesto_groupprepend"  value="<?php echo number_format((($rentadevolucion->montopordia-(($rentadevolucion->montopordia/118)*100))*$cantidaddias),2) ?>" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (RD$)</span>
                            <strong>
                                <span class="text-muted">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="total_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input class="form-control" style="text-align: right;" type="text" id="total" name="total" aria-describedby="total_groupprepend"  value="<?php echo number_format($rentadevolucion->montopordia*$cantidaddias, 2) ?>" placeholder="" readonly>
                                    </div>
                                </span>
                            </strong>
                        </li>
                        <li class="list-group-item">
                            <span class="">  
                                <h6 class="my-2">Comentario:</h6>
                                <textarea style="resize: none;" class="form-control" id="comentario" name="comentario" placeholder="Escriba un comentario (Opcional)" rows="5" autocomplete="off"></textarea>
                            </span>
                        </li>
                    </ul>
                    <button type="submit" onclick="return confirm('¿Esta seguro que desea realizar la transaccion?');" class="btn btn-warning btn-lg btn-block">Confirmar Transaccion</button> 
                    <a class="btn btn-primary btn-lg btn-block" href="/rentcar/devolucion">Volver a Rentas Pendientes por Devolucion</a>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!--
        </div>
        <div class="row justify-content-center">
        -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-xl-offset-4">
            <div class="card">
                <img class="img-fluid" src="/rentcar/archivos/<?php echo $vehiculo->foto ?>" alt="Card image cap">
                <div class="card-body">
                    <div class="product-price"><?php echo $vehiculo->marca ?></div>
                    <h2 class="card-title"><?php echo $vehiculo->modelo ?></h2>
                    <h3 class="mb-0 text-primary">$<?php echo $vehiculo->montopordia ?>/día</h3>
                    <p class="card-text"><?php echo $vehiculo->descripcion ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">  
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <h5 class="mb-1">No. Placa</h5>
                                <p><?php echo $vehiculo->no_placa ?></p>
                            </div> 
                            <div class="col-xl-5 col-lg-5 col-md-12">
                                <h5 class="mb-1">No. Chasis</h5>
                                <p><?php echo $vehiculo->no_chasis ?></p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <h5 class="mb-1">No. Motor</h5>
                                <p><?php echo $vehiculo->no_motor ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">  
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <h5 class="mb-1">Tipo de Combustible</h5>
                                <p><?php echo $vehiculo->tipocombustible ?></p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <h5 class="mb-1">Tipo de Vehiculo</h5>
                                <p><?php echo $vehiculo->tipovehiculo ?></p>
                            </div>
                        </div> 
                    </li>
                </ul>
                <div class="">
                     
                </div>
            </div>
        </div>
        <?php else : ?>
            <p>Este Renta no existe o esta inactiva<p>
        <?php endif; ?>
    </div>
</div>
<script>
   restaFechas = function()
    {
        // To set two dates to two variables 
        var date1 = new Date(); 
        date1.setHours(0,0,0,0)
        var date2 = new Date(document.getElementById("fechalimite").value); 
        date2.setDate(date2.getDate()+1);
        date2.setHours(0,0,0,0)

        // To calculate the time difference of two dates 
        var Difference_In_Time = date2.getTime() - date1.getTime(); 
        //console.log('Fecha 1: '+date1);
        //console.log('Fecha 2: '+date2);

        // To calculate the no. of days between two dates 
        var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24); 

        //To display the final no. of days (result) 
        //console.log('Diferencia en dias: '+Difference_In_Days);
        document.getElementById("cantidaddias").value = Difference_In_Days;
    }
    calcular = function()
    {
        var montopordia = parseFloat(document.getElementById("montopordia").value).toFixed(2);
        var cantidadDias =  parseInt(document.getElementById("cantidaddias").value, 10);
        var subtotal = parseFloat(cantidadDias*montopordia).toFixed(2);
        var impuesto = parseFloat(subtotal*0.18).toFixed(2);
        var total = parseFloat(subtotal)+parseFloat(impuesto);

        document.getElementById("subtotal").value = subtotal;
        document.getElementById("impuesto").value = impuesto;
        document.getElementById("total").value = parseFloat(total).toFixed(2);

        console.log(subtotal);
        console.log(impuesto);
        console.log(total);
    }
    completarCampos = function()
    {
        //restaFechas();
        //calcular();    
    }
    //completarCampos();
</script>