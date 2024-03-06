<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $nombreAccion = $_POST['nombreAccion'];
    $fechaCompra = $_POST['fechaCompra'];
    $precioPorAccion = $_POST['precioPorAccion'];
    $cantidadAcciones = $_POST['cantidadAcciones'];

    // Conectar a la base de datos (debes llenar los detalles de la conexión)
    $conexion = new mysqli("basedatos:3306", "root", "ivan", "acciones");
    

    // Verificar conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Preparar la consulta SQL
    $sql = "INSERT INTO acciones (nombreAccion, fechaCompra, precioPorAccion, cantidadAcciones)
            VALUES ('$nombreAccion', '$fechaCompra', $precioPorAccion, $cantidadAcciones)";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        echo "Registro insertado correctamente";
    } else {
        echo "Error al insertar registro: " . $conexion->error;
    }

    // Cerrar conexión
    $conexion->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Acciones</title>
</head>
<body>
    <form id="miFormulario" action="" method="POST">
        <!-- Campos del formulario aquí -->
    </form>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso y Visualización de Datos</title>

    <!-- Estilos CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 20px;
        }

        h2 {
            text-align: center;
        }

        form {
            display: grid;
            gap: 10px;
            justify-content: center;
            max-width: 400px;
            margin: auto;
        }

        table {
            margin-top: 20px;
            margin-bottom: 20px;
            border-collapse: collapse;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        table, th, td {
            border: 1px solid black;
            text-align: center;
        }

        th, td {
            padding: 10px;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <h2>Ingrese los datos de la acción:</h2>

    <!-- Formulario -->
    <form id="miFormulario" action="" method="POST">
        <!-- Campo para el nombre de la acción -->
        <label for="nombreAccion">Nombre de la Acción:</label>
        <select id="nombreAccion" name="nombreAccion" required>
            <option value="AAPL">AAPL (Apple Inc.)</option>
            <option value="GOOG">GOOG (Alphabet Inc.)</option>
            <option value="MSFT">MSFT (Microsoft Corporation)</option>
            <option value="AMZN">AMZN (Amazon.com Inc.)</option>
            <option value="TSLA">TSLA (Tesla Inc.)</option>
            <option value="FB">FB (Facebook, Inc.)</option>
            <option value="NFLX">NFLX (Netflix, Inc.)</option>
            <option value="NVDA">NVDA (NVIDIA Corporation)</option>
            <option value="AMD">AMD (Advanced Micro Devices, Inc.)</option>
            <option value="PYPL">PYPL (PayPal Holdings, Inc.)</option>
            <option value="INTC">INTC (Intel Corporation)</option>
            
        </select>

        
        <label for="precioPorAccion">Precio de Compra por Acción:</label>
        <input type="text" id="precioPorAccion" name="precioPorAccion" required pattern="[0-9]+(\.[0-9]+)?" title="Ingrese un número válido">

        <label for="fechaCompra">Fecha de Compra:</label>
        <input type="date" id="fechaCompra" name="fechaCompra" required>

        <label for="cantidadAcciones">Cantidad de Acciones:</label>
        <input type="number" id="cantidadAcciones" name="cantidadAcciones" required pattern="[0-9]+" title="Ingrese un número entero válido">

        <!-- Botón para agregar a la Tabla -->
        <input type="submit" value="Agregar a la Tabla">
    
    </form>

    <!-- Tabla de Datos -->
    <table border="1">
        <tr>
            <!-- Encabezados de la tabla -->
            <th>Nombre de la Acción</th>
            <th>Fecha de Compra</th>
            <th>Precio por Acción</th>
            <th>Cantidad de Acciones</th>
            <th>Costo Total de Compra</th>
        </tr>
        <?php
        // Establecer conexión a la base de datos
        $conn = new mysqli("basedatos:3306", "root", "ivan", "acciones");
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Realizar consulta SQL para obtener los datos de la tabla acciones
        $sql = "SELECT * FROM acciones ORDER BY nombreAccion";
        $resultado = $conn->query($sql);

        // Comprobar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            // Imprimir los datos en la tabla HTML
            while ($fila = $resultado->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $fila['nombreAccion'] . "</td>";
                echo "<td>" . $fila['fechaCompra'] . "</td>";
                echo "<td>" . $fila['precioPorAccion'] . "</td>";
                echo "<td>" . $fila['cantidadAcciones'] . "</td>";
                echo "<td>" . $fila['costoTotalCompra'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No se encontraron datos en la tabla.</td></tr>";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </table>
    <!-- Script JavaScript -->
    <script>
        // Función para obtener datos de la API de Finnhub y llenar los campos del formulario
        function obtenerDatosAccionFinnhub(symbol) {
            const apiKey = 'cnjrmspr01qvd1hlj6agcnjrmspr01qvd1hlj6b0'; // Reemplaza 'TU_CLAVE_DE_API' con tu propia clave de API proporcionada por Finnhub
            fetch(`https://finnhub.io/api/v1/quote?symbol=${symbol}&token=${apiKey}`)
            .then(response => response.json())
            .then(data => {
                // Actualizar campos del formulario con datos obtenidos de la API
                document.getElementById('precioPorAccion').value = data.c;
            })
            .catch(error => console.error('Error al obtener datos de la API de Finnhub:', error));
        }

        // Llamar a la función para obtener datos de la acción cuando se seleccione una acción en el formulario
        document.getElementById('nombreAccion').addEventListener('change', function() {
            const selectedSymbol = this.value;
            obtenerDatosAccionFinnhub(selectedSymbol);
        });

        // Función para agregar una acción a la tabla
        function agregarAccion() {
            // Obtener valores del formulario
            const nombreAccion = document.getElementById('nombreAccion').value;
            const fechaCompra = document.getElementById('fechaCompra').value;
            const precioPorAccion = parseFloat(document.getElementById('precioPorAccion').value);
            const cantidadAcciones = parseInt(document.getElementById('cantidadAcciones').value);

            // Verificar si los campos están vacíos o contienen datos no válidos
            if (!nombreAccion || !fechaCompra || isNaN(precioPorAccion) || isNaN(cantidadAcciones)) {
                alert('Por favor, complete todos los campos antes de agregar a la tabla.');
                return;
            }

            // Calcular costo total de compra
            const costoTotalCompra = precioPorAccion * cantidadAcciones;

            // Crear fila de la tabla
            const filaTabla = `
                <tr>
                    <td>${nombreAccion}</td>
                    <td>${fechaCompra}</td>
                    <td>${precioPorAccion.toFixed(2)}</td>
                    <td>${cantidadAcciones}</td>
                    <td>${costoTotalCompra.toFixed(2)}</td>
                </tr>
            `;

            // Agregar fila a la tabla
            document.getElementById('tablaDatos').innerHTML += filaTabla;

            // Limpiar campos del formulario después de agregar a la tabla
            document.getElementById('nombreAccion').value = '';
            document.getElementById('fechaCompra').value = '';
            document.getElementById('precioPorAccion').value = '';
            document.getElementById('cantidadAcciones').value = '';
        }

        // Función para validar números positivos
        function validarNumeroPositivo(input) {
            const valor = parseFloat(input.value);
            if (isNaN(valor) || valor < 0) {
                alert('Por favor, ingrese un número positivo.');
                input.value = '';  // Limpiar el campo
            }
        }
    </script>
</body>
</html>

