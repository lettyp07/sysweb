<?php 
if ($_SESSION['permisos_acceso'] =='Super Admin') {?>

<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i>Inicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class=" fa fa-home"></i></a></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:15px">
                <i class="icon fa fa-user "></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>
                a la Pizzeria Maná
                </p>
            </div>
        </div> 

    </div>
    <h2>Movimientos</h2>
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #3B83BD; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Compras</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>la compra</li>
                            <li>de producto</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="?module=compras" class="small-box-footer" title="Registrar compras" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #E5BE01; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Producción</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>la producción</li>
                            <li>de un pedido</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                        <i class="fa fa-cutlery"></i>
                </div>
                <a href="?module=orden_produccion" class="small-box-footer" title="Registrar producción" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>


        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #00a65a; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Ventas</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>ventas</li>
                            <li>de productos</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                        <i class="fa fa-cart-arrow-down"></i>
                </div>
                <a href="?module=ventas" class="small-box-footer" title="Registrar ventas" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>


        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #fd7e14; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Stock de Ingredientes</strong>
                        <ul>
                            <li>Visualizar</li>
                            <li>Stock</li>
                            <li>de ingredientes</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                        <i class="fa fa-tasks"></i>
                </div>
                <a href="?module=stock" class="small-box-footer" title="Ver Stock de ingredientes" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card no-shadow nb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center just"></div>
            </div>
        </div>
    </div>
</section>



<?php 
} elseif ($_SESSION['permisos_acceso']=='Compras'){?>

<!--Inicio-->
<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i>Inicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class=" fa fa-home"></i></a></li>
    </ol>
</section>

<!--Etiqueta de Bienvenido -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:15px">
                <i class="icon fa fa-user "></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>
                a la aplicación: <strong>SysWeb</strong>
                </p>
            </div>
        </div> 
    </div>
    <h2>Movimiento</h2>
     <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #3B83BD; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Compras</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>la compra</li>
                            <li>de producto</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="?module=compras" class="small-box-footer" title="Registrar compras" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #fd7e14; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Stock de Ingredientes</strong>
                        <ul>
                            <li>Visualizar</li>
                            <li>Stock</li>
                            <li>de ingredientes</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                        <i class="fa fa-tasks"></i>
                </div>
                <a href="?module=stock" class="small-box-footer" title="Ver Stock de ingredientes" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>
    <div class="col-xl-4 col-lg-5">
            <div class="card no-shadow nb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center just"></div>
            </div>
        </div>
    </div>
</section>
<?php 


} elseif ($_SESSION['permisos_acceso']=='produccion'){?>

<!--Inicio-->
<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i>Inicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class=" fa fa-home"></i></a></li>
    </ol>
</section>
<!--Etiqueta de Bienvenido -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:15px">
                <i class="icon fa fa-user "></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>
                a la Pizzeria Maná
                </p>
            </div>
        </div> 
    </div>
    <div class="col-lg-4 col-xs-6">
            <div style="background-color: #E5BE01; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Producción</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>la producción</li>
                            <li>de un pedido</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                        <i class="fa fa-cutlery"></i>
                </div>
                <a href="?module=orden_produccion" class="small-box-footer" title="Registrar producción" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>
    <div class="col-xl-4 col-lg-5">
            <div class="card no-shadow nb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center just"></div>
            </div>
        </div>
    </div>
</section>


<?php
}elseif ($_SESSION['permisos_acceso']=='Ventas'){?>

<!--Inicio-->
<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i>Inicio
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=start"><i class=" fa fa-home"></i></a></li>
    </ol>
</section>

<!--Etiqueta de Bienvenido -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:15px">
                <i class="icon fa fa-user "></i>Bienvenido/a <strong><?php echo $_SESSION['name_user']; ?></strong>
                a la Pizzeria Maná
                </p>
            </div>
        </div> 
    </div>
    <h2>Movimiento</h2>
    <div class="row">
        <div class="col-lg-4 col-xs-6">
            <div style="background-color: #00a65a; color: #fff" class="small-box">
                <div class="inner">
                    <p><strong>Ventas</strong>
                        <ul>
                            <li>Registrar</li>
                            <li>ventas</li>
                            <li>de productos</li>
                        </ul>
                    </p>
                </div>
                <div class="icon">
                        <i class="fa fa-cart-arrow-down"></i>
                </div>
                <a href="?module=ventas" class="small-box-footer" title="Registrar ventas" data-toggle="tooltip">
                    <i class="fa fa-plus"></i></a>
            </div>
        </div>
    <div class="col-xl-4 col-lg-5">
            <div class="card no-shadow nb-4">
                <div class="card-header py-3 d-flex flex-row aling-items-center just"></div>
            </div>
        </div>
    </div>
</section>

<?php } ?>