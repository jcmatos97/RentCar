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
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 col-xl-offset-2">
            <div class="card">
                <h5 class="card-header">Datos Personales</h5>
                <?php echo form_open_multipart('cliente/agregar'); ?>
                <div class="card-body">
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="nombre">Nombre</label>
                            <?php echo form_error('nombre', '<div class="alert alert-danger">', '</div>'); ?>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Digite un Nombre" autocomplete="off">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="apellido">Apellido</label>
                            <?php echo form_error('apellido', '<div class="alert alert-danger">', '</div>'); ?>
                            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Digite un Apellido" autocomplete="off">
                        </div>
                    </div>
                    <div class="form-row">                        
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="cedula">Cedula</label>
                            <?php echo form_error('cedula', '<div class="alert alert-danger">', '</div>'); ?>
                            <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Digite el Numero de Cedula" autocomplete="off">
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="tipopersona">Tipo de Persona</label>
                            <?php echo form_error('tipopersona', '<div class="alert alert-danger">', '</div>'); ?>
                            <select class="form-control" name="tipopersona" id="tipopersona">
                                <option selected disabled hidden>Escoga un Tipo de Persona</option>
                                <option value="0">Física</option>
                                <option value="1">Jurídica</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="foto">Foto</label>
                            <?php echo form_error('foto', '<div class="alert alert-danger">', '</div>'); ?>
                            <input type="file" class="form-control form-control-md shadow-none" id="foto" name="foto" placeholder="Suba una Foto">
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">  
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <h5 class="mb-0">Datos de la Tarjeta de Credito</h5>
                            </div> 
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="form-row">
                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="no_tarjetadecredito">Tarjeta de Credito</label>
                                <?php echo form_error('no_tarjetadecredito', '<div class="alert alert-danger">', '</div>'); ?>
                                <?php echo form_error('tipotarjeta', '<div class="alert alert-danger">', '</div>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="no_tarjetadecredito_groupprepend"><i class="far fa-credit-card"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="no_tarjetadecredito" name="no_tarjetadecredito" placeholder="Tarjeta de Credito" aria-describedby="no_tarjetadecredito_groupprepend" autocomplete="off">
                                    <select class="form-control" name="tipotarjeta" id="tipotarjeta">
                                        <option selected disabled hidden>Tipo de Tarjeta de Credito</option>
                                        <?php
                                            $nombres = array('American Express', 'China Unionpay', 'Diners Club CarteBlance', 'Diners Club', 'Discover Card', 'Interpayment', 'JCB', 'Maestro', 'Dankort', 'NSPK MIR', 'Troy', 'MasterCard', 'Visa', 'UATP', 'Verve', 'CIBC Convenience Card', 'Royal Bank of Canada Client Card', 'TD Canada Trust Access Card', 'Scotiabank Scotia Card', 'BMO ABM Card', 'HSBC Canada Card'); 
                                            $siglas = array('amex', 'unionpay', 'carteblanche', 'dinersclub', 'discover', 'interpayment', 'jcb', 'maestro', 'dankort', 'mir', 'troy', 'mastercard', 'visa', 'uat', 'verve', 'cibc', 'rbc', 'tdtrust', 'scotia', 'bmoabm', 'hsbc');
            
                                            for ($i=0; $i < 21; $i++) { 
                                                echo "<option value='".$siglas[$i]."'>".$nombres[$i]."</option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="limitecredito">Limite de Credito</label>
                                <?php echo form_error('limitecredito', '<div class="alert alert-danger">', '</div>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="limitecredito_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" style="text-align: right;" class="form-control" id="limitecredito" name="limitecredito" placeholder="Limite de Credito" aria-describedby="limitecredito_groupprepend" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="codigotarjeta">Codigo de Tarjeta</label>
                                <?php echo form_error('codigotarjeta', '<div class="alert alert-danger">', '</div>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="codigotarjeta_groupprepend"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="codigotarjeta" name="codigotarjeta" placeholder="Digite su codigo" aria-describedby="codigotarjeta_groupprepend" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="mes">Expiracion de la Tarjeta</label>
                                <?php echo form_error('mes', '<div class="alert alert-danger">', '</div>'); ?>
                                <?php echo form_error('anio', '<div class="alert alert-danger">', '</div>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id=""><i class="fas fa-calendar-alt"></i></span>
                                    </div>
                                    <select class="form-control" name="mes" id="mes">
                                        <option selected disabled hidden>Mes</option>
                                        <?php
                                            $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
                                            for ($i=0; $i < 12; $i++) { 
                                                echo "<option value='".($i+1)."'>".$meses[$i]."</option>";
                                            }
                                        ?>
                                    </select>
                                    <input type="number" id="anio" name="anio" placeholder="Año" class="form-control">
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="card-body border-top">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Agregar</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
    <!-- ============================================================== -->
</div>
           