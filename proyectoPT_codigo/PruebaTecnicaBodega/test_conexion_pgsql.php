<?php

    $conexion = pg_connect("
        host=localhost
        port=5432
        dbname=bodega
        user=postgres
        password=root"
    );

    // if ($conexion) {
    //     echo "conexión encontrada";
    //     exit;
    // } else {
    //     echo "conexión no encontrada";
    //     exit;
    // }

    $resultado_q = pg_query($conexion, "SELECT * FROM tablaprueba");

    if ($resultado_q) {
        $data_q = pg_fetch_row($resultado_q);

        var_dump($data_q);
    } else {
        echo "error al buscar resultados";
    }

?>