<!-- Podemos usar la interfaz PDO (PHP Data Objects) o podemos usar MySQLi. La diferencia consiste en que con PDO nos podemos conectar a más bases de datos que no necesariamente han de ser MySQL, siendo más versátil que MySQLi, que solamente funcionará con bases de datos MySQL. Además, PDO es más extensible y abierto de cara al futuro, haciendo que las aplicaciones sean más fáciles de mantener. -->
<!-- CONECTAMOS A LA BASE DE DATOS-->

<?php

return [
    'db' => [
        'host' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'tutorial_crud',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    ]
];