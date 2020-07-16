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
    <div class="row">
        <div class="col-xl-12 col-lg-8 col-md-8 col-sm-12 col-12">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <?php echo form_open_multipart('renta/'); ?>
                    <div class="card">
                        <h5 class="card-header">
                            Usar Parametros de Busqueda
                            <div class="switch-button switch-button-xs">
                                <input type="checkbox" onchange="handleChange(this)" name="isEnabledSearch" id="isEnabledSearch" <?php echo ($isEnabledSearch == "1")?"checked":"" ?>>
                                <span><label for="isEnabledSearch"></label></span>
                            </div>            
                        </h5>
                        <div id="formFiltroCarros" <?php echo ($isEnabledSearch == "1")?"style='display: '":"style='display: none'" ?>>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="marcavehiculo">Marca</label>
                                        <?php echo form_error('marcavehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                                        <select class="form-control" id="marcavehiculo" name="marcavehiculo">
                                            <?php
                                                if(isset($fieldsSearched->marcavehiculo))
                                                {
                                                    foreach($marcas as $marca)
                                                    {
                                                        if($fieldsSearched->marcavehiculo == $marca->id)
                                                        {
                                                            echo '<option selected value="'.$marca->id.'">'.$marca->nombre.'</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="'.$marca->id.'">'.$marca->nombre.'</option>';
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<option selected disabled hidden>Escoga una Marca de Vehiculo</option>";
                                                    foreach($marcas as $marca)
                                                    {
                                                        echo '<option value="'.$marca->id.'">'.$marca->nombre.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="modelovehiculo">Modelo</label>
                                        <?php echo form_error('modelovehiculo', '<div class="alert alert-danger">', '</div>'); ?>
                                        <select class="form-control" name="modelovehiculo" id="modelovehiculo">
                                            <?php
                                                if(isset($fieldsSearched->modelovehiculo))
                                                {
                                                    foreach($modelos as $modelo)
                                                    {
                                                        if($fieldsSearched->modelovehiculo == $modelo->id)
                                                        {
                                                            echo '<option selected value="'.$modelo->id.'">'.$modelo->nombre.'</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="'.$modelo->id.'">'.$modelo->nombre.'</option>';
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<option selected disabled hidden>Escoga un Modelo de Vehiculo</option>";
                                                    foreach($modelos as $modelo)
                                                    {
                                                        echo '<option value="'.$modelo->id.'">'.$modelo->nombre.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>                                        
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="tipocombustible">Tipo de Combustible</label>
                                        <?php echo form_error('tipocombustible', '<div class="alert alert-danger">', '</div>'); ?>
                                        <select class="form-control" name="tipocombustible" id="tipocombustible">
                                            <?php                                                
                                                if(isset($fieldsSearched->tipocombustible))
                                                {
                                                    foreach($combustibles as $combustible)
                                                    {
                                                        if($fieldsSearched->tipocombustible == $combustible->id)
                                                        {
                                                            echo '<option selected value="'.$combustible->id.'">'.$combustible->nombre.'</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="'.$combustible->id.'">'.$combustible->nombre.'</option>';
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<option selected disabled hidden>Escoga un Tipo de Combustible</option>";
                                                    foreach($combustibles as $combustible)
                                                    {
                                                        echo '<option value="'.$combustible->id.'">'.$combustible->nombre.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="preciominimo">Precio Minimo</label>
                                        <?php echo form_error('preciominimo', '<div class="alert alert-danger">', '</div>'); ?>
                                        <input type="text" style="text-align: right;" class="form-control" id="preciominimo" name="preciominimo" <?php if(isset($fieldsSearched->preciominimo)){echo "value='".$fieldsSearched->preciominimo."'";}?> placeholder="Digite un Precio Minimo" autocomplete="off">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                                        <label for="preciomaximo">Precio Maximo</label>
                                        <?php echo form_error('preciomaximo', '<div class="alert alert-danger">', '</div>'); ?>
                                        <input type="text" style="text-align: right;" class="form-control" id="preciomaximo" name="preciomaximo" <?php if(isset($fieldsSearched->preciomaximo)){echo "value='".$fieldsSearched->preciomaximo."'";}?>  placeholder="Digite un Precio Maximo" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body border-top">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Buscar</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
                <?php
                    if(count($datashow)==0)
                    {
                        echo "<div class='col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center'><p class='mb-2'>No se encontraron vehiculos</p></div>";
                    }
                    foreach ($datashow as $item) 
                    {
                        echo "<div class='col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12'>";
                        echo "<div class='product-thumbnail'>";
                        echo "<div class='product-img-head'>";
                        echo "<div class='product-img'>";
                        echo "<img src='/rentcar/archivos/".$item->foto."' alt='' class='img-thumbnail' style='width: 230px; height: 160px;'></div>";
                        echo "<!--";
                        echo "<div class=''></div>";
                        echo "<div class=''>New</div>";
                        echo "-->";
                        echo "</div>";
                        echo "<div class='product-content'>";
                        echo "<div class='product-content-head'>";
                        echo "<div class='product-price'>".$item->marca."</div>";
                        echo "<h2 class='card-title'>".$item->modelo."</h2>";
                        echo "<!--";
                        echo "<div class='product-rating d-inline-block'>";
                        echo "<i class='fa fa-fw fa-star'></i>";
                        echo "<i class='fa fa-fw fa-star'></i>";
                        echo "<i class='fa fa-fw fa-star'></i>";
                        echo "<i class='fa fa-fw fa-star'></i>";
                        echo "<i class='fa fa-fw fa-star'></i>";
                        echo "</div>";
                        echo "-->";
                        echo "<h4 class='mb-0 text-primary'>".$item->montopordia."/día</h4>";
                        echo "</div>";
                        echo "<div class='btn-group'>";
                        echo "<a class='btn btn-primary btn-sm' href='/rentcar/renta/proceso/".$item->id."'>";
                        echo "<i class='fas fa-shipping-fast'></i> Rentar";
                        echo "</a>";
                        echo "<a class='btn btn-sm btn-outline-light' href='/rentcar/vehiculo/detalle/".$item->id."'>";
                        echo "<i class='fas fa-search'></i> Detalle";
                        echo "</a>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                ?>                
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <nav aria-label="Page navigation example">
                        <?php echo $links; ?>
                        <!--
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active"><a class="page-link " href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                        -->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<script>    
    function handleChange(checkbox) 
    {
        if(checkbox.checked == true)
        {
            //alert("prendido");
            document.getElementById("formFiltroCarros").style.display = "";
        }
        else
        {
            //alert("apagado");
            document.getElementById("formFiltroCarros").style.display = "none";
        }
    }
</script>
           