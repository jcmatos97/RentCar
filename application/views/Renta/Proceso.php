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
        <?php if(isset($datashow)) : ?>
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
                    <?php echo form_open('renta/proceso/'.$datashow->id); ?>  
                    <div class="alert alert-info">El cargo de la factura esta sujeto a cambios si el día de entrega del vehiculo es diferente a la establecida ahora.</div>
                    <?php echo form_error('idCarro', '<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo form_error('fechalimite', '<div class="alert alert-danger">', '</div>'); ?>
                    <?php echo form_error('cliente', '<div class="alert alert-danger">', '</div>'); ?>

                    <ul class="list-group mb-3">
                        <input class="" style="" type="text" id="idCarro" name="idCarro"  value="<?php echo $datashow->id ?>" placeholder="" readonly hidden>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <h6 class="my-0">Vehiculo (Precio/Día)</h6>
                                <small class="text-muted"><?php echo $datashow->marca." ".$datashow->modelo ?></small>
                            </div>
                            <span class="">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="montopordia_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: right;" type="text" id="montopordia" name="montopordia" aria-describedby="montopordia_groupprepend"  value="<?php echo $datashow->montopordia ?>" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span class="">
                                <div>
                                    <h6 class="my-0">Dias a Rentar</h6>
                                    <input style="width: 90%" class="form-control" type="text" id="cantidaddias" name="cantidaddias" placeholder="0" readonly>
                                </div>
                            </span>
                            <span class="">
                                <div>
                                    <h6 class="my-0">Fecha Limite</h6>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="fechalimite_groupprepend"><i class="fas fa-calendar-alt"></i></span>
                                            <input style="width:100%" class="form-control" type="date" id="fechalimite" name="fechalimite" onchange="completarCampos()" value="<?php echo (new DateTime('tomorrow', new DateTimeZone('America/Caracas')))->format('Y-m-d');?>" aria-describedby="fechalimite_groupprepend"  placeholder="">
                                        </div>
                                    </div>
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
                                    <input class="form-control" style="text-align: right;" type="text" id="subtotal" name="subtotal" aria-describedby="subtotal_groupprepend"  value="0" placeholder="" readonly>
                                </div>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="cliente_groupprepend"><i class="fas fa-user"></i></span>
                                    </div>
                                    <select class="form-control" name="cliente" id="cliente">
                                        <option selected disabled hidden>Escoga un Cliente</option>
                                        <?php
                                            foreach($clientes as $cliente)
                                            {
                                                echo '<option value="'.$cliente->id.'">'.$cliente->nombre.' '.$cliente->apellido.' - '.$cliente->cedula.'</option>';
                                            }
                                            ?>
                                    </select>
                                </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-muted">
                                <h6 class="my-0">Impuesto Total</h6>
                                <small>ITBIS (18%)</small>
                            </div>
                            <span class="text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="impuesto_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input class="form-control" style="text-align: right;" type="text" id="impuesto" name="impuesto" aria-describedby="impuesto_groupprepend"  value="0" placeholder="" readonly>
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
                                        <input class="form-control" style="text-align: right;" type="text" id="total" name="total" aria-describedby="total_groupprepend"  value="0" placeholder="" readonly>
                                    </div>
                                </span>
                            </strong>
                        </li>
                    </ul>
                    <button type="submit" onclick="return confirm('¿Esta seguro que desea realizar la transaccion?');" class="btn btn-primary btn-lg btn-block">Confirmar Transaccion</button> 
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
                <img class="img-fluid" src="/rentcar/archivos/<?php echo $datashow->foto ?>" alt="Card image cap">
                <div class="card-body">
                    <div class="product-price"><?php echo $datashow->marca ?></div>
                    <h2 class="card-title"><?php echo $datashow->modelo ?></h2>
                    <h3 class="mb-0 text-primary">$<?php echo $datashow->montopordia ?>/día</h3>
                    <p class="card-text"><?php echo $datashow->descripcion ?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">  
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <h5 class="mb-1">No. Placa</h5>
                                <p><?php echo $datashow->no_placa ?></p>
                            </div> 
                            <div class="col-xl-5 col-lg-5 col-md-12">
                                <h5 class="mb-1">No. Chasis</h5>
                                <p><?php echo $datashow->no_chasis ?></p>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <h5 class="mb-1">No. Motor</h5>
                                <p><?php echo $datashow->no_motor ?></p>
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">  
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <h5 class="mb-1">Tipo de Combustible</h5>
                                <p><?php echo $datashow->tipocombustible ?></p>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12">
                                <h5 class="mb-1">Tipo de Vehiculo</h5>
                                <p><?php echo $datashow->tipovehiculo ?></p>
                            </div>
                        </div> 
                    </li>
                </ul>
                <div class="card-body">
                    <a class="btn btn-primary btn-lg btn-block" href="/rentcar/renta">Cambiar de Vehiculo a Rentar</a> 
                </div>
            </div>
        </div>
        <?php else : ?>
            <p>Este vehiculo no existe o esta inactivo<p>
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
        restaFechas();
        calcular();    
    }
    completarCampos();
</script>