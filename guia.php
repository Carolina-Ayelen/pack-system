<script type="text/javascript">
function AlertIt(id) {
/*var answer = confirm ("Please click on OK to continue.")
if (answer)*/

let guiaAWB=prompt('Introduzca el número de guía:')   
console.log (id)             
window.location='reportes/pdfENA.php?id='+id+"&" + "guiaAWB=" + guiaAWB

}
</script>

<?php
include "session.php";
include "conexion.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/footer.php";

//buscador
$where = "";

if (isset($_POST["enviar-nombre"])) {
$valor = $_POST['campo'];
if (!empty($valor)) {
$where = "WHERE personasEnv_id LIKE '%$valor%' OR id_guia LIKE '%$valor%' OR personasDest_id LIKE '%$valor%'";
}
}
 
?>
<!--Mostrar msj si existe $_SESSION['message']-->
<?php if (isset($_SESSION['message'])) {?>
        <div class="alert alert-<?=$_SESSION['message-type'];?> alert-dismissible fade show" role="alert">
            <?=$_SESSION['message'];?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
<?php unset($_SESSION['message']);}?>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <div class="col-md-6">
    <h2>Guías de embarque</h2>
  </div>
  <div class="col-md-6">
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="input-group">
        <div class="form-outline">
          <input type="search" id="form1" class="form-control-dos" name="campo" />
        </div>
        <button type="submit" class="btn btn-primary" name="enviar-nombre" value="Buscar">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </form>
  </div>
</div>

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Número de guía</th>
          <th scope="col">Remitente</th>
          <th scope="col">Destinatario</th>
          <th scope="col">Destino</th>
          <th scope="col">Fecha Embarque</th>
          <th scope="col">Volumen</th>
          <th scope="col">Empaquetado</th>
          <th scope="col">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php

$query = "SELECT * FROM guia_embarque $where" ;
$result = mysqli_query($conexion, $query);

//recorrer tabla
while ($row = mysqli_fetch_array($result)) {?>
          <tr>
              <td><?php 
              $length = 5;
              $guia = substr(str_repeat(0, $length).$row['id_guia'], - $length);
              echo $guia; ?></td>
              <?php 
              $envia=$row['personasEnv_id'];
              $queryEnvia = "SELECT * FROM personas WHERE id_persona =$envia";
              $resultadoEnv = mysqli_query($conexion, $queryEnvia);
              while($rowEnv = $resultadoEnv->fetch_assoc())
              { ?>
                 <td><?php echo $rowEnv['nombre'].' '.$rowEnv['apellidos']; ?></td>
             <?php 
             }

              $destinatario=$row['personasDest_id'];
              $queryDest = "SELECT * FROM personas  WHERE id_persona =$destinatario";
              $resultadoDest = mysqli_query($conexion, $queryDest);
              while($rowDest = $resultadoDest->fetch_assoc())
              { ?>
                <td><?php echo $rowDest['nombre'].' '.$rowDest['apellidos']; ?></td>
             <?php 
             }

              $origen=$row['cod_destino'];
              $queryOrigen = "SELECT * FROM cod_pais WHERE id_pais=$origen";
              $resultadoOrigen = mysqli_query($conexion, $queryOrigen);
              while($rowOrigen = $resultadoOrigen->fetch_assoc())
              { ?>
                <td><?php echo $rowOrigen['codigo']; ?></td>  
             <?php }
              ?>
              <td><?php echo $row['fecha_emb']; ?></td>
              <td><?php echo $row['peso_volumetrico']; ?></td>
              <td><?php echo $row['empaquetado']; ?></td>
              <td><a class="btn btn-secondary" data-toggle="popover" title="Editar" href="editar-guia.php?id=<?php echo $row['id_guia']; ?>"><i class="bi bi-pencil-fill"></i></a>
                  <a class="btn btn-danger" data-toggle="popover" title="Eliminar" onclick="return  confirm('¿Desea eliminar el registro?')"href="eliminar-guia.php?id=<?php echo $row['id_guia']; ?>"><i class="bi bi-trash-fill" ></i></a>
                  <?php 
                  if ($row['tipo_bulto']=='ENA') {?>
                    <a class="btn btn-secondary" data-toggle="popover" title="Imprimir PDF y/o Factura" href="javascript:AlertIt(<?php echo $row['id_guia'];?>);"><i class="bi bi-printer-fill"></i></a>

                  <?php 

                  } else 
                  {?>
                    <a class="btn btn-secondary" data-toggle="popover" title="Imprimir PDF y/o Factura" href="reportes/pdf-guia.php?id=<?php echo $row['id_guia']; ?>"><i class="bi bi-printer-fill"></i></a>
                    <?php 
                  }?>
                  <a class="btn btn-secondary" data-toggle="popover" title="Declaración jurada" href="nueva-declaracion.php?id=<?php echo $row['id_guia']; ?>"><i class="bi bi-clipboard-check"></i></a>
                  <a class="btn btn-secondary" data-toggle="popover" title="Factura" href="guardar_factura.php?id=<?php echo $row['id_guia']; ?>"><i class="bi bi-clipboard-check"></i></a>

                </td>
          </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
</main>
</div>
</div>
<script 
     alert("hola");
     
     src="js/main.js">
    </script>