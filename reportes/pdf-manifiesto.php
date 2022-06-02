
<?php
include_once '../vendor/autoload.php' ;
require_once '../dompdf/autoload.inc.php';

use Dompdf\Dompdf;
$dompdf = new Dompdf();

ob_start();
?>
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
    
    color:black;
    display:flex;
    align-items:flex-end;
    line-height:0.1em;
    
    
}

/*
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




.pieTabla{
    line-height:1em;
    margin-left:10px;
}

#house{
    color:red;
    margin-left:50px;
    line-height:0.8em;
    
    
    
}*/
/*
.color_columna{
    background:#ccccff;
}

.interno{
border: 1px solid black;
}

table{
    width:100%;
    padding:0;
}
*/
.izq{
    text-align:left;
    margin:2px;
    width: 110px;
    
}
.expedidor{
    width: 350px; 
}

.der{
    text-align:right;
    margin-right:3px;
}
.centrar{
    text-align:center;
}
.collapse{
    border-collapse:collapse;
   /* border: 1px solid black;*/
    padding:0;
   
}


/*
.cant{
    width:20%;
}

.desc{
    width:37%; 
}
*/
.interlineado_nombre{
  line-height:1.2em;
  width: 350px;
  text-align:left;
    margin-right :6px;
    
}
.origen{
    width: 180px;
}

</style>


</head>   
<?php

include "../conexion.php";


if (isset($_GET['id_manifiesto'])) {
    $id_manifiesto = $_GET['id_manifiesto'];
    $guiaAWB=$_GET['guiaAWB'];
    $query = "SELECT * FROM manifiesto WHERE id_manifiesto = $id_manifiesto";
    $resultado = mysqli_query($conexion, $query);

    if (mysqli_num_rows($resultado) == 1) {
        $row = mysqli_fetch_array($resultado);
        $id_manifiesto = $row['id_manifiesto'];
        $numero=$row['numero'];
        $cod_origen = $row['cod_origen'];
        $cod_destino = $row['cod_destino'];
        $fecha = $row['fecha'];
        $vuelo = $row['vuelo'];
        $consignatario=$row['consignatario'];
        $expedidor = $row['expedidor'];
        $electronico=$row['electronico'];


        $modf_numero = "UPDATE manifiesto set numero = '$guiaAWB'  WHERE id_manifiesto = $id_manifiesto";
        $resultado= mysqli_query($conexion, $modf_numero);
        if (!$resultado) {
           echo 'error guardando numero externo';
        } 

    }


}


?>

<body>
<!--<div id="header">
    <p class="page">Page </p>
  </div> 
-->
<div >


    <div class="destinario membretesSuperior">
    <?php
        $queryPais = "SELECT * FROM cod_pais WHERE id_pais =$cod_origen";
        $resultadoPais= mysqli_query($conexion, $queryPais);
        while ($rowPais = $resultadoPais->fetch_assoc()) {?>
        <div>
                <?php

                $barHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
                $codPais = $rowPais['codigo'];
                $length = 5;
                if (strlen($numero)>0){
                    $string = substr(str_repeat(0, $length).$numero, - $length);
                }
                else{
                    $string = substr(str_repeat(0, $length).$id_manifiesto, - $length);
                }
                $codigoBarra= $codPais . $string;
               /* echo $barHTML->getBarcode($codigoBarra, $barHTML::TYPE_CODE_128);
                 echo $codigoBarra;*/
        }
           
        $queryPais_destino = "SELECT * FROM cod_pais WHERE id_pais =$cod_destino";
        $resultadoPais_dest= mysqli_query($conexion, $queryPais_destino);
        while ($rowPais_dest = $resultadoPais_dest->fetch_assoc()) {
            $codPais_dest = $rowPais_dest['codigo'];    
        }

            ?>
<h2 class="centrar">COURIER MANIFEST</h2>
<table class="collapse">
    <thead class="membretes">
        <tr>
            <th class="cant"></th>
            <th class="desc"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr> 
    </thead>  
    <tbody class="letraDetalles "> 
        <tr class="collapse">
            <th class="collapse"><p class="izq"> DATE</p></th>
            <th class="collapse"><p class="der">: <?php echo date("D") . " " . date("m") . ", " . date("Y");?> </p></th>
            <th class="collapse"><p class="izq"> </p></th>
            <th class="collapse">


            </th>
            <th class="color_columna collapse"><p class="der"></p> </th>
        </tr> 

        <tr class="collapse">
            <th class="collapse"><p class="izq"> FLIGHT</p></th>
            <th class="collapse"><p class="izq">:  <?php  echo  $vuelo   ?></p></th>
            <th class="collapse"><p class="izq"> </p></th>
            <th class="collapse">

            <th class="collapse">

           <?php echo $barHTML->getBarcode($codigoBarra, $barHTML::TYPE_CODE_128);
                 echo $codigoBarra;?>

            </th>

            </th>
            <th class="color_columna collapse"><p class="der"></p> </th>
        </tr>     
        <tr class="collapse">
            <th class="collapse"><p class="izq"> MAWB</p></th>
            <th class="collapse"><p class="izq">  <?php  echo  ':'.$codPais . $guiaAWB;   ?></p></th>
            <th class="collapse"><p class="izq"> </p></th>
            <th class="collapse">
            </th>
            <th class="color_columna collapse"><p class="der"></p> </th>
        </tr>    
        
    </tbody>       
