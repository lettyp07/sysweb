<?php 
session_start();
require_once '../../config/database.php';

// Verificar sesión
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=alert=3'>";
    exit;
}

if ($_GET['act'] == 'insert') {
    if (isset($_POST['Guardar'])) {
        // Obtener variables del formulario
        $fecha    = $_POST['fecha'];
        $hora     = $_POST['hora'];
        $estado   = 'activo';
        $usuario  = $_SESSION['id_user'];

        // Generar nuevo ID para el pedido
        $query_id = mysqli_query($mysqli, "SELECT MAX(id_pedido) as id FROM pedido_compra")
            or die('Error al generar ID: ' . mysqli_error($mysqli));
        
        $data_id = mysqli_fetch_assoc($query_id);
        $codigo = isset($data_id['id']) ? $data_id['id'] + 1 : 1;

        // Insertar cabecera del pedido
        $query = mysqli_query($mysqli, "INSERT INTO pedido_compra (
            id_pedido, fecha, hora, estado, id_user, id_sucursal
        ) VALUES (
            $codigo, '$fecha', '$hora', '$estado', $usuario, 
            (SELECT id_sucursal FROM usuarios WHERE id_user = $usuario)
        )") or die('Error al insertar cabecera: ' . mysqli_error($mysqli));

        // Insertar detalle del pedido agrupado por ingrediente
        $sql = mysqli_query($mysqli, "SELECT cod_ingrediente, SUM(cantidad_tmp) as cantidad_total 
                                      FROM tmp 
                                      WHERE session_id = '".session_id()."' 
                                      GROUP BY cod_ingrediente")
               or die('Error al obtener datos de tmp: ' . mysqli_error($mysqli));

        while ($row = mysqli_fetch_array($sql)) {
            $codigo_producto = $row['cod_ingrediente'];
            $cantidad        = $row['cantidad_total'];

            $insert_detalle = mysqli_query($mysqli, "INSERT INTO detalle_pedido_compra (
                id_ingrediente, id_pedido, cantidad
            ) VALUES (
                $codigo_producto, $codigo, $cantidad
            )") or die('Error al insertar detalle: ' . mysqli_error($mysqli));
        }

        // Eliminar registros temporales SOLO si todo fue bien
        $delete = mysqli_query($mysqli, "DELETE FROM tmp WHERE session_id = '".session_id()."'")
                  or die('Error al eliminar TMP: ' . mysqli_error($mysqli));

        // Redirigir con éxito
        header("Location: ../../main.php?module=pedido&alert=1");
    }
}
elseif ($_GET['act'] == 'anular') {
    if (isset($_GET['id_pedido'])) {
        $codigo = $_GET['id_pedido'];

        // Cambiar estado a anulado
        $query = mysqli_query($mysqli, "UPDATE pedido_compra 
                                        SET estado='anulado' 
                                        WHERE id_pedido=$codigo")
            or die('Error al anular pedido: ' . mysqli_error($mysqli));

        header("Location: ../../main.php?module=pedido&alert=2");
    }
}
//elseif($_GET['act']=='update'){
  //  if($_GET['act']=='update'){
        
    //}
   // $id_pedido = $_GET['id_pedido'];
  //  $consulta = "SELECT * FROM pedido_compra WHERE id_pedido = $id_pedido";
  //  $query = mysqli_query($mysqli, $consulta );
//    header("Location: ../../pedido/form.php?form='edit'");

    //var_dump(mysqli_fetch_assoc($query));
//}
?>
