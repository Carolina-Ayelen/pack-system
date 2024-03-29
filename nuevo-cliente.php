<?php
include "session.php";
include "conexion.php";
include_once "includes/header.php";
include_once "includes/sidebar.php";
include_once "includes/footer.php";

if(isset($_GET['regreso'])){
    $regreso = $_GET['regreso'];
    }
    else {
    $regreso ="clientes";
    }
?>


<br>
    <h2>Nuevo Cliente</h2>
    <div class="container">
        <form class="form-horizontal" method="POST" action="guardar-cliente.php" autocomplete="off">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 div-nuevo">
                        <label>Documento</label>
                        <input type="text" name="dni" id="dni" class='form-control' maxlength="20" required ></input>
                    </div>
                    <div class="col-md-4 div-nuevo">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class='form-control' maxlength="25" required ></input>
                    </div>
                    <div class="col-md-4 div-nuevo">
                        <label>Apellido</label>
                        <input type="text" name="apellidos" id="apellidos" class='form-control' maxlength="25" required ></input>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 div-nuevo">
                        <label for="direccion" class="col-sm-2 control-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                    <div class="col-md-4 div-nuevo">
                        <label for="pais" class="col-sm-2 control-label">País</label>
                        <select name="pais" class="form-select" aria-label="Default select example" require>
                            <option value="0">Seleccione:</option>
                            <?php
                                $query = "SELECT * FROM cod_pais";
                                $result = mysqli_query($conexion, $query);
                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<option value="' . $row[id_pais] . '">' . $row[descripcion] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-4 div-nuevo">
                        <label for="departamento" class="col-sm-2 control-label">Departamento</label>
                        <input type="text" class="form-control" id="departamento" name="departamento" >
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 div-nuevo">
                        <label for="cod_postal" class="col-sm-8 control-label">Cód Postal</label>
                        <input type="text" class="form-control" id="cod_postal" name="cod_postal" required                                                                                                                                                                                                                                                              >
                    </div>
                    <div class="col-md-4 div-nuevo">
                        <label for="telefono" class="col-sm-2 control-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="tel" required >
                    </div>
                    <div class="col-md-4 div-nuevo">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <input type="email" class="form-control" id="correo" name="correo">
                        <input  type= "hidden" class="form-control" id="regreso" name="regreso" value=<?php echo $regreso;?> >
                    </div>
                </div>
            </div>
            <br>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button"  class="btn btn-dark boton-secundario"> <?php  if ($regreso=="remitente") {?> <a href="multi_embarque.php" ><?php } else  {?> <a href="gestion.php" ><?php }?>  Regresar</a>  </button>
                    <button type="submit" name= "guardar_cliente" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</main>
