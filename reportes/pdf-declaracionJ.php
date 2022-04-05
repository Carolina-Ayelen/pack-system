

<style>

@page {
    margin:0;
}

/*#footer { position: fixed; right: 0px; bottom: 10px; text-align: center;border-top: 1px solid black;}
        #footer .page:after { content: counter(page, decimal); }
 @page { margin: 20px 30px 40px 50px; }

*/

/*#header { position: fixed; right: 0px; bottom: 10px; text-align: center;border-top: 1px solid black;}
#header .page:after { content: counter(page, decimal); }
 @page { margin: 5px 3px 4px 5px; }*/


.detalleSuperior{
    width: 900px;
    height:122px;  /* alto para los detalles de la parte superior */
    border:5px solid red;
    background:red;
    color:black;
    display:flex;
    align-items:flex-end;
    line-height:0.1em;
    
    
}
.destinatario{
    width:200px;
    height:100px;
   
}
.receptor{
    width:250px;
    height:100px;
    margin-left:260px;

}

.direccion{
    line-height:0.8em;
}
.membretesSuperior{
    font-size: 0.6rem;
    
}
.membretes{
    font-size: 0.6rem;
    font-style:italic;
    Background:#00001a;
    line-height:.9em;
    color:white;
    
}
.nombre{
    font-size: 0.8rem;
}
.letraDetalles{
    font-size: 0.6rem;
    line-height:0.1rem;
}

.letraDetallesPie{
    font-size: 0.6rem;
    line-height:0.1rem;
}

.letraDetallesNotaPie{
    font-size: 0.5rem;
    line-height:0.9rem;
    margin-right:10px;
}
.detalles{
    width: 1020px;
    height:50px;
    border:5px solid red;
    background:red;
    color:black;
    display:flex;
    align-items:flex-end;
    margin-top:200px;
    line-height:0.7em;
    
}
.cantidad{
    width:115px;
    height:150px;
  
    /*background:blue;*/
}
.descripcion{
    width:155px;
    height:150px;
    margin-left:115px;
    margin-right:300px;
    /*background:green;*/
}
.precio{
    width:180px;
    height:150px;
    margin-left:270px;
    /*background:red;*/
    
}
.total{
    width:100px;
    height:150px;
    margin: right 370px;
    /*background:red;*/
    
}
.pieTabla{
    line-height:1em;
    margin-left:10px;
}

#house{
    color:red;
    margin-left:50px;
    line-height:0.8em;
    
    /*text-align:center;*/
    
}

.color_columna{
    background:#ccccff;
}

.interno{
border: 1px solid black;
}
.collapse{
    border-collapse:collapse;
    border: 1px solid black;
    padding:0;
}
table{
    width:100%;
    padding:0;
}

.izq{
    text-align:left;
    margin:2px;
}

.der{
    text-align:right;
    margin-right:3px;
}

.cant{
    width:20%;
}

.desc{
    width:37%; 
}

.interlineado{
 
}
</style>


</head>   
<?php

include "../conexion.php";


