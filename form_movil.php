<?php include 'php/cabecera.inc' ?>
    <main>
        <div class="container">
            <h2 class="my-2">Añadir nuevo móvil</h2>
            <?php 
            if(isset($_GET['modificar'])){
                $modificar = $_GET['modificar'];
                echo '<form action="actualizar_movil.php?actualizar='. $modificar . '" method="post" class="mt-4" id="newEvent" name="newEvent"> ';
                
                include 'php/conectarBD.inc';

                $consulta = $pdo->prepare("SELECT nombre, descripcion, imagen, precio, fecha FROM moviles WHERE id = :id");
                $consulta->bindParam(':id', $_GET['modificar']);
                $consulta->execute();
                $registro  = $consulta->fetch();
                $nombre = $registro['nombre'];
                $descripcion = $registro['descripcion'];
                $precio = $registro['precio'];
                $fecha = $registro['fecha'];

                $consulta = NULL;
                $pdo = NULL;
            } else{
                echo '<form action="insertar_movil.php" method="post" class="mt-4" id="newEvent" name="newEvent"> ';
            }
            ?>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Marca y modelo del móvil</label>

                    <?php 
                        if(isset($_GET['modificar'])){
                            echo '<input type="text" class="form-control" name="nombre" id="nombre" value=" ' . $nombre . '">';
                        } else{
                            echo '<input type="text" class="form-control" name="nombre" id="nombre" placeholder="Introduce la marca y modelo del móvil">';
                        }
                    ?>
                    
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>

                    <?php 
                        if(isset($_GET['modificar'])){
                            echo '<textarea class="form-control" id="descripcion" name="descripcion" rows="3">' . $descripcion . '</textarea>';
                        } else{
                            echo '<textarea class="form-control" id="descripcion" name="descripcion" rows="3"></textarea>';
                        }
                    ?>
                </div> 
                <div class="mb-3">
                    <label for="precio" class="form-label">Precio (en €)</label>
                    <?php 
                        if(isset($_GET['modificar'])){
                            echo '<input type="number" class="form-control" value="'. $precio .'" id="precio" name="precio" step="0.01" />';
                        } else{
                            echo '<input type="number" class="form-control" id="precio" name="precio" step="0.01" />';
                        }
                    ?>
                    <div class="invalid-feedback">El precio debe ser un número positivo.</div>
                </div>
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha de lanzamiento</label>
                    <?php 
                        if(isset($_GET['modificar'])){
                            echo '<input type="date" class="form-control" id="fecha" name="fecha" value="'. $fecha .'">';
                        } else{
                            echo '<input type="date" class="form-control" id="fecha" name="fecha">';
                        }
                    ?>
                    <div class="invalid-feedback">El campo fecha de lanzamiento es obligatorio (Mayor a fecha actual).</div>
                </div>
                <div class="mb-3">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                    <div class="invalid-feedback">Debes introducir una imagen.</div>
                </div>
                <img src="" alt="" id="imgPreview" class="img-thumbnail mb-3 d-none">
                <div>
                    <?php 
                        if(isset($_GET['modificar'])){
                            echo '<button type="submit" class="btn btn-danger">Modificar</button>';
                        } else{
                            echo '<button type="submit" class="btn btn-primary">Añadir</button>';
                        }
                    ?>
                </div>
            </form>
        </div>
    </main>
<?php include 'php/pie.inc' ?>