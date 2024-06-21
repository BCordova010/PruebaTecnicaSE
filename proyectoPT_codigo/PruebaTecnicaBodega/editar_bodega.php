<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Bodega</title>
    <style>

        body {
            background-color: burlywood;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        #tituloAgregaBodega{
            text-align: center; 
            margin-top: 100px;
        }

        form{
            width:400px;
            padding:40px;
            border-radius:10px;
            margin:auto;
            background-color: gainsboro;
        }

    </style>
    
</head>
<body>

    <?php 

        include_once 'BD/funcionesBD.php';

        //rescatar valor en URL
        // --------------------------------------
        if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'){
            $url = "https://";   
        }else{  
            $url = "http://";   
        }
        
        $url.= $_SERVER['HTTP_HOST'];   
        
        $url.= $_SERVER['REQUEST_URI'];    
      
        $url_components = parse_url($url);

        parse_str($url_components['query'], $params);
        // -------------------------------------

        $bodega_verifica = (int)$params['verificar'];

        if (is_int($bodega_verifica) == false) {
            echo "ERROR - VARIABLE NO VÁLIDA";
            die();
        }

        $r_bodega = pg_query($conexion, "SELECT * FROM bodega WHERE bodega_id = $bodega_verifica;");

        if (!$r_bodega) {
            echo "no se encontraron registros en la bodega";
            die();
        }

        $r_bod_func = pg_query($conexion, "SELECT * FROM bodega_funcionario WHERE bf_bodega_id = $bodega_verifica");

        if (!$r_bod_func) {
            echo "no se encontraron asociaciones";
            die();
        }

        $r_funcionarios = pg_query($conexion, "SELECT * FROM funcionario;");

        if (!$r_funcionarios) {
            echo "no se encontraron registros en los funcionarios";
            die();
        }

        //se crean variables lógicas
        $array_bodega = pg_fetch_all($r_bodega);
        $array_bod_func = pg_fetch_all($r_bod_func);
        $array_funcionarios = pg_fetch_all($r_funcionarios);
        $total_array_bodega = count($array_bodega);
        $total_array_bod_func = count($array_bod_func);
        $total_array_funcionarios = count($array_funcionarios);
        $observador_bod_func = 0;
        $verificador_funcionario = "f";
    ?>

    <h1 id="tituloAgregaBodega">FORMULARIO EDITAR BODEGA</h1>
    
    <form id="formEditar" name="formEditar">
        <label for="codigoBodega_edit">Código:</label>
        <input type="text" id="codigoBodega_edit" name="codigoBodega_edit" maxlength="5" value="<?php echo $array_bodega[0]['codigo_bodega'] ?>" required><br><br>
        <input type="hidden" id="bodega_og" name="bodega_og" value="<?php echo $bodega_verifica ?>"

        <label for="nombreBodega_edit">Nombre:</label>
        <input type="text" id="nombreBodega_edit" name="nombreBodega_edit" value="<?php echo $array_bodega[0]['nombre_bodega'] ?>" onkeydown="SoloAlfanumericos(event)" maxlength="100" required><br><br>

        <label for="direccionBodega_edit">Dirección:</label>
        <input type="text" id="direccionBodega_edit" name="direccionBodega_edit" value="<?php echo $array_bodega[0]['direccion_bodega'] ?>" required><br><br>

        <label for="dotacionBodega_edit">Dotación:</label>
        <input type="text" id="dotacionBodega_edit" name="dotacionBodega_edit" value="<?php echo $array_bodega[0]['dotacion_bodega'] ?>" onkeydown="SoloNumeros(event)" required><br><br>
        
        <label for="estadoBodega_edit">Activada:</label>
        <input type="checkbox" id="estadoBodega_edit" name="estadoBodega_edit" <?php if ($array_bodega[0]['estado_bodega'] == "t") { ?>checked="true" <?php } ?>><br><br>

        <!-- Se monitorea la cantidad de funcionarios asignados a la Bodega -->
        <label for="encargadoBodega_edit">Encargado:</label>
        <?php for ($i=0; $i < count($array_funcionarios); $i++) { 
            $k = $i + 1;
            if ($observador_bod_func < $total_array_bod_func && $array_bod_func[$observador_bod_func]['bf_if_funcionario'] == $k) {
                $verificador_funcionario = "t";
            }
            ?>
            <input type="checkbox" id="encargadoBodega_edit_<?php echo $array_funcionarios[$i]['funcionario_id'] ?>" name="encargadoBodega_edit_<?php echo $i ?>" <?php if ($verificador_funcionario == "t") { ?>checked="true" <?php $verificador_funcionario = "f"; $observador_bod_func++;}?>> <?php echo $array_funcionarios[$i]['nombre_funcionario'] ?>
        <?php } ?>
        <br><br>

        <input type="button" value="Guardar" onclick="verificarFormularioBodega()"><br><br>
        <input type="button" value="Volver" onclick="volverPaginaAnterior()">
    </from>

    <script>
        //verificador para solo ingresar números en un campo
        function SoloNumeros(event) {
            // Obtener el valor del evento
            var keyCode = event.keyCode ? event.keyCode : event.which;
            
            if ((keyCode >= 48 && keyCode <= 57) || // Números del 0 al 9
                (keyCode >= 96 && keyCode <= 105) || // Números del teclado numérico
                keyCode === 8 || // Backspace
                keyCode === 9 || // Tab
                keyCode === 46 || // Delete
                (keyCode >= 37 && keyCode <= 40)) { // Flechas
                return true;
            } else {
                // Prevenir la entrada de caracteres no permitidos
                event.preventDefault();
                return false;
            }
        }

        //verificador para solo ingresar números en un campo
        function SoloAlfanumericos(event) {
            // Obtener el valor del evento
            var keyCode = event.keyCode ? event.keyCode : event.which;

            if ((keyCode >= 48 && keyCode <= 57) || // Números del 0 al 9
                (keyCode >= 65 && keyCode <= 90) || // Letras mayúsculas
                (keyCode >= 97 && keyCode <= 122) || // Letras minúsculas
                (keyCode >= 96 && keyCode <= 105) || // Números del teclado numérico
                keyCode === 8 || // Backspace
                keyCode === 9 || // Tab
                keyCode === 32 || // Barra espaciadora
                keyCode === 46 || // Delete
                (keyCode >= 37 && keyCode <= 40)) { // Flechas
                return true;
            } else {
                // Prevenir la entrada de caracteres no permitidos
                event.preventDefault();
                return false;
            }
        }

        //vuelve a la página anterior
        function volverPaginaAnterior() {
            window.location.href = 'http://localhost/PruebaTecnicaBodega/listar_bodegas.php';
        }

        //validador del formulario
        function verificarFormularioBodega(){

            //definición de variables
            // ----------------------------
            let bod_id = document.getElementById("bodega_og").value;
            let cod_bod = document.getElementById("codigoBodega_edit").value;
            let nombre_bod = document.getElementById("nombreBodega_edit").value;
            let direccion_bod = document.getElementById("direccionBodega_edit").value;
            let dotacion_bod = document.getElementById("dotacionBodega_edit").value;
            let estado_bod = document.getElementById("estadoBodega_edit").checked;
            let contador_encargado = <?php echo $total_array_funcionarios; ?>;
            const array_encargado = [];
            let validador_encargado = false;
            for (let j =0; j < contador_encargado; j++) {
                let k = j+1;
                array_encargado[j] = document.getElementById("encargadoBodega_edit_"+k).checked;

                if (array_encargado[j] == true) {
                    validador_encargado = true;
                }
            }
            // ----------------------------

            //validar que todos los campos sean completados correctamente
            if (cod_bod == '') {
                alert("Debe completar el campo 'Código'");
                return;
            }

            if (nombre_bod == '') {
                alert("Debe completar el campo 'Nombre'");
                return;
            }

            if (direccion_bod == '') {
                alert("Debe completar el campo 'Dirección'");
                return;
            }

            if (dotacion_bod == '') {
                alert("Debe completar el campo 'Dotación'");
                return;
            }

            if (validador_encargado == false) {
                alert("Debe seleccionar al menos 1 encargado de bodega");
                return;
            }

            //POST a achivo de guardado


            let xmlhr = new XMLHttpRequest();
            let url = "BD/sql_editar_bodega.php"; //url del archivo
            let variables = "postbodid="+bod_id+"&postcodbod="+cod_bod+"&postnombrebod="+nombre_bod+"&postdireccionbod="+direccion_bod+"&postdotacionbod="+dotacion_bod+"&postestadobod="+estado_bod+"&postvalidadorbod="+array_encargado; //variables a entregar
            xmlhr.open("POST", url, true);
            xmlhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhr.onreadystatechange = function () {

                if (xmlhr.readyState == 4 && xmlhr.status == 200) { //verifica si el archivo objetivo responde correctamente

                    let return_data = xmlhr.responseText;
                    
                    if (return_data == "1") {
                        alert("Bodega editada exitosamente");
                        window.location.href = 'http://localhost/PruebaTecnicaBodega/listar_bodegas.php';
                    } else {
                        alert("Hubo un problema al editar la bodega: "+return_data);
                    }
                    
                }
                
            }     
            xmlhr.send(variables); //ejecuta la solicitud, mandando la información

        }
    </script>

</body>
</html>