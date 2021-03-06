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
    <!-- custom form  -->
    <!-- ============================================================== -->
    <div class="row justify-content-center">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 col-xl-offset-3">
            <div class="card">
                <h5 class="card-header">Agregar Tipo de Combustible</h5>
                <?php echo form_open('tipocombustible/agregar'); ?>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre" class="col-form-label">Tipo de Combustible</label>
                            <?php echo form_error('nombre', '<div class="alert alert-danger">', '</div>'); ?>
                            <input id="nombre" name="nombre" placeholder="Digite un Tipo de Combustible" type="text" class="form-control" autocomplete="off">
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
           