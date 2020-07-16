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
                    <a class="btn btn-primary btn-lg btn-block" href="/rentcar/vehiculo">Regresar al Listado de Vehiculos</a> 
                </div>
            </div>
        </div>
    </div>
</div>