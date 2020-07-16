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
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-xl-offset-3">
            <div class="card">
                <h5 class="card-header">Agregar Modelo de Vehiculo</h5>
                <?php echo form_open('modelovehiculo/agregar'); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre" class="col-form-label">Modelo de Vehiculo</label>
                            <?php echo form_error('nombre', '<div class="alert alert-danger">', '</div>'); ?>
                            <input id="nombre" name="nombre" placeholder="Digite un Modelo de Vehiculo" type="text" class="form-control" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="tipovehiculo" class="col-form-label">Tipo de Vehiculo</label>
                            <?php echo form_error('tipovehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                            <select class="form-control" name="tipovehiculo">
                                <option selected disabled hidden>Escoga una Tipo de Vehiculo</option>
                                <?php
                                    foreach($tipos as $tipo)
                                    {
                                        echo '<option value="'.$tipo->id.'">'.$tipo->nombre.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="marcavehiculo" class="col-form-label">Marca de Vehiculo</label>
                            <?php echo form_error('marcavehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                            <select class="form-control" name="marcavehiculo">
                                <option selected disabled hidden>Escoga una Marca de Vehiculo</option>
                                <?php
                                    foreach($marcas as $marca)
                                    {
                                        echo '<option value="'.$marca->id.'">'.$marca->nombre.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Agregar</button>                        
                    </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end basic form  -->
    <!-- ============================================================== -->
</div>
           