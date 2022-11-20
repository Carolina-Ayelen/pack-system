

<?php
include "session.php";
include "conexion.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/footer.php";

//buscador
$where = "";

if (isset($_POST["enviar-pais"])) {
  $cod_origen = $_POST['cod_origen'];
  $cod_destino = $_POST['cod_destino'];
  $tipo= $_POST['tipo'];
  if (!empty($cod_origen) and !empty($cod_destino) and (!empty($tipo)) ) { // es OBLIGARORIO que selecciones un origen Y destino
    
    // $where = "WHERE cod_origen LIKE '%$cod_origen%' and cod_destino LIKE '%$cod_destino%' and estado_id='1' GROUP BY electronico";
    $where = "WHERE (cod_origen ='$cod_origen' and cod_destino ='$cod_destino' and estado_id=1 and electronico='$tipo')   ORDER BY electronico";
    
  }
  /*if (!empty($cod_origen) and empty($cod_destino)) {
      $where = "WHERE cod_origen LIKE '%$cod_origen%'";
      }
  if (empty($cod_origen) and !empty($cod_destino)) {
      $where = "WHERE cod_destino LIKE '%$cod_destino%'";
      }   */ 
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
  <div class="col-md-4">
    <h3>Selección de Guías</h3>
  </div>

  <div class="col-md-8">
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="input-group">
        <div class="form-outline">
                <label>País de Origen</label> 
                <select id="cod_origen" name="cod_origen" class="form-select" aria-label="Default select example">
                    <option value="0">Seleccione:</option>
                    <?php
                    $query = "SELECT * FROM cod_pais";
                    $result = mysqli_query($conexion, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_pais'] . '">' . $row['codigo'] . '</option>';
                    }
                    ?>
                </select>
        </div>
        <div class="form-outline">
                <label>País de Destino</label> 
                <select id="cod_destino" name="cod_destino" class="form-select" aria-label="Default select example">
                    <option value="0">Seleccione:</option>
                    <?php
                    $query = "SELECT * FROM cod_pais";
                    $result = mysqli_query($conexion, $query);
                    while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['id_pais'] . '">' . $row['codigo'] . '</option>';
                    }
                    ?>
                </select>
        </div>
        
        <div class="form-outline">
        <br>
        <label>Electrónico</label> 
          <input  type="radio" id= "tipo" name="tipo"  value="SI" <?php echo 'checked';?>> SI</input>
          <input type="radio" id= "tipo" name="tipo"  value="NO"> NO  </input>
        </div>
 
        <button type="submit" class="btn btn-primary" name="enviar-pais" value="Buscar">
          <i class="bi bi-search"></i>
        </button>
      </div>
    </form>
</div>


</div>

<?php 
if (!empty($cod_origen) and !empty($cod_destino)) { ?>

<form action="guardar_manifiesto.php" method="post">

  <div class="table-responsive">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Número de guía</th>
          <th scope="col">Remitente</th>
          <th scope="col">Destinatario</th>
          <th scope="col">Destino</th>
          <th scope="col">Fecha Embarque</th>
          <th scope="col">Piezas</th>
          <th scope="col">Peso</th>
          <th scope="col">Electrónicos</th>

        </tr>
      </thead>
      <tbody>
        <?php

        $query = "SELECT * FROM guia_embarque $where";
        $result = mysqli_query($conexion, $query);

        //recorrer tabla
        while ($row = mysqli_fetch_array($result)) {
          $datos='si';?>
          <tr>
              <td><?php 
              $length = 5;
              $guia = substr(str_repeat(0, $length).$row['id_guia'], - $length);?>
              <input type="checkbox" name="guia[]" value=<?php echo $guia;?>><?php echo $guia;?></input>
              </td>

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
              <td><?php echo $row['cantidad_bulto']; ?></td>
              <td><?php echo $row['peso_real']; ?></td>
              <td><?php echo $row['electronico']; ?></td>

          </tr>
        <?php }?>
      </tbody>
    </table>
  </div> 
    <!-- Datos complementarios del manifiesto-->
    <?php if (!empty($datos)) {?>
      <div class="form-group">
        <div class="row">
          <div class="col-md-4 div-nuevo">
              <label>FLIGHT</label>
              <input type="text" name="vuelo" id="vuelo" class='form-control' maxlength="20" required ></input>
          </div>
          <div class="col-md-4 div-nuevo">
              <label>SHIPPER</label>
              <select class="form-select" aria-label="Default select example" id="expedidor" name="expedidor">
                <option selected>Seleccione:</option>
                <option value="FERIBAN S.A. Aeropuerto Int´l. de Carrasco TCU of 116 Montevideo - Uruguay">Ferriban</option>
                <option value="DOX">otro</option>
                <option value="ENA">otro</option>
                </select>
         
            </div>
          <div class="col-md-4 div-nuevo">
              <label>CONSIGNEE</label>
              <input type="text" name="consignatario" id="consignatario" class='form-control' maxlength="500" required ></input>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 div-nuevo">
             
              <input type="hidden" name="cod_origen" id="cod_origen" class='form-control' maxlength="20" value=<?php echo $cod_origen;?> ></input>
          </div>
          <div class="col-md-4 div-nuevo">
              
              <input type="hidden" name="cod_destino" id="cod_destino" class='form-control' maxlength="25" value=<?php echo $cod_destino;?> ></input>
          </div>
        </div>
      </div>
      <input type="submit" class="btn btn-primary" name="manifiesto" value="Generar manifiesto"/>
    <?php } ?>
  </div>
</form>
<?php } ?>


</main>
</div>
</div>
<script 
     
     
     src="js/main.js">
    </script>