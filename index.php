<?php include 'php/cabecera.inc' ?>
    <main>
        <div class="container">
            <nav class="navbar navbar-light bg-light justify-content-between mt-3">
                <div class="container-fluid">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="orderDate">Filtrar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="orderPrice">Ordenar por precio</a>
                        </li>
                    </ul>
                    <form class="d-flex mb-0" id="filtarMovil" name="filtarMovil">
                        <input class="form-control me-2" type="text" name="search" id="search" placeholder="Buscar" aria-label="Search">
                    </form>
                </div>
            </nav>
        </div>
        <div class="container">
            <article id="eventsContainer" class="mb-4 mt-4 row row-cols-1 row-cols-md-2 row-cols-xl-3 g-4">
                <?php 
                     include 'php/conectarBD.inc';

                    if (isset($_GET['borrar'])) {
                        $movilBorrar = $_GET['borrar'];
                        $consulta = $pdo -> prepare("DELETE FROM moviles WHERE id = $movilBorrar");
                        $consulta->execute();
                    }

                    $consulta = $pdo->prepare("SELECT * FROM moviles");
                    $consulta->execute();
                    while($registro  = $consulta->fetch())
                    {
                        $id = $registro['id'];
                        $nombre = $registro['nombre'];
                        $descripcion = $registro['descripcion'];
                        $imagen = $registro['imagen'];
                        $precio = $registro['precio'];
                        $fecha = $registro['fecha'];
                        PintarMoviles($id, $nombre, $descripcion, $imagen, $precio, $fecha);
                    }
                    
                    function PintarMoviles($id, $nombre, $descripcion, $imagen, $precio, $fecha){
                            echo'<div class="col">
                                    <div class="card shadow">
                                        <img src="imgs/' . $imagen . '" class="card-img-top" alt="Marca y modelo del móvil">
                                        <div class="card-body">
                                            <h4 class="card-title">' . $nombre . '</h4>
                                            <p class="card-text">
                                                ' . $descripcion . '
                                            </p>
                                            <a href="form_movil.php?modificar= ' . $id . '" class="btn btn-primary">Modificar</a>
                                            <a href="index.php?borrar= ' . $id . '" class="btn btn-danger">Delete</a>
                                        </div>
                                        <div class="card-footer text-muted row m-0">
                                            <div class="col text-end">Desde '. $precio . '€</div>
                                            <div class="col">'. $fecha . '</div>
                                        </div>
                                    </div>
                                </div>';

                    }

                    $consulta = NULL;
                    $pdo = NULL;
                ?>
            </article>
        </div>
    </main>
<?php include 'php/pie.inc' ?>