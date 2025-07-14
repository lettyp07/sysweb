<?php
$tipo_formulario = isset($_GET['form']) ? $_GET['form'] : 'add';
$accion = ($tipo_formulario == 'add') ? 'insert' : 'cerrar';
$titulo = ($tipo_formulario == 'add') ? 'Agregar Apertura' : 'Cerrar Caja';
$fechaActual = date("Y-m-d");
$horaActual = date("H:i:s");
?>

<section class="content-header">
    <h1><i class="fa fa-edit icon-title"></i> <?php echo $titulo; ?></h1>
</section>

<form role="form" action="modules/apertura_cierre/proses.php?act=<?php echo $accion ?>" method="POST" class="form-horizontal">
    <div class="box-body">
        <?php if ($tipo_formulario == 'add') { ?>
            <!-- FORMULARIO DE APERTURA -->
            <input type="hidden" name="tipo" value="apertura">

    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="modules/apertura_cierre/proses.php?act=insert" method="POST">
                    <div class="box-body">
                        <?php
                        $query_id = mysqli_query($mysqli, "SELECT MAX(id_apertura_cierre) as id FROM apertura_cierre") or die('Error: ' . mysqli_error($mysqli));
                        $data_id = mysqli_fetch_assoc($query_id);
                        $codigo = $data_id ? $data_id['id'] + 1 : 1;
                        ?>

                    <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>"
                                        readonly>
                                </div>

                                <label class="col-sm-1 control-label">Fecha</label>
                                    <div class="col-sm-2">
                                        <input type="date" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                            name="fecha_a" id="fecha" min="<?php echo $fechaActual; ?>"
                                            value="<?php echo $fechaActual; ?>" disabled>
                                        <input type="text" name="fecha" hidden value="<?php echo $fechaActual; ?>">
                                    </div>

                            <label class="col-sm-1 control-label">Hora</label>
                                <div class="col-sm-2">
                                    <input type="time" class="form-control date-picker" data-date-format="h-m-s" name="hora_a"
                                        min="<?php echo date("H:i:s"); ?>" 
                                         value="<?php echo date("H:i:s"); ?>"  disabled>
                                         <input type="text" name="hora" hidden value="<?php echo date("H:i:s"); ?>">
                                </div>
                            </div>

            <div class="form-group">
                                <label class="col-sm-2 control-label">N° caja</label>
                                <div class="col-sm-4">
                                    <select class="chosen-select" name="caja" id="caja"
                                        data-placeholder="Seleccione una caja" autocomplete="off" required>
                                        <option value=""></option>
                                        <?php
                                        $query_prov = mysqli_query($mysqli, "SELECT *
                                            FROM vista_cajas_disponibles
                                            ORDER BY id_caja ASC") or die('Error' . mysqli_error($mysqli));
                                        while ($data_prov = mysqli_fetch_assoc($query_prov)) {
                                        echo "<option value=\"$data_prov[id_caja]\">$data_prov[nro_caja]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

            <div class="form-group">
                                <label class="col-sm-2 control-label">Cajero</label>
                                <div class="col-sm-4">
                                    <select class="chosen-select" name="id_persona" data-placeholder="Seleccione cajero"
                                            autocomplete="off" required id="id_persona">
                                        <option value="0"></option>
                                        <?php
                                        $query_prov = mysqli_query($mysqli, "SELECT *
                                        FROM persona
                                        ORDER BY id_persona ASC") or die('Error' . mysqli_error($mysqli));
                                        while ($data_prov = mysqli_fetch_assoc($query_prov)) {
                                            echo "<option value=\"$data_prov[id_persona]\"> $data_prov[nombre] $data_prov[apellido] ($data_prov[nro_ci])</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        <div class="form-group">
                                <label class="col-sm-2 control-label">Monto inicial</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="monto_ini" id="monto_ini"
                                autocomplete="off" required placeholder="Ingrese el monto inicial"
                                title="Solo números permitidos" inputmode="numeric">
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                    <a href="?module=apertura_cierre" class="btn btn-default btn-reset">Cancelar</a>
                                </div>
                            </div>
                        </div>
                
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>

        <?php } else { ?>
            <!-- FORMULARIO DE CIERRE -->
            <input type="hidden" name="tipo" value="cierre">
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" class="form-horizontal" action="modules/apertura_cierre/proses.php?act=insert" method="POST">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Fecha</label>
                            <div class="col-sm-2">
                                <input type="date" class="form-control" value="<?php echo $fechaActual; ?>" disabled>
                                <input type="hidden" name="fecha" value="<?php echo $fechaActual; ?>">
                            </div>

                            <label class="col-sm-2 control-label">Hora</label>
                            <div class="col-sm-2">
                                <input type="time" class="form-control" value="<?php echo $horaActual; ?>" disabled>
                                <input type="hidden" name="hora" value="<?php echo $horaActual; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Apertura de caja</label>
                            <div class="col-sm-4">
                                <select class="chosen-select" name="id_apertura_cierre" data-placeholder="Seleccione apertura" required>
                                    <option value=""></option>
                                    <?php
                                    $query = mysqli_query($mysqli, "SELECT id_apertura_cierre FROM apertura_cierre WHERE estado='activo'");
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo "<option value=\"$row[id_apertura_cierre]\">Apertura ID: $row[id_apertura_cierre]</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Monto Efectivo</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="total_efectivo" id="total_efectivo" 
                                autocomplete="off" required placeholder="Ingrese el monto efectivo"
                                title="Solo números permitidos" inputmode="numeric">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Monto Cheque</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="total_cheque" id="total_cheque" 
                                autocomplete="off" required placeholder="Ingrese el monto cheque"
                                title="Solo números permitidos" inputmode="numeric">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Monto Tarjeta</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="total_tarjeta" id="total_tarjeta" 
                                autocomplete="off" required placeholder="Ingrese el monto tarjeta"
                                title="Solo números permitidos" inputmode="numeric">
                            </div>
                        </div>

                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                    <a href="?module=apertura_cierre" class="btn btn-default btn-reset">Cancelar</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
        <?php } ?>

        <!-- BOTONES 
        <div class="box-footer">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                    <a href="?module=apertura_cierre" class="btn btn-default btn-reset">Cancelar</a>
                </div>
            </div>
        </div>-->
    </div>
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
    integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>

<script>
document.getElementById('monto_ini').addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, '');

    e.target.value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});
</script>
<script>
 document.getElementById('total_efectivo').addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, '');
    e.target.value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});
document.getElementById('total_cheque').addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, '');
    e.target.value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});
document.getElementById('total_tarjeta').addEventListener('input', function (e) {
    let valor = e.target.value.replace(/\D/g, '');
    e.target.value = valor.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
});
</script>
