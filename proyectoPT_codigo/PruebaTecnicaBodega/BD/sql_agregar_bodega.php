<?php

    include_once 'funcionesBD.php';

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

    //INSERT en tabla bodega
    $nueva_bodega = pg_query($conexion, "INSERT INTO bodega VALUES(DEFAULT, '$post_cod_bod', '$post_nombre_bod', '$post_direccion_bod', $post_dotacion_bod, $post_estado_bod, DEFAULT) RETURNING bodega_id;");

    //validador de tabla
    if (!$nueva_bodega) {
        echo "ERROR AL INGRESAR BODEGA";
        exit();
    }

    $nueva_bodega = pg_fetch_row($nueva_bodega);

    $func_validador_id = explode(",", $func_validador_id);

    //INSERT en la relación funcionario/bodega
    for ($i=0; $i < count($func_validador_id); $i++) { 
        $nueva_relacion_bodega = pg_query($conexion, "INSERT INTO bodega_funcionario VALUES(DEFAULT, ".$nueva_bodega[0].", ".$func_validador_id[$i].");");
    }

    //validador de tabla
    if (!$nueva_relacion_bodega) {
        echo "ERROR AL INGRESAR RELACIÓN DE BODEGA";
        exit();
    }

    //se envía 1 para confirmar la creación
    echo "1";

    


?>