</table>
<!--segunda parte-->
<table class="collapse">
    <thead class="membretes">
        <tr>
            <th class="cant"></th>
            <th class="desc"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr> 
    </thead>  
    <tbody class="letraDetalles "> 
        <tr class="collapse">
            <th class="collapse"><p class="izq"> ORIGIN</p></th>
            <th class="collapse"><p class="izq">:<?php  echo  $codPais   ?> </p></th>
            <th class="collapse"><p class="izq"> SHIPPER</p></th>
            <th class="collapse"><P class="izq expedidor">:<?php  echo  $expedidor ?></P></th>
            <th class="collapse"><p class="izq"> CONSIGNEE</p></th>
            <th class="collapse"><P class="izq expedidor">:<?php  echo  $consignatario ?></P></th>
        </tr> 

        <tr class="collapse">
            <th class="collapse"><p class="izq"> DESTINATION</p></th>
            <th class="collapse"><p class="izq">: <?php  echo $codPais_dest;   ?></p></th>
            <th class="collapse"><p class="izq"> </p></th>
            <th class="collapse">
            <th class="collapse"></th>

            <th class="color_columna collapse"><p class="der"></p> </th>
        </tr>     
       
    </tbody>       
</table>

<br><br>



        </div> 
        
            <?php
        $query = "SELECT * FROM manif_embarq WHERE manifiesto_id = $id_manifiesto";
        $resultadoGuias = mysqli_query($conexion, $query);
        while ($rowEnv = $resultadoGuias->fetch_assoc()) {
            $id_guia = $rowEnv['guia_id'];
            $query = "SELECT * FROM guia_embarque WHERE id_guia = $id_guia";
            $resultado = mysqli_query($conexion, $query);

            if (mysqli_num_rows($resultado) == 1) {
                $row = mysqli_fetch_array($resultado);
                $id_guia = $row['id_guia'];


                
                
                $peso_real = $row['peso_real'];


                $fecha = $row['fecha_emb'];
                $valor = $row['valor_mercancia'];
                $tipo_bulto = $row['tipo_bulto'];
                $num_bulto = $row['cantidad_bulto'];
                $empaquetado = $row['empaquetado'];
                $peso_volumetrico = $row['peso_volumetrico'];
                $icontem = $row['incotem'];
                $destinatario = $row['personasDest_id'];
                $remitente = $row['personasEnv_id'];
                $valor= $row['valor_mercancia'];
                $descripcion = $row['descripcion'];
            }

        ?>


          
            <table class="collapse">
            <thead class="membretes">
                <tr > 
                    <th>HAWB</th>
                    <th>ORIGIN</th>
                    <th>/DEST</th>
                    <th>SHIPPER</th>
                    <th>CONSIGNEE</th>
                    <th>DELIVERTY TERMS</th>
                    <th>PCS</th>
                    <th>WEIGHT KG</th>
                    <th>VALUE</th>
                    <th>DESCRIPCION</th>
        </u>
                </tr>  
            </thead>     
            <tbody class="letraDetalles "> 
                <tr class="collapse">
                    <th class="collapse izq"><p> <?php 
                                    $barHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
                                    $length = 5;
                                    $string = substr(str_repeat(0, $length).$id_guia, - $length);
                                    $codigoBarra= $codPais . $string;
                                    echo $barHTML->getBarcode($codigoBarra, $barHTML::TYPE_CODE_128);
                                     echo $codigoBarra;
                    ?> </p></th>
                    <th class="collapse origen"><p> <?php echo $codPais;?> </p></th>
                    <th class="collapse origen"><p> <?php echo $codPais_dest;?> </p></th>
                    <th class="collapse izq interlineado_nombre"><p> <?php 
                    
                    $queryEnvia = "SELECT * FROM personas WHERE id_persona =$remitente";
                    $resultadoEnv = mysqli_query($conexion, $queryEnvia);
                    while ($rowEnv = $resultadoEnv->fetch_assoc()) {?>
                        <?php echo $rowEnv['nombre'] . ' ' . $rowEnv['apellidos']; ?><br>
                        <?php echo $rowEnv['direccion'] . '<br>' . $rowEnv['pais'] . ' ' . $rowEnv['departamento']; ?><br>
                        <?php echo $rowEnv['tel']; ?></p>
                        <?php
                    }?>

                    
                     </p></th>

                    <th  class="collapse interlineado_nombre"> 

                
                    
    
                    <?php

                    $queryDest = "SELECT * FROM personas  WHERE id_persona =$destinatario";
                    $resultadoDest = mysqli_query($conexion, $queryDest);
                    while ($rowDest = $resultadoDest->fetch_assoc()) {?>
                        <?php echo $rowDest['nombre'] . ' ' . $rowDest['apellidos']; ?><br>
                        <?php echo $rowDest['direccion'] . '<br>' . $rowDest['pais'] . ' ' . $rowDest['departamento']; ?><br>
                        <?php echo $rowDest['tel']; ?></p>
                    <?php
                    }?>


                    </th>
                    <th class="collapse"><p> <?php echo "DDU (Prepaid)";?> </p></th>
                    <th class="collapse"><p> <?php echo $num_bulto;?> </p></th>
                    <th class="collapse"><p> <?php echo $peso_volumetrico;?> </p></th>
                    <th class="collapse"><p> <?php echo $valor;?> </p></th>
                    <th class="collapse"><p> <?php echo $descripcion;?> </p></th>

                </tr>  


        
            </tbody>    
        </table > 

    <?php } ?>
       
    </div>
</div>

<br>
<br>

<!--div id="footer">
    <p class="page">Page </p>
  </div> -->

<script>



    

</body>
</html>
