
<?php
include "session.php";
include "conexion.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/footer.php";

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
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Lobster&family=Nothing+You+Could+Do&family=Peddana&family=Rancho&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/80d0152778.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<br>
<h2>Declaración Jurada</h2>

<br>
<form id="formularioDJ"  method="GET" action="reportes\pdfdeclaracionJ.php" target= "_blank">
    <input type="hidden" name="id_guia" value=<?php echo $id; ?> >

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
                    <input  name="descripcion1" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <label for=""><strong>Cantidad (Quantity)</strong></label>
                    <input  name="cant1" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <label for=""><strong>Precio Unitario</strong></label>
                    <input name="precio1" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <label for=""><strong>Cantidad (Amount)</strong></label>
                    <input name="total1" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
 
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcion2" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant2" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio2" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total2" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
             
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion3" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant3" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio3" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total3" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion4" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant4" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio4" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total4" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>

            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn5" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt5" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo5" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall5" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn6" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt6" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo6" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall6" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn7" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt7" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo7" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="totall7" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn8" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt8" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo8" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall8" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn9" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt9" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo9" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall9" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn10" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt10" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo10" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall10" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn11" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="cantt11" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo11" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall11" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn12" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt12" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo12" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall12" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn13" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt13" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo13" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall13" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn14" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt14"type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo14" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall14" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn15" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt15" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo15" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 fielo_wrapper">
                    <input name="totall15" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn16" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt16" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo16" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall16" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn17" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt17" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo17" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall17" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn18" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt18" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo18" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall18" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn19" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt19" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo19" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall19" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn20" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt20" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo20" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall20" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
           
        <!-- pagina dos-->


            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn21" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="cantt21" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo21" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">

                    <input name="totall21" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn22" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt22" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo22" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall22" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion23" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant23" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio23" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total23" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion24" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant24"type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio24" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total24" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion5" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant5" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio5" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total5" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion6" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant6" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio6" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total6" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion7" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant7" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio7" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="total7" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion8" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant8" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio8" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total8" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion9" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant9" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio9" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total9" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion10" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant10" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio10" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total10" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcion11" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="cant11" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio11" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total11" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcion12" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant12" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio12" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total12" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion13" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant13" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio13" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total13" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion14" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant14"type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio14" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total14" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion15" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant15" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio15" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total15" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion16" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant16" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio16" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total16" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion17" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant17" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio17" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total17" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion18" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant18" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio18" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total18" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion19" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant19" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio19" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total19" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcion20" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cant20" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precio20" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total20" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeyup="cantidad();">
                </div>
            </div>
        <!--<button onclick="declaracionPDF()">Generar PDF acá</button>-->
        <!-- inicio código otra forma de llenar la declaración-->

        <!--
        <div class="contenedorPedido">

        <h4>
        Detalles a Declarar!
        </h4>

        <form id="formulario">

            <input name="productos" id="producto">
            <label id="color">Cantidad</label>
            <input type="number" placeholder="Cantidad" id="cantidad">
            <input type="number" type="text" id="precio"> 
        <button type="submit" >Añadir al pedido</button> <br><br>

        </form>

        <div id="listaProductos" >
        <div>
            <i class="material-icons ">
            accessibility
            </i>
            <b>Productos del pedido</b>
            <span >
            <i class="material-icons">
                delete
            </i>
            </span>
        </div>
        </div>
        </div>

        </div>

        <div id="confirmacion" class="contenedorPedido"></div>
        </div>
         -->
        <!-- fin otra forma de llenar la declaracion-->

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
                <input type="hidden" name="totalDeclarado" id="totalDeclarado" value="">
                
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

    <button type="submit" >Generar PDF</button> <br><br>
</form>

<script src="js/main.js"></script>
<!--<script src="js/declaracion.js"></script>-->
</body>
