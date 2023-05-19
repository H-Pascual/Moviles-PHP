<?php include 'php/cabecera.inc' ?>
<?php   
        if(!empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['precio']) &&
        !empty($_POST['fecha']) && !empty($_POST['imagen'])){
            include 'php/conectarBD.inc';

            $insercion = $pdo->prepare("INSERT INTO moviles(nombre, descripcion, imagen, precio, fecha)" .
                " VALUES(:nombre, :descripcion, :imagen, :precio, :fecha)");
            $insercion->bindParam(':nombre', $_POST['nombre']);
            $insercion->bindParam(':descripcion', $_POST['descripcion']);
            $insercion->bindParam(':imagen', $_POST['imagen']);
            $insercion->bindParam(':precio', $_POST['precio']);
            $insercion->bindParam(':fecha', $_POST['fecha']);
           if ($insercion->execute()){
                header('Location:index.php');
            } else{
                header('Location:error.php');
            }
        } else{
            header('Location:error.php');
        }

        $insercion = NULL;
        $pdo = NULL;
?>
<?php include 'php/pie.inc' ?>