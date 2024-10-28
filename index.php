<?php
    require_once __DIR__ .'/includes/functions.php';
    $suscripciones = obtenerSuscripciones();
    if (isset($_GET["mensaje"])){
        $message = $_GET["mensaje"];
    }

    if (isset($_GET['accion']) && $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
        $count = eliminarSuscripcion($_GET['id']);
        $mensaje = $count > 0 ? "Suscripción eliminada con éxito." : "No se pudo eliminar la suscripción.";
        header("Location: index.php?mensaje=$mensaje");
        exit;
    }
    function suscripcionActiva($fechaVencimiento) {
        if (formatDate($fechaVencimiento) >= date("Y-m-d")) {
            $resultado = "Activa";
        } else {
            $resultado = "Vencida";
        }
        return $resultado;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suscripción Gym</title>
    <link rel="stylesheet" href="public/css/styles.css"> 
    
</head>
<body>
    <div class="container">
        <h1>Registro de suscripciones</h1><hr><br>

        <?php if (isset($message)): ?>
            <div class="<?php echo $count > 0 ? 'success' : 'error'; ?>">
                
                <script>alert("<?php echo $message; ?>");
                window.location.href = "index.php";</script>
            </div>
        <?php endif; ?>

        <a href="agregar_suscripcion.php" class="button">Agregar Nueva Suscripcion</a>

        <h2>Lista de sucripciones</h2>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Dni</th>
                <th>Fecha de inscripción</th>
                <th>Fecha de vencimiento</th>
                <th>Suscripcion activa</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($suscripciones as $suscripcion): ?>
            <tr>
                <td><?php echo htmlspecialchars($suscripcion['nombre']); ?></td>
                <td><?php echo htmlspecialchars($suscripcion['dni']); ?></td>
                <td><?php echo formatDate($suscripcion['fechaInscripcion']); ?></td>
                <td><?php echo formatDate($suscripcion['fechaVencimiento']); ?></td>
                <td><?php echo htmlspecialchars(suscripcionActiva($suscripcion['fechaVencimiento'])); ?></td>
                <td class="actions">
                    <a href="editar_suscripcion.php?id=<?php echo $suscripcion['_id']; ?>" class="button">Editar</a>
                    <a href="index.php?accion=eliminar&id=<?php echo $suscripcion['_id']; ?>" class="button" onclick="return confirm('¿Estás seguro de que quieres eliminar esta suscripción?');">Eliminar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>