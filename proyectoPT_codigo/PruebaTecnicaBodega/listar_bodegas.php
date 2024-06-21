<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Bodegas</title>
    <style>

        body {
            background-color: burlywood;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        #tituloListarBodega{
            text-align: center; 
            margin-top: 100px;
        }

        img{
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

    <?php 

        include_once 'BD/funcionesBD.php';

        $pg_listado = pg_query($conexion, "SELECT b.bodega_id, b.codigo_bodega, b.nombre_bodega, b.direccion_bodega, b.dotacion_bodega, 
            f.nombre_funcionario||' '||f.appat_funcionario||' '||f.apmat_funcionario as nombre_func, TO_CHAR(b.registro_creacion_bodega, 'DD/MM/YYYY hh:mi:ss') as fecha_hora, b.estado_bodega
        from bodega b
        join bodega_funcionario bf on bf.bf_bodega_id = b.bodega_id
        join funcionario f on f.funcionario_id = bf.bf_if_funcionario
        order by b.bodega_id;");

        if (!$pg_listado) {
            echo "no se encontraron registros";
            exit;
        }

        //se crean variables lógicas
        $array_listado = pg_fetch_all($pg_listado);
        $total_array_listado = count($array_listado);

    ?>

    <h1 id="tituloListarBodega">LISTADO/MODIFICACIÓN DE BODEGAS</h1>

    <input type="button" value="Volver" onclick="volverPaginaAnterior()"><br><br>

    <label for="filtrarEstados">Filtrar por Estado:</label>
    <select id="filtrarEstados" onchange="filtrarTabla()">
        <option value="todos">Todos</option>
        <option value="Activada">Activadas</option>
        <option value="Desactivada">Desactivadas</option>
    </select><br>


    <table id="tablaListadoBodegas">

        <tr>

            <th>Código</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Dotación</th>
            <th>Nombre Completo</th>
            <th>Fecha/Hora</th>
            <th>Estado</th>
            <th>Editar</th>
            <th>Eliminar</th>

        </tr>

        <?php while ($fila = pg_fetch_assoc($pg_listado)) { ?>
   
        <tr>

            <td><?php echo $fila["codigo_bodega"] ?></td>
            <td><?php echo $fila["nombre_bodega"] ?></td>
            <td><?php echo $fila["direccion_bodega"] ?></td>
            <td><?php echo $fila["dotacion_bodega"] ?></td>
            <td><?php echo $fila["nombre_func"] ?></td>
            <td><?php echo $fila["fecha_hora"] ?></td>
            <td><?php if ($fila["estado_bodega"] == "t") {
                echo "Activada";
            } else {
                echo "Desactivada";
            }?></td>
            <td><img src="icons/pencil-square-icon.png" onclick="editarBodega(<?php echo $fila['bodega_id'] ?>)"/></td>
            <td><img src="icons/close-icon.png" onclick="eliminarBodega(<?php echo $fila['bodega_id'] ?>, '<?php echo $fila['codigo_bodega'] ?>')"/></td>

        </tr>

        <?php } ?>

    </table>

    <script>

        function filtrarTabla() {
            var selector = document.getElementById("filtrarEstados");
            var categoria = selector.value;
            var tabla = document.getElementById("tablaListadoBodegas");
            var filas = tabla.getElementsByTagName("tr");

            for (var i = 1; i < filas.length; i++) {
                var celdas = filas[i].getElementsByTagName("td");
                var categoriaCelda = celdas[6].textContent || celdas[6].innerText;
                
                if (categoria === "todos" || categoriaCelda === categoria) {
                    filas[i].style.display = "";
                } else {
                    filas[i].style.display = "none";
                }
            }
        }

        //vuelve a la página anterior
        function volverPaginaAnterior() {
            window.location.href = 'http://localhost/PruebaTecnicaBodega/';
        }

        //permite editar una bodega - inseguro, se debe cambiar
        function editarBodega(id) {
            window.location.href = 'http://localhost/PruebaTecnicaBodega/editar_bodega.php?verificar='+id;
        }

        function eliminarBodega(id, codigo) {
            
            if (window.confirm("Seguro que desea eliminar la bodega con código: "+codigo+"\nNo hay opciones para deshacer.")) {
                
                let xmlhr = new XMLHttpRequest();
                let url = "BD/sql_eliminar_bodega.php"; //url del archivo
                let variables = "ideliminar="+id; //variables a entregar
                xmlhr.open("POST", url, true);
                xmlhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhr.onreadystatechange = function () {

                    if (xmlhr.readyState == 4 && xmlhr.status == 200) { //verifica si el archivo objetivo responde correctamente

                        let return_data = xmlhr.responseText;
                        
                        if (return_data == "1") {
                            alert("Bodega eliminada exitosamente");
                            location.reload();
                        } else {
                            alert("Hubo un problema al eliminar la bodega: "+return_data);
                        }
                        
                    }
                    
                }     
                xmlhr.send(variables); //ejecuta la solicitud, mandando la información

            }

        }

    </script>

</body>
</html>