<?php

    include_once 'funcionesBD.php';

    $post_id_eliminar = (int)$_POST['ideliminar'];

    //eliminar registro de asociación
    $eliminar_registro_bod_func = pg_query($conexion, "DELETE FROM bodega_funcionario WHERE bf_bodega_id=$post_id_eliminar;");

    if (!$eliminar_registro_bod_func) {
        echo "ERROR AL REMOVER EL REGISTRO DE ASOCIACIÓN";
        exit();
    }

    //DELETE en tabla bodega
    $eliminar_bodega = pg_query($conexion, "DELETE FROM public.bodega WHERE bodega_id=$post_id_eliminar;");

    //validador de tabla
    if (!$eliminar_bodega) {
        echo "ERROR AL ELIMINAR BODEGA";
        exit();
    }

    //se envía 1 para confirmar la creación
    echo "1";

?>