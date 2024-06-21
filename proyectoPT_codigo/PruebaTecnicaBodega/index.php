<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bodegas PT</title>
    <style>
        body {
            background-color: burlywood;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
        
        #contenedorCentralIndex{
            width: 250px; 
            height: 300px; 
            background-color: gainsboro; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            text-align: center; 
            position: relative; 
            left: 42%;
            border: 2px solid black;
            border-radius: 10px;
            margin-top: 200px;
        }

        #contenedorCentralBotones{
            width: 100px; 
            height: 100px; 
            align-content: center;
        }

        button{
            margin-top: 25px;
        }

        #tituloIndex{
            text-align: center; 
            margin-top: 100px;
        }

    </style>
    <script>
        // console.log('Hola Mundo!');

        //funciones para cambiar las pestañas a diferentes rutas
        // ---------------------------------
        function cambiarPestanaAgregarBodega(){
            window.location.href = 'http://localhost/PruebaTecnicaBodega/agregar_bodega.php';
        }

        function cambiarPestanaListarBodegas(){
            window.location.href = 'http://localhost/PruebaTecnicaBodega/listar_bodegas.php';
        }

        function cambiarPestanaListarFuncionarios(){
            window.location.href = 'http://localhost/PruebaTecnicaBodega/listar_funcionarios.php';
        }
        // ---------------------------------
    </script>
</head>
<body>
    <h1 id="tituloIndex">SISTEMA DE MANEJO DE BODEGAS DEL PROYECTO PT</h1>

    <div id="contenedorCentralIndex">
        <div id="contenedorCentralBotones">
            <label for="contenedorCentralBotones">Eliga una de las siguientes opciones</label>
            <button id="btnAgregarBodega" onclick=cambiarPestanaAgregarBodega();>Agregar Bodega</button><br>
            <button id="btnListarBodegas" onclick=cambiarPestanaListarBodegas();>Listar Bodegas</button><br>
            <button id="btnListarFuncionarios" onclick=cambiarPestanaListarFuncionarios();>Listar Funcionarios</button><br>
        </div>
    </div>
</body>
</html>