<?php
include "conexion.php";
$valorSelect=$_POST["valorSelect"];//recojemos lo seleccionado

$query = "SELECT * FROM personas where id_persona= $valorSelect";
$result = mysqli_query($conexion, $query);

/*$query=mysqli_query($conn,"SELECT * FROM boletin WHERE Departamento = '" . $valorSelect . "'");*/

$row=mysqli_fetch_array($result );?><br>
<?php  echo "DATOS"?><br>
<?php echo $row['nombre'];?><br>
<?php echo $row['apellidos'];?><br>
<?php echo $row['direccion'];?><br>
<?php echo $row['tel'];?><br>
<?php echo $row['correo'];?><br>
<?php /*echo '<a href="editar-cliente.php?id='. $row['id_persona'].'&regreso=remitente'.'"><button type="button" class="btn btn-light">modificar Datos</button></a>';*/?>
<?php echo '<a href="editar-cliente.php?regreso=remitente'.'&id='. $row['id_persona'].'"><button type="button" class="btn btn-light">modificar Datos</button></a>';?>