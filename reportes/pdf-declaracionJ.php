

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
    height:143px;  /* alto para los detalles de la parte superior */
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
   /* line-height:0.8em;
    font-size: 2rem;
   */
   /* text-align:center;*/font: 2em "Trebuchet MS",Arial,Sans-Serif;
   
    
}
#letraGrande{
    font: "Trebuchet MS",Arial,Sans-Serif;
    font-size: 2em;
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
    $total= $_GET['totalDeclarado'];
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


       

      
        $query_modif = "UPDATE guia_embarque set valor_mercancia = $total +$valor WHERE id_guia = $id_guia";
        $resultado= mysqli_query($conexion, $query_modif);
        if ($resultado) {
           /* die("Error al modificar guia");*/
        } 
      
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
        <p id="house" ><?php echo  $codigoBarra;  ?> </p>
      
        <p class= "interlineado"><strong>Fecha/Date: </strong><?php echo date("F") . " " . date("m") . ", " . date("Y");?> </p>
        <p class= "interlineado"> <strong>Factura/Invoice: <?php  echo  $string   ?></strong></p><br>

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
        
        <p><strong>Comentarios/Comments or Special</p>
        <br><br>Instructions:</strong>
       
    </div>
    <div class="receptor membretesSuperior">
        <h2  style="max-width:80%;" class="text-center" id="letraGrande" >Factura Comercial  </h2>
        <h2 class="text-center" style="max-width:80%;" id="letraGrande">(Commercial Invoice)</h2><br>
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
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall10']>0)  echo number_format($_GET['totall10'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt11'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn11'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall11']>0) echo number_format($_GET['precioo11'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall11']>0) echo number_format( $_GET['totall11'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt12'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn12'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall12']>0) echo number_format($_GET['precioo12'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall12']>0) echo number_format( $_GET['totall12'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt13'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn13'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall13']>0) echo number_format($_GET['precioo13'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall13']>0) echo number_format( $_GET['totall13'],2,',','.');?></p> </th>
        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt14'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn14'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall14']>0) echo number_format($_GET['precioo14'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall14']>0) echo number_format( $_GET['totall14'],2,',','.');?></p> </th>

        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt15'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn15'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall15']>0) echo number_format($_GET['precioo15'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall15']>0) echo number_format( $_GET['totall15'],2,',','.');?></p> </th>

        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt16'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn16'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall16']>0) echo number_format($_GET['precioo16'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall16']>0) echo number_format( $_GET['totall16'],2,',','.');?></p> </th>

        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt17'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn17'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall17']>0) echo number_format($_GET['precioo17'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall17']>0) echo number_format( $_GET['totall17'],2,',','.');?></p> </th>

        </tr>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt18'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn18'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall18']>0) echo number_format($_GET['precioo18'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall18']>0) echo number_format( $_GET['totall18'],2,',','.');?></p> </th>

        </tr>
        <?php  if (strlen($_GET['descripcionn19'])>0)
       { ?>

        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt19'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn19'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall19']>0) echo number_format($_GET['precioo19'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall19']>0) echo number_format( $_GET['totall19'],2,',','.');?></p> </th>

        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn20'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt20'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn20'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall20']>0) echo number_format($_GET['precioo20'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall20']>0) echo number_format( $_GET['totall20'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn21'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt21'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn21'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall21']>0) echo number_format($_GET['precioo21'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall21']>0) echo number_format( $_GET['totall21'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn22'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt22'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn22'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall22']>0) echo number_format($_GET['precioo22'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall22']>0) echo number_format( $_GET['totall22'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn23'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt23'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn23'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall23']>0) echo number_format($_GET['precioo23'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall23']>0) echo number_format( $_GET['totall23'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn24'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt24'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn24'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall24']>0) echo number_format($_GET['precioo24'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall24']>0)echo number_format( $_GET['totall24'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn25'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt25'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn25'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall25']>0) echo number_format($_GET['precioo25'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall25']>0) echo number_format( $_GET['totall25'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn26'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt26'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn26'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall26']>0) echo number_format($_GET['precioo26'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall26']>0) echo number_format( $_GET['totall26'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn27'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt27'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn27'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall27']>0) echo number_format($_GET['precioo27'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall27']>0) echo number_format( $_GET['totall27'],2,',','.');?></p> </th>
        </tr>


        <?php }?>
        <?php  if (strlen($_GET['descripcionn28'])>0)
       { ?>

            <tr>
                <th class="collapse"><p> <?php echo $_GET['cantt28'];?> </p></th>
                <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn28'];?></p></th>
                <th class="collapse"><p class="der"> <?php if ($_GET['totall28']>0) echo number_format($_GET['precioo28'],2,',','.' );?></p></th>
                <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall28']>0) echo number_format( $_GET['totall28'],2,',','.');?></p> </th>
            </tr>

        <?php }?>

        <?php  if (strlen($_GET['descripcionn29'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt29'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn29'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall29']>0) echo number_format($_GET['precioo29'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall29']>0) echo number_format( $_GET['totall29'],2,',','.');?></p> </th>
        </tr>

        <?php }?>
        
        <?php  if (strlen($_GET['descripcionn30'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt30'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn30'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall30']>0) echo number_format($_GET['precioo30'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall30']>0) echo number_format( $_GET['totall30'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn31'])>0)
       { ?>
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt31'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn31'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall31']>0) echo number_format($_GET['precioo31'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall31']>0) echo number_format( $_GET['totall31'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn32'])>0)
       { ?>     
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt32'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn32'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall32']>0) echo number_format($_GET['precioo32'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall32']>0) echo number_format( $_GET['totall32'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn33'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt33'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn33'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall33']>0) echo number_format($_GET['precioo33'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall33']>0) echo number_format( $_GET['totall33'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn34'])>0)
       { ?>  
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt34'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn34'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall34']>0) echo number_format($_GET['precioo34'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall34']>0) echo number_format( $_GET['totall34'],2,',','.');?></p> </th>
        </tr>        
        <?php }?>
        <?php  if (strlen($_GET['descripcionn35'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt35'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn35'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall35']>0) echo number_format($_GET['precioo35'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall35']>0) echo number_format( $_GET['totall35'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn36'])>0)
       { ?>         
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt36'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn36'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall36']>0) echo number_format($_GET['precioo36'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall36']>0) echo number_format( $_GET['totall36'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn37'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt37'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn37'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall37']>0) echo number_format($_GET['precioo37'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall37']>0) echo number_format( $_GET['totall37'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn38'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt38'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn38'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall38']>0) echo number_format($_GET['precioo38'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall38']>0) echo number_format( $_GET['totall38'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn39'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt39'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn39'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall39']>0) echo number_format($_GET['precioo39'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall39']>0) echo number_format( $_GET['totall39'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn40'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt40'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn40'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall40']>0) echo number_format($_GET['precioo40'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall40']>0) echo number_format( $_GET['totall40'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn41'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt41'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn41'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall41']>0) echo number_format($_GET['precioo41'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall41']>0) echo number_format( $_GET['totall41'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn42'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt42'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn42'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall42']>0) echo number_format($_GET['precioo42'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall42']>0) echo number_format( $_GET['totall42'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn43'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt43'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn43'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall43']>0) echo number_format($_GET['precioo43'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall43']>0) echo number_format( $_GET['totall43'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn44'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt44'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn44'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall44']>0) echo number_format($_GET['precioo44'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall44']>0) echo number_format( $_GET['totall44'],2,',','.');?></p> </th>
        </tr>    
          <?php }?>
          <?php  if (strlen($_GET['descripcionn45'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt45'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn45'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall45']>0) echo number_format($_GET['precioo45'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall45']>0) echo number_format( $_GET['totall45'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn46'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt46'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn46'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall46']>0) echo number_format($_GET['precioo46'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall46']>0) echo number_format( $_GET['totall46'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn47'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt47'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn47'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall47']>0) echo number_format($_GET['precioo47'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall47']>0) echo number_format( $_GET['totall47'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn48'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt48'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn48'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall48']>0) echo number_format($_GET['precioo48'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall48']>0) echo number_format( $_GET['totall48'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn49'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt49'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn49'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall49']>0) echo number_format($_GET['precioo49'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall49']>0) echo number_format( $_GET['totall49'],2,',','.');?></p> </th>
        </tr>
        <?php }?>
        <?php  if (strlen($_GET['descripcionn50'])>0)
       { ?> 
        <tr>
            <th class="collapse"><p> <?php echo $_GET['cantt50'];?> </p></th>
            <th class="collapse"><p class="izq"> <?php echo $_GET['descripcionn50'];?></p></th>
            <th class="collapse"><p class="der"> <?php if ($_GET['totall40']>0) echo number_format($_GET['precioo50'],2,',','.' );?></p></th>
            <th class="color_columna collapse"><p class="der"> <?php if  ($_GET['totall50']>0) echo number_format( $_GET['totall50'],2,',','.');?></p> </th>
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
