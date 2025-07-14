<?php if ($_GET['form'] == 'add') { ?>
    <section class="content-header">
        <h1>
            <i class="fa fa-edit icon-title">Agregar Arqueo</i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="?module=start"><i class="fa fa-home"></i>Inicio</a></li>
            <li><a href="?module=arqueo">Arqueo</a></li>
            <li class="active">Agregar</li>
        </ol>
    </section>      

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <form role="form" class="form-horizontal"  >
                        <div class="box-body">
                            <?php
                            //Método para generar código
                            $query_id = mysqli_query($mysqli, "SELECT MAX(id_arqueo) as id FROM arqueo")
                                    or die('Error' . mysqli_error($mysqli));

                            $count = mysqli_num_rows($query_id);
                            if ($count <> 0) {
                                $data_id = mysqli_fetch_assoc($query_id);
                                $codigo = $data_id['id'] + 1;
                            } else {
                                $codigo = 1;
                            }
                            ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Código</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="codigo" value="<?php echo $codigo; ?>" readonly>
                                </div>

                                <label class="col-sm-1 control-label">Fecha</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy" name="fecha" id="fecha" autocomplete="of" 
                                           value="<?php echo date("Y-m-d"); ?>" readonly>
                                </div>

                                <label class="col-sm-1 control-label">Hora</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control date-picker" data-date-format="H-mm-ss" name="hora" id="hora" autocomplete="of" 
                                           value="<?php echo date("H:i:s"); ?>" readonly>
                                </div>
                            </div>


                            </div>
                            <hr>               
                            <div class="form-group">
                                <div class="col-sm-12">                   
                                </div>
                            </div>
                            <div id="resultados" class="col-md-9"></div>
                            <div class="box-footer">
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input class="btn btn-primary btn-submit" onclick="guardar();" name="Guardar" value="Guardar">
                                        <a href="?module=arqueo" class="btn btn-default btn-reset">Cancelar</a>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js"></script>


