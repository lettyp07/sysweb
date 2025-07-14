<?php 
session_start();

require_once '../../config/database.php';

if(empty($_SESSION['username']) && empty($_SESSION['password'])){
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
}
else{
    if($_GET['act']=='insert'){
        if(isset($_POST['Guardar'])){
            $codigo = $_POST['codigo'];
            //Definir variables
            $fecha = $_POST['fecha'];
            echo $_POST['fecha'];
            $hora = $_POST['hora'];
            echo $_POST['hora'];
            $monto_inicio = str_replace('.', '', $_POST['monto_ini']);
           // $monto_inicio=$_POST['monto_ini'];
            echo $_POST['monto_ini'];
            $estado='activo';
            $cajero=$_POST['id_persona'];
            $caja=$_POST['caja'];
            $usuario = $_SESSION['id_user'];
           // $sucursal = $_POST['sucursal'];
            //echo $_POST['sucursal'];
            
            //insertar
            $query = mysqli_query($mysqli, "INSERT INTO apertura_cierre (id_apertura_cierre,
            fecha_apertura , hora_apertura, monto_inicio, estado, id_persona, id_caja, id_user, id_sucursal)
            VALUES ($codigo, '$fecha', '$hora', '$monto_inicio', '$estado', $cajero, $caja, $usuario, (SELECT id_sucursal FROM usuarios 
            WHERE id_user = $usuario))")
            or die('Error'.mysqli_error($mysqli));
            
            if($query){
                header("Location: ../../main.php?module=apertura_cierre&alert=1");
            } else {
                header("Location: ../../main.php?module=apertura_cierre&alert=3");
            }
        }
    }

elseif ($_GET['act'] == 'cerrar') {
    if (isset($_POST['tipo']) && $_POST['tipo'] == 'cierre') {
        $id_apertura = $_POST['id_apertura_cierre'];
        $fecha_cierre = $_POST['fecha'];
        $hora_cierre = $_POST['hora'];
        $total_efectivo = str_replace('.', '', $_POST['total_efectivo']);
        $total_cheque = str_replace('.', '', $_POST['total_cheque']);
        $total_tarjeta = str_replace('.', '', $_POST['total_tarjeta']);

        $query = mysqli_query($mysqli, "UPDATE apertura_cierre 
            SET fecha_cierre = '$fecha_cierre',
                hora_cierre = '$hora_cierre',
                total_efectivo = '$total_efectivo',
                total_cheque= '$total_cheque',
                total_tarjeta = '$total_tarjeta',
                estado = 'cerrado'
            WHERE id_apertura_cierre = $id_apertura")
        or die('Error al cerrar caja: ' . mysqli_error($mysqli));

        if ($query) {
            header("Location: ../../main.php?module=apertura_cierre&alert=2");
        } else {
            header("Location: ../../main.php?module=apertura_cierre&alert=3");
        }
    }
}
    elseif($_GET['act']=='anular'){
        if(isset($_GET['id_apertura_cierre'])){
            $codigo = $_GET['id_apertura_cierre'];
            //Anular cabecera (cambiar estado a anulado)
            $query = mysqli_query($mysqli, "UPDATE apertura_cierre SET estado='anulado'
                                                                WHERE id_apertura_cierre=$codigo")
            or die('Error'.mysqli_error($mysqli));
            
            if($query){
                header("Location: ../../main.php?module=apertura_cierre&alert=2");
            } else {
                header("Location: ../../main.php?module=apertura_cierre&alert=3");
            }
        }
    }
}
?>