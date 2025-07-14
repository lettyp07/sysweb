<?php 
session_start();
require_once "../../config/database.php";

if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv= 'refresh' content='0; url=index.php?alert=alert=3'>";

}
else{
    if ($_GET['act']=='insert') {
    if (isset($_POST['Guardar'])) {
        $codigo = $_POST['codigo'];
        $nro_timbrado = $_POST['nro_timbrado'];
        $fecha_ini = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];
        $estado = 'activo';

        $query = mysqli_query($mysqli, "INSERT INTO timbrado (id_timbrado, nro_timbrado, fecha_inicio, fecha_fin, estado)
        VALUES ($codigo, $departamento, '$descrip_ciudad')") or die ('Error'.mysqli_error($mysqli));

        $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_comprobante (
            id_timbrado, id_comprobante, precio, cantidad, iva5, iva10, exenta
            ) VALUES (
            $codigo_producto, $codigo, $precio, $cantidad, $iva5, $iva10, $exenta
            )") or die('Error al insertar detalle de compra: ' . mysqli_error($mysqli));
    
    if ($query) {
            header("Location: ../../MAIN.PHP?module=timbrado&alert=1");
        }else{
            header("Location: ../../MAIN.PHP?module=timbrado&alert=4");
        }
    }
    }

elseif ($_GET['act']=='update') {
    if (isset($_POST['Guardar'])) {
        if (isset($_POST['codigo'])) {
            $codigo = $_POST['codigo'];
            $estado = $_POST['estado'];

            $query = mysqli_query($mysqli, "UPDATE timbrado Set estado = '$estado'
                                                                Where id_timbrado = $codigo")
                                                                or die ('Error'.mysqli_error($mysqli));
                                                
            if ($query) {
                header("Location: ../../MAIN.PHP?module=timbrado&alert=2");
            }else{
                header("Location: ../../MAIN.PHP?module=timbrado&alert=4");
            }
        }
    }
}
}


?>