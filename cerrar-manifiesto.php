<?php
include("session.php");
include("conexion.php");

if (isset($_GET['id_manifiesto'])) {
    $id_manifiesto = $_GET['id_manifiesto'];
    $guiaAWB=$_GET['guiaAWB'];

    $query = "UPDATE manifiesto set estado = '1'  WHERE id_manifiesto = $id_manifiesto";
    $resultado= mysqli_query($conexion, $query);
    if (!$resultado) {
        die("Query failed");
    } else {
        // seleccionar todos los nuemros de guia contenidos en el manifiesto, y con ciclo mientras ponerle a cada uno estdo en 3. cerrado
        $query = "UPDATE guia_embarque set estado = '3'  WHERE id_manifiesto = $id_manifiesto";
        $resultado= mysqli_query($conexion, $query);
        if (!$resultado) {
            die("Query failed");
        } else {
            $_SESSION['message'] = "Registro modificado con exito";
            $_SESSION['message-type'] = 'success';
            header('Location: manifiesto.php');
        }

        $_SESSION['message'] = "Registro modificado con exito";
        $_SESSION['message-type'] = 'success';
        header('Location: manifiesto.php');
    }
}    
?>