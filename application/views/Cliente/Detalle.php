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
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card influencer-profile-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="text-center">
                                <img src="/rentcar/archivos/<?php echo $datashow->foto ?>" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                                <div class="user-avatar-info">
                                    <div class="m-b-20">
                                        <div class="user-avatar-name">
                                            <h2 class="mb-1"><?php echo $datashow->nombre." ".$datashow->apellido ?></h2>
                                        </div>
                                        <div class="rating-star  d-inline-block">
                                            <!--
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <i class="fa fa-fw fa-star"></i>
                                                <p class="d-inline-block text-dark">14 Reviews </p>
                                            -->
                                        </div>
                                    </div>
                                    <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
                                    <div class="user-avatar-address">
                                            <!--
                                                -->
                                        <p class="border-bottom pb-3">
                                            <span class="d-xl-inline-block d-block mb-2"><strong>Cédula: </strong><?php echo $datashow->cedula?></span>
                                            <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><strong>Limite de Credito: </strong><?php echo $datashow->limitecredito ?></span>
                                            <?php
                                                $dias = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
                                                $mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                                            ?>
                                            <span class="mb-2 ml-xl-4 d-xl-inline-block d-block"><strong>Fecha de Ingreso: </strong><?php echo $dias[date('w', strtotime($datashow->creacion))].", ".date('d', strtotime($datashow->creacion))." de ".$mes[date('m', strtotime($datashow->creacion))-1]." del ".date('Y', strtotime($datashow->creacion))." ".date("h:i A", strtotime($datashow->creacion)); ?></span>
                                        </p>
                                        <div class="mt-3">
                                            <a href="#" class="badge badge-light mr-1">Persona <?php echo ($datashow->tipopersona == "0")?"Física":"Jurídica" ?></a> 
                                            <a href="#" class="badge badge-light mr-1">
                                                <?php
                                                    $nombresCC = array('American Express', 'China Unionpay', 'Diners Club CarteBlance', 'Diners Club', 'Discover Card', 'Interpayment', 'JCB', 'Maestro', 'Dankort', 'NSPK MIR', 'Troy', 'MasterCard', 'Visa', 'UATP', 'Verve', 'CIBC Convenience Card', 'Royal Bank of Canada Client Card', 'TD Canada Trust Access Card', 'Scotiabank Scotia Card', 'BMO ABM Card', 'HSBC Canada Card'); 
                                                    $siglasCC = array('amex', 'unionpay', 'carteblanche', 'dinersclub', 'discover', 'interpayment', 'jcb', 'maestro', 'dankort', 'mir', 'troy', 'mastercard', 'visa', 'uat', 'verve', 'cibc', 'rbc', 'tdtrust', 'scotia', 'bmoabm', 'hsbc');
                                                    $tarjetas = "Tarjeta ";
                                                    foreach ($siglasCC as $siglaCC) {
                                                        $tarjetas = ($ccValidator->valid_cc_number($datashow->no_tarjetadecredito, $siglaCC))?$tarjetas.$nombresCC[array_search($siglaCC, $siglasCC)].", ":$tarjetas;
                                                    }
                                                    echo substr(trim($tarjetas), 0, -1);
                                                ?>
                                            </a> 
                                        </div>
                                        <!--
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>