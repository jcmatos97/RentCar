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
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-xl-offset-4">
        <div class="card">
                <h3 class="card-header">Inspección del Vehiculo</h3>
                <input type="text" value="<?php echo $datashow->id; ?>" id="id_vehiculo" name="id_vehiculo" hidden>
                <div class="card-body">
                    <div class="form-row">
                        <?php echo form_error('id_vehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <h5 class="mb-1">Vehiculo</h5>
                            <p><?php echo $datashow->marca.' '.$datashow->modelo ?></p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <h5 class="mb-1">No. Placa</h5>
                            <p><?php echo $datashow->no_placa; ?></p>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <h5 class="mb-1">Ultima Inspeccion</h5>
                            <p><?php echo (isset($inspeccion))?(new DateTime($inspeccion->fecha, new DateTimeZone("America/Caracas")))->format("d/m/Y H:i:s"):"Nunca"; ?></p>
                        </div>
                    </div>
                    
                </div>
                <div class="card-body border-top">
                    <h5>Accesorios</h5>
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" <?php if(isset($inspeccion)){echo ($inspeccion->gomarepuesto == 1)?"checked":"";} ?> id="gomarepuesto" name="gomarepuesto" class="custom-control-input" disabled><span class="custom-control-label">Goma de Repuesto</span>
                            </label>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" <?php if(isset($inspeccion)){echo ($inspeccion->gato == 1)?"checked":"";} ?> id="gato" name="gato" class="custom-control-input" disabled><span class="custom-control-label">Gato</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" <?php if(isset($inspeccion)){echo ($inspeccion->kitherramientas == 1)?"checked":"";} ?> id="kitherramientas" name="kitherramientas" class="custom-control-input" disabled><span class="custom-control-label">Kit de Herramientas</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h5>Nivel de Combustible</h5>
                    <div class="form-row">
                        <?php echo form_error('nivelcombustible', '<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                    <input type="number" name="nivelcombustible" value="<?php echo (isset($inspeccion))?$inspeccion->nivelcombustible:0; ?>" id="nivelcombustible" hidden>
                    <div class="progress mb-2">
                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" id="barraNivel" role="progressbar" style="width: <?php echo (isset($inspeccion))?$inspeccion->nivelcombustible:0; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h5>Estado Gomas</h5>
                    <?php $xplode = (isset($inspeccion))?str_split($inspeccion->estadogomas):'0000';?>
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="r1" <?php echo ($xplode[0]=='1')?'checked':''; ?> name="r1" class="custom-control-input" disabled><span class="custom-control-label">Posterior Derecha</span>
                            </label>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="l1" <?php echo ($xplode[1]=='1')?'checked':''; ?> name="l1" class="custom-control-input" disabled><span class="custom-control-label">Posterior Izquierda</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="r2" <?php echo ($xplode[2]=='1')?'checked':''; ?> name="r2" class="custom-control-input" disabled><span class="custom-control-label">Anterior Derecha</span>
                            </label>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label class="custom-control custom-checkbox custom-control-inline">
                            <input type="checkbox" id="l2" <?php echo ($xplode[3]=='1')?'checked':''; ?> name="l2" class="custom-control-input" disabled><span class="custom-control-label">Anterior Izquierda</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h5>Daños</h5>
                    <div class="form-row">
                        <?php echo form_error('rayaduras', '<div class="alert alert-danger">', '</div>'); ?>
                        <?php echo form_error('aboyaduras', '<div class="alert alert-danger">', '</div>'); ?>
                    </div>
                    <div class="form-row">
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="nombre">Numero de Rayaduras</label>
                            <input type="number" class="form-control" id="rayaduras" name="rayaduras" placeholder="Numero de Rayaduras" value="<?php echo (isset($inspeccion))?$inspeccion->rayaduras:'0'; ?>" autocomplete="off" disabled>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="apellido">Numero de Aboyaduras</label>
                            <input type="number" class="form-control" id="aboyaduras" name="aboyaduras" placeholder="Numero de Aboyaduras" value="<?php echo (isset($inspeccion))?$inspeccion->aboyaduras:'0'; ?>" autocomplete="off" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-body border-top">
                <a class="btn btn-primary btn-lg btn-block" href="/rentcar/inspeccion">Regresar al Listado de Vehiculos</a> 
                </div>
            </div>
        </div>
    </div>
</div>
           