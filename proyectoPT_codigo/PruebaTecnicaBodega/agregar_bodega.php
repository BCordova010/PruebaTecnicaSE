<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Bodega</title>
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

        $r_funcionarios = pg_query($conexion, "SELECT * FROM funcionario");

        if (!$r_funcionarios) {
            echo "no se encontraron registros";
            die();
        }

        //se crean variables lógicas
        $array_funcionarios = pg_fetch_all($r_funcionarios);
        $total_array_funcionarios = count($array_funcionarios);

    ?>

    <h1 id="tituloAgregaBodega">FORMULARIO AGREGAR BODEGA</h1>
    
    <form id="formAgregar" name="formAgregar">
        <label for="codigoBodega">Código:</label>
        <input type="text" id="codigoBodega" name="codigoBodega" maxlength="5" required><br><br>

        <label for="nombreBodega">Nombre:</label>
        <input type="text" id="nombreBodega" name="nombreBodega" onkeydown="SoloAlfanumericos(event)" maxlength="100" required><br><br>

        <label for="direccionBodega">Dirección:</label>
        <input type="text" id="direccionBodega" name="direccionBodega" required><br><br>

        <label for="dotacionBodega">Dotación:</label>
        <input type="text" id="dotacionBodega" name="dotacionBodega" onkeydown="SoloNumeros(event)" required><br><br>
        
        <label for="estadoBodega">Activada:</label>
        <input type="checkbox" id="estadoBodega" name="estadoBodega" checked="true"><br><br>

        <label for="encargadoBodega">Encargado:</label>
        <?php for ($i=0; $i < count($array_funcionarios); $i++) { ?>
            <input type="checkbox" id="encargadoBodega_<?php echo $array_funcionarios[$i]['funcionario_id'] ?>" name="encargadoBodega_<?php echo $i ?>"> <?php echo $array_funcionarios[$i]['nombre_funcionario'] ?>
        <?php } ?>
        <br><br>

        <input type="button" value="Guardar" onclick="verificarFormularioBodega()"> <br><br>
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
            window.location.href = 'http://localhost/PruebaTecnicaBodega/';
        }

        //validador del formulario
        function verificarFormularioBodega(){

            //definición de variables
            // ----------------------------
            let cod_bod = document.getElementById("codigoBodega").value;
            let nombre_bod = document.getElementById("nombreBodega").value;
            let direccion_bod = document.getElementById("direccionBodega").value;
            let dotacion_bod = document.getElementById("dotacionBodega").value;
            let estado_bod = document.getElementById("estadoBodega").checked;
            let contador_encargado = <?php echo $total_array_funcionarios; ?>;
            const array_encargado = [];
            let validador_encargado = false;
            for (let j =0; j < contador_encargado; j++) {
                let k = j+1;
                array_encargado[j] = document.getElementById("encargadoBodega_"+k).checked;

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
            let url = "BD/sql_agregar_bodega.php"; //url del archivo
            let variables = "postcodbod="+cod_bod+"&postnombrebod="+nombre_bod+"&postdireccionbod="+direccion_bod+"&postdotacionbod="+dotacion_bod+"&postestadobod="+estado_bod+"&postvalidadorbod="+array_encargado; //variables a entregar
            xmlhr.open("POST", url, true);
            xmlhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhr.onreadystatechange = function () {

                if (xmlhr.readyState == 4 && xmlhr.status == 200) { //verifica si el archivo objetivo responde correctamente

                    let return_data = xmlhr.responseText;
                    
                    if (return_data == "1") {
                        alert("Bodega registrada exitosamente");
                        location.reload();
                    } else {
                        alert("Hubo un problema al registrar la bodega: "+return_data);
                    }
                    
                }
                
            }     
            xmlhr.send(variables); //ejecuta la solicitud, mandando la información

        }
    </script>

</body>
</html>