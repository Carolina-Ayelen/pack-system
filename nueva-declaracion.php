
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
                    <input name="precio1" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <label for=""><strong>Cantidad (Amount)</strong></label>
                    <input name="total1" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precio2" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;"  onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total2" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precio3" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;"  onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total3" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precio4" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;"  onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="total4" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo5" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall5" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precioo6" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall6" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precioo7" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="totall7" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo8" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall8" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precioo9" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall9" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precioo10" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall10" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo11" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall11" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precioo12" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall12" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo13" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall13" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo14" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall14" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo15" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 fielo_wrapper">
                    <input name="totall15" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo16" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall16" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="totall17" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeydown="cantidad();">
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
                    <input name="precioo18" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall18" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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
                    <input name="precioo19" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall19" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo20" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall20" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo21" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall21" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
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
                    <input name="precioo22" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall22" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn23" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt23" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo23" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall23" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn24" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt24"type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo24" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall24" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn25" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt25" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo25" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall25" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn26" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt26" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo26" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall26" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn27" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt27" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo27" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="totall27" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn28" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt28" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo28" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall28" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn29" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt29" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo29" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall29" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;">
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn30" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt30" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo30" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall30" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn31" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt31" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo31" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall31" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>

            <div class="row ">
                <div class="col-md-4 field_wrapper">
                        <input  name="descripcionn32" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                    </div>
                    <div class="col-md-2 field_wrapper">
                        <input name="cantt32" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                    </div>
                    <div class="col-md-2 field_wrapper">
                        <input name="precioo32" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                    </div>
                    <div class="col-md-2 field_wrapper">
                        <input name="totall32" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;">
                    </div>
                
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn33" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt33" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo33" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall33" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn34" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt34"type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo34" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall34" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn35" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt35" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo35" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall35" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn36" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt36" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo36" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall36" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn37" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt37" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo37" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall37" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn38" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt38" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo38" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall38" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn39" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt39" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo39" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall39" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn40" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt40" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo40" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall40" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn41" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt41" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo41" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall41" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn42" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt42" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo42" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall42" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  onkeydown="cantidad();">
                </div>
            </div>
             
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn43" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt43" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo43" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall43" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn44" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt44" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo44" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall44" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>

            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input  name="descripcionn45" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt45" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo45" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall45" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn46" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt46" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo46" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall46" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn47" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt47" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo47" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input  name="totall47" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn48" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt48" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo48" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall48" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn49" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt49" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo49" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall49" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
            </div>
            <div class="row ">
                <div class="col-md-4 field_wrapper">
                    <input name="descripcionn50" type="text" class="form-control descripcion" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="cantt50" type="number" class="form-control cantidad" style="padding: 4px; border-radius: 0.3rem;" >
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="precioo50" type="number" step="any" class="form-control precio" style="padding: 4px; border-radius: 0.3rem;" onkeydown="cantidad();">
                </div>
                <div class="col-md-2 field_wrapper">
                    <input name="totall50" type="number" step="any" class="form-control total" style="padding: 4px; border-radius: 0.3rem;"  >
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

    <button type="submit" class="btn btn-primary">Generar PDF</button> <br><br>
</form>

<script src="js/main.js"></script>
<!--<script src="js/declaracion.js"></script>-->
</body>