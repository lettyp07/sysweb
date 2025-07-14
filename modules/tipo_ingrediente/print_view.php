<?php  
require_once "../../config/database.php";

$query = mysqli_query($mysqli, "SELECT * FROM tipo_ingrediente")
or die ('Error'.mysqli_error($mysqli));

$count = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../assets/img/favicon.ico">
    <title>Reporte de Departamento</title>
</head>
<body>
    <div align="center">
        <img src="../../images/user/ingrediente.jpg" width="100" height="100">
    </div>
    <div>
        Reporte de Tipo de producto
    </div>
    <div align="center">
        cantidad: <?php echo $count; ?> 
    </div>
    <hr>
    <div id="tabla">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0" align="center">
            <thead style="background: #e8ecee">
            <tr class="table-title">
            <th height="20" align="center" valign="middle"><small>Código</small></th>
            <th height="30" align="center" valign="middle"><small>Tipo de ingrediente</small></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            while ($data = mysqli_fetch_assoc($query)) {
                $codigo = $data['id_t_ingrediente'];
                $t_p_descrip = $data['t_ingrediente'];

                echo "<tr>
                <td width='100' align='left'>$codigo</td>
                <td width='100' align='left'>$t_p_descrip</td>
                </tr>";
            }
            
            ?>
        </tbody>
        </table>

    </div>
    
</body>
</html>