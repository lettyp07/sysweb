<?php
        // Establecer la zona horaria
        date_default_timezone_set('America/Asuncion'); 
        $fechaActual = date("Y-m-d");
?>
<?php
if ($_GET['form']=='add') {?>
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Agregar timbrado</i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="?module=timbrado">Timbrado</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal" action="modules/timbrado/proses.php?act=insert" method="POST">
                        <div class="box-body">
                            <?php 
                            //Metodo para generar codigo
                            $query_id = mysqli_query($mysqli, "SELECT MAX(id_timbrado) as id from timbrado")
                                                                or die('Error'.mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);
                            if ($count <>0 ) {
                                $data_id = mysqli_fetch_assoc($query_id);
                                $codigo = $data_id['id']+1;
                            }else{
                                $codigo=1;
                            }
                            ?>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                </div>
                            </div>

                          <div class="form-group">
                                <label class="col-sm-2 control-label">Tipo comprobante</label>
                                <div class="col-sm-4">
                                    <select class="chosen-select" name="tipo_comprobante"
                                        data-placeholder="Seleccione tipo comprobante" autocomplete="off" required>
                                        <option value=""></option>
                                        <?php
                                        $query_prov = mysqli_query($mysqli, "SELECT *
                                            FROM comprobante
                                            ORDER BY id_comprobante ASC") or die('Error' . mysqli_error($mysqli));
                                        while ($data_prov = mysqli_fetch_assoc($query_prov)) {
                                            echo "<option value=\"$data_prov[id_comprobante]\">$data_prov[tipo_comprobante]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="numero_timbrado" class="col-sm-2 control-label">N° de timbrado</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="nro_timbrado" id="nro_timbrado"
                                        placeholder="Ingrese el número de timbrado" required pattern="[0-9]+"
                                        title="Solo se permiten números">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fecha_inicio" class="col-sm-2 control-label">Fecha inicio</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control"
                                        name="fecha_inicio" id="fecha_inicio"
                                        min="<?php echo $fechaActual; ?>"
                                        value="<?php echo $fechaActual; ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="fecha_fin" class="col-sm-2 control-label">Fecha vencimiento</label>
                                <div class="col-sm-2">
                                    <input type="date" class="form-control"
                                        name="fecha_fin" id="fecha_fin"
                                        min="<?php echo $fechaActual; ?>"
                                        value="<?php echo $fechaActual; ?>">
                                </div>
                            </div>

                                    <div class="box-footer">
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10 ">
                                                <input type="submit" class="btn btn-primary btn-submit" name="Guardar" value="Guardar">
                                            <a href="?module=timbrado" class="btn btn-default btn-reset">Cancelar</a>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </form>
                </div>

            </div>

        </div>

    </section>

<?php }
?>