if (isset($_GET['id_guia'])) {
    $id = $_GET['id_guia'];
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

<body>
<!--<div id="header">
    <p class="page">Page </p>
  </div> 
-->
<div class="detalleSuperior ">
    
    <div class="destinario membretesSuperior">
    <?php
        $queryPais = "SELECT * FROM cod_pais WHERE id_pais =$cod_origen";
        $resultadoPais= mysqli_query($conexion, $queryPais);
        while ($rowPais = $resultadoPais->fetch_assoc()) {?>
        <div>
                <?php
                $codPais = $rowPais['codigo'];
                $length = 5;
                $string = substr(str_repeat(0, $length).$id_guia, - $length);
                $codigoBarra= $codPais . $string;
            ?>
        <h4 id="house"><?php echo  $codigoBarra;  ?> </h4>
        <p class= "interlineado"><strong>Fecha/Date: </strong><?php echo date("F") . " " . date("m") . ", " . date("Y");?> </p>
        <p class= "interlineado"> <strong>Factura/Invoice: <?php  echo  $string   ?></strong></p>

        <p ><strong><u>SHIPPER:</u></strong></p>


            <p><strong>Desde: </strong><?php echo $codPais; ?></p>
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
            <p class="direccion"><strong>Direccion/Address: </strong><?php echo $rowEnv['direccion'] . ' ' . $rowEnv['pais'] . ' ' . $rowEnv['departamento']; ?></p>
        <?php
            }?>
        <br>
        <p><strong>Comentarios/Comments or Special</p>
        <br><br>Instructions:</strong>
       
    </div>
    <div class="receptor membretesSuperior">
        <h2 class="text-center" style="max-width:80%;">Factura Comercial  </h2>
        <h2 class="text-center" style="max-width:80%;">(Commercial Invoice)</h2><br>
        <p class="text-center"><strong><u>SHIPPED TO:</u></strong></p>
            

        <?php
        $queryPais = "SELECT * FROM cod_pais WHERE id_pais =$cod_destino";
        $resultadoPais= mysqli_query($conexion, $queryPais);
        while ($rowPais = $resultadoPais->fetch_assoc()) {?>
        <div>
                <?php
                $codPais = $rowPais['codigo'];
            ?>
            <p><strong>A: </strong><?php echo $codPais; ?></p>
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
                <p class="direccion"><strong>Direccion/Address: </strong><?php echo $rowEnv['direccion'] . ' ' . $rowEnv['pais'] . ' ' . $rowEnv['departamento']; ?></p>
        <?php
            }?>
        
        <p><strong>Incoterm: </strong><?php echo $icontem; ?></p>
        
    </div>
</div>

<br>
<br>
<?php echo $_GET['cant5'];
?>
<table class="collapse">
    <thead class="membretes">
        <tr>
            <th class="cant">Cantidad (Quantity)</th>
            <th class="desc">Descripcion (Description)</th>
            <th>Precio Unitario <br> (Unit Price)</th>
            <th>Cantidad (Amount)
        </tr>  
    </thead>     
    <tbody class="letraDetalles "> 
        <tr class="collapse">
            <th class="collapse"><p> <?php echo $_GET['cant1'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion1'];?></p></th>
            <th class="collapse"><p  class="der"> <?php echo number_format($_GET['precio1'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['total1']>0) echo number_format($_GET['total1'],2,',','.');?></p> </th>
        </tr>  
        <tr class="collapse">
            <th class="collapse"><p> <?php echo $_GET['cant2'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion2'];?></p></th>
            <th class="collapse"><p  class="der"> <?php  if ($_GET['total2']>0) echo number_format($_GET['precio2'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['total2']>0) echo number_format($_GET['total2'],2,',','.');?></p> </th>
        </tr> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant3'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion3'];?></p></th>
            <th class="collapse"><p  class="der"> <?php if ($_GET['total3']>0) echo number_format($_GET['precio3'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['total3']>0) echo number_format($_GET['total3'],2,',','.');?></p> </th>

        </tr> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant4'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion4'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['total4']>0) echo number_format($_GET['precio4'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['total4']>0) echo number_format($_GET['total4'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt5']; ?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn5'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall5']>0) echo number_format($_GET['precioo5'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall5']>0) echo number_format($_GET['totall5'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt6'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn6'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall6']>0) echo number_format($_GET['precioo6'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall6']>0) echo number_format($_GET['totall6'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt7'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn7'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall7']>0) echo number_format($_GET['precioo7'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall7']>0) echo number_format($_GET['totall7'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt8'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn8'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall8']>0) echo number_format($_GET['precioo8'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall8']>0) echo number_format($_GET['totall8'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn9'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall9']>0) echo number_format($_GET['precioo9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall9']>0) echo number_format($_GET['totall9'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt10'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn10'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall10']>0) echo number_format($_GET['precioo10'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="izq"> <?php if  ($_GET['totall10']>0)  echo number_format($_GET['totall10'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt11'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn11'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall11']>0) echo number_format($_GET['precioo11'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="izq"> <?php if  ($_GET['totall11']>0) echo $_GET['totall11'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant12'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion12'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total12']>0) echo number_format($_GET['precio12'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total12']>0) echo $_GET['total12'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant13'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion13'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total13']>0) echo number_format($_GET['precio13'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total13']>0) echo $_GET['total13'];?></p> </th>
        </tr>

        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant14'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion14'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total14']>0) echo number_format($_GET['precio14'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total14']>0) echo $_GET['total14'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant15'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion15'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total15']>0) echo number_format($_GET['precio15'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total15']>0) echo $_GET['total15'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant16'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion16'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total16']>0) echo number_format($_GET['precio16'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total16']>0) echo $_GET['total16'];?></p> </th>
        </tr>

        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant17'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion17'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total17']>0) echo number_format($_GET['precio17'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total17']>0) echo $_GET['total17'];?></p> </th>
        </tr>
      

        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant18'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion18'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total18']>0) echo number_format($_GET['precio18'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total18']>0) echo $_GET['total18'];?></p> </th>
        </tr>

        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant19'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total19']>0) echo number_format($_GET['precio19'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total19']>0) echo $_GET['total19'];?></p> </th>
        </tr>
 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <?php  if (strlen($_GET['descripcion20'])>1)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cant9'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcion9'];?></p></th>
            <th class="collapse"><p> <?php if ($_GET['total9']>0) echo number_format($_GET['precio9'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p> <?php if  ($_GET['total9']>0) echo $_GET['total9'];?></p> </th>
        </tr>
        <?php }?>
        <tr>
            <td colspan= "2"  rowspan="4"> <p class="pieTabla"><strong>The exporter of the products covered by this document   declares that, except where otherwise clearly indicated, these products are of  URUGUAY,  preferential origin.  I/We hereby certify that the information on this invoice is true and correct and that the contents of this shipment are as stated above.</strong> </p>
            </td> 
            <td class="collapse"><p class="der letraDetallesPie"><strong>TAX RATE</strong></p> </td>
            <td class="collapse"><p class="der">0,00%</p> </td>

            
        </tr>
        <tr>
            <td class="collapse "><p class="der letraDetallesPie"><strong> SALES TAX</strong></p> </td>
            <td class="collapse color_columna"><p class="der">0,00</p> </td>

        </tr> 
        <tr>   
            <td class="collapse"><p class="der letraDetallesPie "><strong>SHIPPING & HANDLING </strong></p> </td>
            <td class="collapse"><p class="der"> <strong>0,00</strong></p> </td>
        <tr>  
            <td class="collapse"><p class="der letraDetallesPie "><strong>Sub TOTAL</strong></p> </td>
            <td class="collapse color_columna"><p class="der"><strong><?php echo number_format($_GET['totalDeclarado'],2,',','.');?></strong></p> </td>
        </tr>
        
    </tbody>    
</table > 
<p class=" letraDetalles pieTabla"><strong>Declaro que según mi leal saber y enteder, la informacion antes mencionada es cierta y correcta, ademas que este envio se origina en el pais de URUGUAY. </p>
<br>

<?php
    $queryEnvia = "SELECT * FROM personas WHERE id_persona =$remitente";
    $resultadoEnv = mysqli_query($conexion, $queryEnvia);
    while ($rowEnv = $resultadoEnv->fetch_assoc()) {?>
    <p class="letraDetalles"><strong>Nombre/Name: </strong><?php echo $rowEnv['nombre'] . ' ' . $rowEnv['apellidos']; ?>    &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Firma/Signature: </strong>_____________________</p> 
    <?php
    }?></span>
<p class="letraDetallesNotaPie"> <strong>ADJUNTAR Y ARCHIVAR COPIAS DE LA DECLARACION DE SEGURIDAD, COPIA DE PASAPORTE O IDENTIDAD PERSONAL, LICENCIA DE <br> CONDUCIR</strong></p>				
	
<!--div id="footer">
    <p class="page">Page </p>
  </div> -->

<script>



    

</body>
</html>
