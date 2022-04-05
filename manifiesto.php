<script type="text/javascript">
function AlertIt(id_manifiesto) {
/*var answer = confirm ("Please click on OK to continue.")
if (answer)*/

let guiaAWB=prompt('Introduzca el número de manifiesto:')   
console.log (id_manifiesto)             
//  FATA POR DISEÑAR window.location='reportes/pdfENA_manifiesto.php?id_manifiesto='+id_manifiesto+"&" + "guiaAWB=" + guiaAWB
window.location ='editar-numero-manifiesto.php?id_manifiesto='+id_manifiesto+"&" + "guiaAWB=" + guiaAWB
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
$where = "AND id_manifiesto LIKE '%$valor%'";
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
    <h2>Guías de manifiesto</h2>
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
          <th scope="col">Número externo</th>
          <!--<th scope="col">Destinatario</th>-->
          <th scope="col">Destino</th>
          <th scope="col">Fecha Embarque</th>
          <!--<th scope="col">Volumen</th>-->
          <th scope="col">vuelo</th>
          <th scope="col">Electrónico</th>
        </tr>
      </thead>
      <tbody>
        <?php

$query = "SELECT * FROM manifiesto where estado_id= 1 $where" ;
$result = mysqli_query($conexion, $query);

//recorrer tabla
while ($row = mysqli_fetch_array($result)) {?>
          <tr>
              <td><?php 
              $length = 5;
              $guia = substr(str_repeat(0, $length).$row['id_manifiesto'], - $length);
              echo $guia; ?></td>

              <td><?php echo $row['numero']; ?></td>
              <?php 

              $origen=$row['cod_destino'];
              $queryOrigen = "SELECT * FROM cod_pais WHERE id_pais=$origen";
              $resultadoOrigen = mysqli_query($conexion, $queryOrigen);
              while($rowOrigen = $resultadoOrigen->fetch_assoc())
              { ?>
                <td><?php echo $rowOrigen['codigo']; ?></td>  
             <?php }
              ?>
              <td><?php echo $row['fecha']; ?></td>
              <td><?php echo $row['vuelo']; ?></td>
              <td><?php echo $row['electronico']; ?></td>
              <td><a class="btn btn-secondary" data-toggle="popover" title="Editar" href="editar-manifiesto.php?id_manifiesto=<?php echo $row['id_manifiesto']; ?>"><i class="bi bi-pencil-fill"></i></a>
                  <a class="btn btn-danger" data-toggle="popover" title="Eliminar" onclick="return  confirm('¿Desea eliminar el registro?')"href="eliminar-manifiesto.php?id_manifiesto=<?php echo $row['id_manifiesto']; ?>"><i class="bi bi-trash-fill" ></i></a>
                  <a class="btn btn-secondary" data-toggle="popover" title="Imprimir PDF y/o Factura" href="javascript:AlertIt(<?php echo $row['id_manifiesto'];?>);"><i class="bi bi-printer-fill"></i></a>
                  <a class="btn btn-secondary" data-toggle="popover" title="Cerrar" href="cerrar-manifiesto.php?id_manifiesto=<?php echo $row['id_manifiesto']; ?>"><i class="bi bi-pencil-fill"></i></a>
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