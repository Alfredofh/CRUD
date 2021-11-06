<?php include 'funciones.php'; ?>
<?php
/* Creamos el usuario */
if (isset($_POST['submit'])) {
    /* $resultado almacena errores (de haberlos) */
    $resultado = [
        'error' => false,
        'mensaje' => 'El alumno ' . escapar($_POST['nombre']) . ' ha sido creado con éxito'
    ];
    /* Conectamos a la base de datos */
    $config = include 'config.php';
    /*Insertamos el usuario y gestionamos errores*/
    try {
        $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
        $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        /*Insertamos alumno  */
        $alumno = [
            "nombre" => $_POST['nombre'],
            "apellido" => $_POST['apellido'],
            "email" => $_POST['email'],
            "edad" => $_POST['edad'],
        ];
        $consultaSQL = "INSERT INTO alumnos (nombre, apellido, email, edad) values (:" . implode(", :", array_keys($alumno)) . ")";

        /* preparamos y ejecutamos la consulta */
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute($alumno);
        /* errores */
    } catch (PDOException $error) {
        $resultado['error'] = true;
        $resultado['mensaje'] = $error->getMessage();
    }
}

?>
<?php include "templates/header.php"; ?>
<?php
/* Mostrar errores en HTML */
if (isset($resultado)) {
?>
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-<?= $resultado['error'] ? 'danger' : 'success' ?>" role="alert">
                <?= $resultado['mensaje'] ?>
            </div>
        </div>
    </div>
</div>
<?php
}
?>
<!-- HTML -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="crear.php" class="btn btn-primary mt-4">Crear Alumno</a>
            <hr>
            <form method="post">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="edad">Edad</label>
                    <input type="text" name="edad" id="edad" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-primary" href="index.php">Regresar al inicio</a>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include "templates/footer.php"; ?>