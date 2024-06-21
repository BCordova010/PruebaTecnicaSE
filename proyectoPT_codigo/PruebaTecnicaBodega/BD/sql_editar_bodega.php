<?php

    include_once 'funcionesBD.php';

    $post_bod_id = $_POST['postbodid'];
    $post_cod_bod = $_POST['postcodbod'];
    $post_nombre_bod = $_POST['postnombrebod'];
    $post_direccion_bod = $_POST['postdireccionbod'];
    $post_dotacion_bod = $_POST['postdotacionbod'];
    $post_estado_bod = $_POST['postestadobod'];
    $post_validador_bod = $_POST['postvalidadorbod'];

    $split_validador_bod = explode(",", $post_validador_bod);
    $func_validador_id = "";
    $indicador2 = 0;

    //Se crea String a base del Array booleano
    for ($i=0; $i < count($split_validador_bod); $i++) { 
        
        if ($split_validador_bod[$i] == "true") {
            
            $func_validador_id .= ($i+1).",";

        }

    }

    //se borra última coma
    $func_validador_id = substr($func_validador_id, 0 , -1);

    //UPDATE en tabla bodega
    $actualizar_bodega = pg_query($conexion, "UPDATE bodega
	    SET estado_bodega=$post_estado_bod,codigo_bodega='$post_cod_bod',direccion_bodega='$post_direccion_bod',nombre_bodega='$post_nombre_bod',dotacion_bodega=$post_dotacion_bod
	    WHERE bodega_id=$post_bod_id;");

    //validador de tabla
    if (!$actualizar_bodega) {
        echo "ERROR AL ACTUALIZAR BODEGA";
        exit();
    }

    //eliminar registro de asociación
    $eliminar_registro_bod_func = pg_query($conexion, "DELETE FROM bodega_funcionario WHERE bf_bodega_id=$post_bod_id;");

    if (!$eliminar_registro_bod_func) {
        echo "ERROR AL REMOVER EL REGISTRO DE ASOCIACIÓN";
        exit();
    }

    $func_validador_id = explode(",", $func_validador_id);

    //INSERT en la relación funcionario/bodega
    for ($i=0; $i < count($func_validador_id); $i++) { 
        $nueva_relacion_bodega = pg_query($conexion, "INSERT INTO bodega_funcionario VALUES(DEFAULT, $post_bod_id, ".$func_validador_id[$i].");");
    }

    //validador de tabla
    if (!$nueva_relacion_bodega) {
        echo "ERROR AL INGRESAR RELACIÓN DE BODEGA";
        exit();
    }

    //se envía 1 para confirmar la creación
    echo "1";

    


?>