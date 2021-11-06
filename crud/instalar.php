<?php

$config = include 'config.php';
try {
    /* DNS 'mysql:host=' */
    $conexion = new PDO('mysql:host=' . $config['db']['host'], $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    /* Asignamos la consulta a una variable */
    $sql = file_get_contents('data/migracion.sql');
    /* ejecutamos la consulta */
    $conexion->exec($sql);

    echo 'La base de datos y la tabla de alumnos se han creado con exito';
} catch (PDOException $error) {
    echo $error->getMessage();
}