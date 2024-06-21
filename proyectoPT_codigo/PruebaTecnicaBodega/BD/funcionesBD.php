<?php

    //crear conexión
    $conexion = pg_connect("
        host=localhost
        port=5432
        dbname=bodega
        user=postgres
        password=root"
    );

    //verificar conexión
    if (!$conexion) {
        echo "conexión no encontrada";
        exit;
    }

?>