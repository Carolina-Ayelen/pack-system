<?php
include "../conexion.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM guia_embarque WHERE id_guia = $id";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $id_guia = $row['id_guia'];
        $peso_real = $row['peso_real'];
        $cod_origen = $row['cod_origen'];
        $cod_destino = $row['cod_destino'];
        $fecha = $row['fecha_emb'];
        $valor = $row['valor_mercancia'];
        $tipo_bulto = $row['tipo_bulto'];
        $num_bulto = $row['cantidad_bulto'];
        $empaquetado = $row['empaquetado'];
        $peso_volumetrico = $row['peso_volumetrico'];
        $icontem = $row['incotem'];
        $destinatario = $row['personasDest_id'];
        $remitente = $row['personasEnv_id'];
        $descripcion = $row['descripcion'];
    }

}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Administrativo Pack</title>
    <meta name="keywords" content="">
    <meta name="description" content="Gestión de Cheques">
    <meta name="author" content="Carolina Ayelen Calviño">
    <!--Css-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href='css/style.css'>
    <link href="css/dashboard.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <!--iconos-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <!--Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
<br>
<h2>Declaración Jurada</h2>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <p><strong>Fecha/Date: </strong><?php echo date("F") . " " . date("m") . ", " . date("Y");?> </p>
            <p><strong>Factura/Invoice: </strong></p>
        </div>
        <div class="col-md-6">
            <h2 class="text-center" style="max-width:70%;">Factura Comercial (Commercial Invoice)</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p class="text-center"><strong><u>SHIPPER:</u></strong></p>
        </div>
        <div class="col-md-6">
            <p class="text-center"><strong><u>SHIPPED TO:</u></strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
            $queryPais = "SELECT * FROM cod_pais WHERE id_pais =$cod_origen";
            $resultadoPais= mysqli_query($conexion, $queryPais);
            while ($rowPais = $resultadoPais->fetch_assoc()) {?>
            <div>
                 <?php
                    $codPais = $rowPais['codigo'];
                ?>
                <p><strong>Enviado desde: </strong><?php echo $codPais; ?></p>
            </div> <?php
            } ?>
            <?php
                $queryEnvia = "SELECT * FROM personas WHERE id_persona =$remitente";
                $resultadoEnv = mysqli_query($conexion, $queryEnvia);
                while ($rowEnv = $resultadoEnv->fetch_assoc()) {?>
                 <p><strong>I.D / RUC / Passport: </strong><?php echo $rowEnv['dni']; ?></p>
                 <p><strong>Contacto/Contact: </strong><?php echo $rowEnv['nombre'] . ' ' . $rowEnv['apellidos']; ?></p>
                 <p><strong>Teléfono/Phone: </strong><?php echo $rowEnv['tel']; ?></p>
                 <p><strong>E-mail: </strong><?php echo $rowEnv['correo']; ?></p>
                 <p><strong>Compañía/Company: </strong><?php echo $rowEnv['correo']; ?></p>
                 <p><strong>Direccion/Address: </strong><?php echo $rowEnv['direccion'] . ' ' . $rowEnv['pais'] . ' ' . $rowEnv['departamento']; ?></p>
            <?php
                }?>
        </div>
        <div class="col-md-6">
            <?php
            $queryPais = "SELECT * FROM cod_pais WHERE id_pais =$cod_destino";
            $resultadoPais= mysqli_query($conexion, $queryPais);
            while ($rowPais = $resultadoPais->fetch_assoc()) {?>
            <div>
                 <?php
                    $codPais = $rowPais['codigo'];
                ?>
                <p><strong>Enviado desde: </strong><?php echo $codPais; ?></p>
            </div> <?php
            } ?>
            <?php
                $queryEnvia = "SELECT * FROM personas WHERE id_persona =$destinatario";
                $resultadoEnv = mysqli_query($conexion, $queryEnvia);
                while ($rowEnv = $resultadoEnv->fetch_assoc()) {?>
                 <p><strong>I.D / RUC / Passport: </strong><?php echo $rowEnv['dni']; ?></p>
                 <p><strong>Contacto/Contact: </strong><?php echo $rowEnv['nombre'] . ' ' . $rowEnv['apellidos']; ?></p>
                 <p><strong>Teléfono/Phone: </strong><?php echo $rowEnv['tel']; ?></p>
                 <p><strong>E-mail: </strong><?php echo $rowEnv['correo']; ?></p>
                 <p><strong>Compañía/Company: </strong><?php echo $rowEnv['correo']; ?></p>
                 <p><strong>Direccion/Address: </strong><?php echo $rowEnv['direccion'] . ' ' . $rowEnv['pais'] . ' ' . $rowEnv['departamento']; ?></p>
            <?php
                }?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Comentarios/Comments or Special Instructions:</strong></p>
        </div>
        <div class="col-md-6">
            <p><strong>Incoterm: </strong><?php echo $icontem; ?></p>
        </div>
    </div>
</div>
<div class="divider" style="border-top:solid #dededf 1.5px;"></div>
<br>
<div class="container">
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <label for=""><strong>Descripción</strong></label>
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <label for=""><strong>Cantidad (Quantity)</strong></label>
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <label for=""><strong>Precio Unitario</strong></label>
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <label for=""><strong>Cantidad (Amount)</strong></label>
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row ">
        <div class="col-md-4 field_wrapper">
            <input type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
        </div>
        <div class="col-md-2 field_wrapper">
            <input type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onclick="cantidad();">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <p><strong>The exporter of the products covered by this document   declares that, except where otherwise clearly indicated, these products are of  URUGUAY,  preferential origin.  I/We hereby certify that the information on this invoice is true and correct and that the contents of this shipment are as stated above.</strong></p>
            <p><strong>Declaro que según mi leal saber y enteder, la informacion antes mencionada es cierta y correcta, ademas que este envio se origina en el pais de URUGUAY.</strong></p>
        </div>
        <div class="col-md-6">
            <p>TAX RATE</p>
            <p>SALES TAX</p>
            <p>SHIPPING & HANDLING</p>
            <span><strong>Sub TOTAL: $</strong><span id= "resultado"></span></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?php
             $queryEnvia = "SELECT * FROM personas WHERE id_persona =$remitente";
             $resultadoEnv = mysqli_query($conexion, $queryEnvia);
             while ($rowEnv = $resultadoEnv->fetch_assoc()) {?>
              <p><strong>Nombre/Name: </strong><?php echo $rowEnv['nombre'] . ' ' . $rowEnv['apellidos']; ?></p> 
            <?php
            }?></span>
        </div>
        <div class="col-md-6">
            <p><strong>Firma/Signature: </strong>_____________________</p>
        </div>
    </div>
</div>

<script src="js/main.js"></script>

</body>
</html>
