<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar funcionarios</title>
    <style>

        body {
            background-color: burlywood;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }

        #tituloListarfuncionarios{
            text-align: center; 
            margin-top: 100px;
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

        $pg_listado = pg_query($conexion, "SELECT * FROM funcionario;");

        if (!$pg_listado) {
            echo "no se encontraron registros";
            exit;
        }

        //se crean variables lógicas
        $array_listado = pg_fetch_all($pg_listado);
        $total_array_listado = count($array_listado);

    ?>

    <h1 id="tituloListarfuncionarios">LISTADO DE FUNCIONARIOS</h1>

    <input type="button" value="Volver" onclick="volverPaginaAnterior()"><br><br>


    <table id="tablaListadoFuncionarios">

        <tr>

            <th>RUT</th>
            <th>Nombre</th>
            <th>Apellido Paterno</th>
            <th>Apellido Materno</th>
            <th>Dirección</th>
            <th>Teléfono</th>

        </tr>

        <?php while ($fila = pg_fetch_assoc($pg_listado)) { ?>
   
        <tr>

            <td><?php echo $fila["rut_funcionario"] ?></td>
            <td><?php echo $fila["nombre_funcionario"] ?></td>
            <td><?php echo $fila["appat_funcionario"] ?></td>
            <td><?php echo $fila["apmat_funcionario"] ?></td>
            <td><?php echo $fila["direccion_funcionario"] ?></td>
            <td><?php echo $fila["telefono_funcionario"] ?></td>

        </tr>

        <?php } ?>

    </table>

    <script>

        //vuelve a la página anterior
        function volverPaginaAnterior() {
            window.location.href = 'http://localhost/PruebaTecnicaBodega/';
        }

    </script>

</body>
</html>