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
        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12 col-xl-offset-3">
            <div class="card">
                <h5 class="card-header">Actualizar Vehiculo</h5>
                <?php echo form_open_multipart('vehiculo/actualizar/'.$datashow->id); ?>
                    <div class="card-body">
                        <div class="alert alert-info">Dejar el campo de foto vacío no eliminará la actual, subir una nueva la reemplazará.</div>
                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="no_chasis">No. Chasis</label>
                                <?php echo form_error('no_chasis', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" class="form-control" id="no_chasis" name="no_chasis" value="<?php echo $datashow->no_chasis ?>" placeholder="Digite el Numero de Chasis" autocomplete="off">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="no_motor">No. Motor</label>
                                <?php echo form_error('no_motor', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" class="form-control" id="no_motor" name="no_motor" value="<?php echo $datashow->no_motor ?>" placeholder="Digite el Numero del Motor" autocomplete="off">
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="no_placa">No. Placa</label>
                                <?php echo form_error('no_placa', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="text" class="form-control" id="no_placa" name="no_placa" value="<?php echo $datashow->no_placa ?>" placeholder="Digite el Numero de Placa" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="modelovehiculo" class="col-form-label">Modelo de Vehiculo</label>
                                <?php echo form_error('modelovehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                                <select class="form-control" name="modelovehiculo" id="modelovehiculo">
                                    <option selected disabled hidden>Escoga un Modelo de Vehiculo</option>
                                    <?php
                                        foreach($modelos as $modelo)
                                        {
                                            echo ($modelo->id == $datashow->id_modelovehiculo)?'<option value="'.$modelo->id.'" selected>'.$modelo->nombre.'</option>':'<option value="'.$modelo->id.'">'.$modelo->nombre.'</option>';
                                        }
                                        ?>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="tipocombustible" class="col-form-label">Tipo de Combustible</label>
                                <?php echo form_error('tipocombustible', '<div class="alert alert-danger">', '</div>'); ?>
                                <select class="form-control" name="tipocombustible" id="tipocombustible">
                                    <option selected disabled hidden>Escoga un Tipo de Combustible</option>
                                    <?php
                                        foreach($combustibles as $combustible)
                                        {
                                            echo ($combustible->id == $datashow->id_tipocombustible)?'<option value="'.$combustible->id.'" selected>'.$combustible->nombre.'</option>':'<option value="'.$combustible->id.'">'.$combustible->nombre.'</option>';
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="foto">Foto</label>
                                <?php echo form_error('foto', '<div class="alert alert-danger">', '</div>'); ?>
                                <input type="file" class="form-control form-control-sm shadow-none" id="foto" name="foto" placeholder="Suba una Foto">
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="montopordia">Monto por Dia</label>
                                <?php echo form_error('montopordia', '<div class="alert alert-danger">', '</div>'); ?>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="montopordia_groupprepend"><i class="fas fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="text" style="text-align: right;" class="form-control" id="montopordia" name="montopordia" value="<?php echo explode('.', $datashow->montopordia)[0] ?>" placeholder="Asigne un monto al Dia" aria-describedby="montopordia_groupprepend" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripcion</label>
                            <?php echo form_error('descripcion', '<div class="alert alert-danger">', '</div>'); ?>
                            <textarea style="resize: none;" class="form-control" id="descripcion" name="descripcion" placeholder="Escriba una descripción (Opcional)" rows="5" autocomplete="off"><?php echo $datashow->descripcion ?></textarea>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Actualizar</button>
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
    <!-- ============================================================== -->
</div>
           