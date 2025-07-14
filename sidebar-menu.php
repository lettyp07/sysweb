<?php
if($_SESSION['permisos_acceso']=='Super Admin'){?>
   <ul class="sidebar-menu">
    <li class="header">Menú</li>
        <?php
            if($_GET["module"]=="start") {
            $active_home="active";
            }else{
            $active_home="";
        }
        ?>
    <li class="<?php echo $active_home; ?>">
    <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
    </li>

    <?php 
    //if ($_GET['module'] == 'start') { ?>
       <li class="treeview">
        <a href="javascript:void(0);">
        <i class=""></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=departamento" ><i class="fa fa-circle-o"></i>Departamento</a></li>
        <li><a href="?module=ciudad"><i class="fa fa-circle-o"></i>Ciudad</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class=""></i><span>Referenciales Compras</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=proveedor" ><i class="fa fa-circle-o"></i>Proveedor</a></li>
        <li><a href="?module=ingrediente" ><i class="fa fa-circle-o"></i>Ingrediente</a></li>
        <li><a href="?module=u_medida" ><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
        <li><a href="?module=tipo_ingrediente" ><i class="fa fa-circle-o"></i>Tipo ingrediente</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class=""></i><span>Referenciales Producción</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=producto" ><i class="fa fa-circle-o"></i>Producto</a></li>
        <li><a href="?module=tipo_producto" ><i class="fa fa-circle-o"></i>Tipo Producto</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class=""></i><span>Referenciales Ventas</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=cliente" ><i class="fa fa-circle-o"></i>Clientes</a></li>
        <li><a href="?module=timbrado" ><i class="fa fa-circle-o"></i>Timbrado</a></li>

        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-cart-plus" aria-hidden="true"></i></i><span>Movimientos Compras</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=pedido" ><i class="fa fa-circle-o"></i>Pedidos Compra</a></li>
        <li><a href="?module=presupuesto" ><i class="fa fa-circle-o"></i>Presupuesto proveedor</a></li>
        <li><a href="?module=orden_compra" ><i class="fa fa-circle-o"></i>Orden de compra</a></li>
        <li><a href="?module=compras" ><i class="fa fa-circle-o"></i>Factura compra</a></li>
        <li><a href="?module=remision" ><i class="fa fa-circle-o"></i>Nota remisión</a></li>
        <li><a href="?module=ajuste_stock" ><i class="fa fa-circle-o"></i>Ajuste de Stock</a></li>
        <li><a href="?module=stock" ><i class="fa fa-circle-o"></i>Stock de ingredientes</a></li>
        <li><a href="?module=notas" ><i class="fa fa-circle-o"></i>Nota débito y crédito</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-cutlery" aria-hidden="true"></i><span>Movimientos Producción</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=receta" ><i class="fa fa-circle-o"></i>Recetas</a></li>
        <li><a href="?module=pedido_cliente" ><i class="fa fa-circle-o"></i>Pedidos Cliente</a></li>
        <li><a href="?module=pedido_ingrediente" ><i class="fa fa-circle-o"></i>Pedidos Ingredientes</a></li>
        <li><a href="?module=orden_produccion" ><i class="fa fa-circle-o"></i>Orden de Producción</a></li>
        <li><a href="?module=etapa_produccion" ><i class="fa fa-circle-o"></i>Etapas de Producción</a></li>
        <li><a href="?module=control_produccion" ><i class="fa fa-circle-o"></i>Control de Producción</a></li>
        <li><a href="?module=control_calidad" ><i class="fa fa-circle-o"></i>Control de Calidad</a></li>
        <li><a href="?module=mermas" ><i class="fa fa-circle-o"></i>Mermas</a></li>
        <li><a href="?module=costo_produccion" ><i class="fa fa-circle-o"></i>Costos de Producción</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i><span>Movimientos Ventas</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=apertura_cierre" ><i class="fa fa-circle-o"></i>Apertura y cierre</a></li>
        <li><a href="?module=arqueo" ><i class="fa fa-circle-o"></i>Arqueo de caja</a></li>
        <li><a href="?module=ventas" ><i class="fa fa-circle-o"></i>Generar Venta</a></li>
        <li><a href="?module=cobro" ><i class="fa fa-circle-o"></i>Cobros</a></li>
        <li><a href="?module=nota_remision" ><i class="fa fa-circle-o"></i>Nota de remisión</a></li>
        <li><a href="?module=nota_credito_debito" ><i class="fa fa-circle-o"></i>Nota de crédito y débito</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Informes</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=informes_compras" ><i class="fa fa-circle-o"></i>Compras</a></li>
        <li><a href="?module=informes_produccion" ><i class="fa fa-circle-o"></i>Producción</a></li>
        <li><a href="?module=informes_facturacion" ><i class="fa fa-circle-o"></i>Facturación</a></li>
        </ul>
    </li>

                <?php 
                if ($_GET['module']=='user' || $_GET['module']=='form_user' ) {?>
                <li class="active">
                    <a href="?module=user"><i class="fa fa-user"></i>Administrar usuario</a>
                </li>
                 
              <?php }
              else{?>
              <li>
              <a href="?module=user"><i class="fa fa-user"></i>Administrar usuario</a>
              </li>
             <?php } ?>

             
             <?php 
                if ($_GET['module']=='password') {?>
                <li class="active">
                    <a href="?module=password"><i class="fa fa-lock"></i>Cambiar contraseña</a>
                </li>
                 
              <?php }
              else{?>
              <li>
              <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
              </li>
             <?php } ?>
   <?php //} ?>
   </ul>

<?php
} elseif ($_SESSION['permisos_acceso']=='Compras'){?>
    <ul class="sidebar-menu">
    <li class="header">Menú</li>
        <?php
            if($_GET["module"]=="start") {
            $active_home="active";
            }else{
            $active_home="";
        }
        ?>
    <li class="<?php echo $active_home; ?>">
    <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
    </li>

    <?php 
    //if ($_GET['module'] == 'start') { ?>
       <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=departamento" ><i class="fa fa-circle-o"></i>Departamento</a></li>
        <li><a href="?module=ciudad" ><i class="fa fa-circle-o"></i>Ciudad</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Referenciales de Compras</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=deposito"><i class="fa fa-circle-o"></i>Deposito</a></li>
        <li><a href="?module=proveedor"><i class="fa fa-circle-o"></i>Proveedor</a></li>
        <li><a href="?module=ingrediente"><i class="fa fa-circle-o"></i>Ingredientes</a></li>
        <li><a href="?module=u_medida"><i class="fa fa-circle-o"></i>Unidad de medida</a></li>
        <li><a href="?module=tipo_producto"><i class="fa fa-circle-o"></i>Tipo de Ingredientes</a></li>
        </ul>
    </li>  

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Movimientos Compras</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=pedido" ><i class="fa fa-circle-o"></i>Pedidos Compra</a></li>
        <li><a href="?module=presupuesto" ><i class="fa fa-circle-o"></i>Presupuesto proveedor</a></li>
        <li><a href="?module=orden_compra" ><i class="fa fa-circle-o"></i>Orden de compra</a></li>
        <li><a href="?module=compras" ><i class="fa fa-circle-o"></i>Factura compra</a></li>
        <li><a href="?module=remision" ><i class="fa fa-circle-o"></i>Nota remisión</a></li>
        <li><a href="?module=ajuste_stock" ><i class="fa fa-circle-o"></i>Ajuste de Stock</a></li>
        <li><a href="?module=stock" ><i class="fa fa-circle-o"></i>Stock de ingredientes</a></li>
        <li><a href="?module=notas" ><i class="fa fa-circle-o"></i>Nota débito y crédito</a></li>
        </ul>
    </li>
             <?php 
                if ($_GET['module']=='password') {?>
                <li class="active">
                    <a href="?module=password"><i class="fa fa-lock"></i>Cambiar contraseña</a>
                </li>
                 
              <?php }
              else{?>
              <li>
              <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
              </li>
             <?php } ?>

   <?php //} ?>
   </ul>

<?php
} elseif ($_SESSION['permisos_acceso']=='produccion'){?>
    <ul class="sidebar-menu">
    <li class="header">Menú</li>
        <?php
            if($_GET["module"]=="start") {
            $active_home="active";
            }else{
            $active_home="";
        }
        ?>
    <li class="<?php echo $active_home; ?>">
    <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
    </li>

    <?php 
    //if ($_GET['module'] == 'start') { ?>
       <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=departamento" ><i class="fa fa-circle-o"></i>Departamento</a></li>
        <li><a href="?module=ciudad" ><i class="fa fa-circle-o"></i>Ciudad</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Referenciales Producción</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=producto" ><i class="fa fa-circle-o"></i>Producto</a></li>
        <li><a href="?module=tipo_producto" ><i class="fa fa-circle-o"></i>Tipo Producto</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Movimientos Producción</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=receta" ><i class="fa fa-circle-o"></i>Recetas</a></li>
        <li><a href="?module=pedido_cliente" ><i class="fa fa-circle-o"></i>Pedidos Cliente</a></li>
        <li><a href="?module=pedido_ingrediente" ><i class="fa fa-circle-o"></i>Pedidos Ingredientes</a></li>
        <li><a href="?module=orden_produccion" ><i class="fa fa-circle-o"></i>Orden de Producción</a></li>
        <li><a href="?module=etapa_produccion" ><i class="fa fa-circle-o"></i>Etapas de Producción</a></li>
        <li><a href="?module=control_produccion" ><i class="fa fa-circle-o"></i>Control de Producción</a></li>
        <li><a href="?module=control_calidad" ><i class="fa fa-circle-o"></i>Control de Calidad</a></li>
        <li><a href="?module=mermas" ><i class="fa fa-circle-o"></i>Mermas</a></li>
        <li><a href="?module=costo_produccion" ><i class="fa fa-circle-o"></i>Costos de Producción</a></li>
        </ul>
    </li>
             <?php 
                if ($_GET['module']=='password') {?>
                <li class="active">
                    <a href="?module=password"><i class="fa fa-lock"></i>Cambiar contraseña</a>
                </li>
                 
              <?php }
              else{?>
              <li>
              <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
              </li>
             <?php } ?>

   <?php //} ?>
   </ul>


<?php
}elseif ($_SESSION['permisos_acceso']=='Ventas'){?>
  <ul class="sidebar-menu">
    <li class="header">Menú</li>
        <?php
            if($_GET["module"]=="start") {
            $active_home="active";
            }else{
            $active_home="";
        }
        ?>
         <li class="<?php echo $active_home; ?>">
    <a href="?module=start"><i class="fa fa-home"></i>Inicio</a>
    </li>

    <?php 
    //if ($_GET['module'] == 'start') { ?>
       <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Referenciales Generales</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=departamento" ><i class="fa fa-circle-o"></i>Departamento</a></li>
        <li><a href="?module=ciudad" ><i class="fa fa-circle-o"></i>Ciudad</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Referenciales Ventas</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=cliente" ><i class="fa fa-circle-o"></i>Clientes</a></li>
        </ul>
    </li>

    <li class="treeview">
        <a href="javascript:void(0);">
        <i class="fa fa-file-text"></i><span>Movimientos Ventas</span><i class="fa fa-angle-left pull-rigth"></i>
        </a>
        <ul class="treeview-menu">
        <li><a href="?module=apertura_cierre" ><i class="fa fa-circle-o"></i>Apertura y cierre</a></li>
        <li><a href="?module=arqueo" ><i class="fa fa-circle-o"></i>Arqueo de caja</a></li>
        <li><a href="?module=facturacion" ><i class="fa fa-circle-o"></i>Generar Venta</a></li>
        <li><a href="?module=cobro" ><i class="fa fa-circle-o"></i>Cobros</a></li>
        <li><a href="?module=nota_remision" ><i class="fa fa-circle-o"></i>Nota de remisión</a></li>
        <li><a href="?module=nota_credito_debito" ><i class="fa fa-circle-o"></i>Nota de crédito y débito</a></li>

        </ul>
    </li>
            <?php 
                if ($_GET['module']=='password') {?>
                <li class="active">
                    <a href="?module=password"><i class="fa fa-lock"></i>Cambiar contraseña</a>
                </li>

            <?php }
        else{?>
            <li>
            <a href="?module=password"><i class="fa fa-lock"></i>Cambiar Contraseña</a>
            </li>
            <?php } ?>
</ul>
    <?php } ?>